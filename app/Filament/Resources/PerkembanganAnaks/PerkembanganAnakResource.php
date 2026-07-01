<?php

namespace App\Filament\Resources\PerkembanganAnaks;

use App\Filament\Resources\PerkembanganAnaks\Pages\CreatePerkembanganAnak;
use App\Filament\Resources\PerkembanganAnaks\Pages\EditPerkembanganAnak;
use App\Filament\Resources\PerkembanganAnaks\Pages\ListPerkembanganAnaks;
use App\Models\Absensi;
use App\Models\CapaianPembelajaran;
use App\Models\KategoriCapaian;
use App\Models\PerkembanganAnak;
use App\Models\PesertaDidik;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;

use Filament\Infolists\Components\TextEntry;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;

class PerkembanganAnakResource extends Resource
{
    protected static ?string $model = PerkembanganAnak::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

    protected static ?string $modelLabel = 'Data Perkembangan Anak';
    protected static ?string $pluralModelLabel = 'Data Perkembangan Anak';
    public static function getNavigationGroup(): ?string { return 'Akademik'; }
    public static function getNavigationLabel(): string { return 'Data Perkembangan Anak'; }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                // ===== SECTION 1: Header Peserta Didik =====
                Section::make()->heading('Data Peserta Didik')->schema([
                    Select::make('peserta_didik_id')
                        ->relationship('pesertaDidik', 'nama_lengkap')
                        ->label('Nama Peserta Didik')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->live()
                        ->afterStateUpdated(function (Set $set, ?string $state) {
                            if ($state) {
                                $peserta = PesertaDidik::with('kelas')->find($state);
                                if ($peserta) {
                                    $set('_kelas_display', $peserta->kelas?->nama_kelas ?? '-');
                                    
                                    if ($peserta->kelas?->guru_id) {
                                        $set('guru_id', $peserta->kelas->guru_id);
                                    }
                                    
                                    if ($peserta->tinggi_badan) {
                                        $set('tinggi_badan', $peserta->tinggi_badan);
                                    }
                                    
                                    if ($peserta->berat_badan) {
                                        $set('berat_badan', $peserta->berat_badan);
                                    }
                                }
                            }
                        }),
                    TextEntry::make('_kelas_display')
                        ->label('Kelas')
                        ->state(function (Get $get) {
                            $pesertaDidikId = $get('peserta_didik_id');
                            if ($pesertaDidikId) {
                                $peserta = PesertaDidik::with('kelas')->find($pesertaDidikId);
                                return $peserta?->kelas?->nama_kelas ?? '-';
                            }
                            return '-';
                        }),
                    Select::make('guru_id')
                        ->relationship('guru', 'nama_lengkap')
                        ->label('Guru Penilai')
                        ->default(fn () => Auth::user()->guru?->id)
                        ->searchable()
                        ->required()
                        ->disabled()
                        ->dehydrated(),
                    TextInput::make('tahun_ajaran')
                        ->label('Tahun Ajaran')
                        ->placeholder('Contoh: 2025/2026')
                        ->required()
                        ->maxLength(20),
                    Select::make('semester')
                        ->options([
                            'ganjil' => 'Ganjil',
                            'genap' => 'Genap',
                        ])
                        ->required(),
                    TextInput::make('tinggi_badan')
                        ->label('Tinggi Badan (cm)')
                        ->numeric()
                        ->step(0.01)
                        ->suffix('cm'),
                    TextInput::make('berat_badan')
                        ->label('Berat Badan (kg)')
                        ->numeric()
                        ->step(0.01)
                        ->suffix('kg'),
                ])->columns(4)->columnSpanFull(),

                // ===== SECTION 2: Tabel Penilaian Capaian =====
                Section::make()->heading('Penilaian Capaian Pembelajaran')
                    ->description('Pilih kategori capaian lalu klik "Muat Capaian" untuk menambahkan penilaian')
                    ->schema(function () {
                        return static::buildNilaiPerkembanganSchema();
                    })
                    ->columnSpanFull(),

                // ===== SECTION 3: Foto Perkembangan Anak =====
                Section::make()->heading('Foto Perkembangan Anak')
                    ->description('Upload maksimal 3 foto kegiatan anak')
                    ->schema([
                        FileUpload::make('foto_kegiatan')
                            ->label('')
                            ->multiple()
                            ->maxFiles(3)
                            ->image()
                            ->directory('foto-kegiatan')
                            ->columnSpanFull(),
                    ])->columnSpanFull(),

                // ===== SECTION 4: Komentar Guru =====
                Section::make()->heading('Komentar Guru')->schema([
                    Textarea::make('komentar_guru')
                        ->label('Komentar mengenai perkembangan anak')
                        ->placeholder('Tuliskan komentar detail mengenai perkembangan anak secara keseluruhan...')
                        ->rows(5)
                        ->columnSpanFull(),
                ]),

                // ===== SECTION 5: Ringkasan Absensi =====
                Section::make()->heading('Ringkasan Kehadiran')
                    ->description('Data diambil otomatis dari tabel absensi')
                    ->schema([
                        TextEntry::make('_absensi_hadir')
                            ->label('Hadir')
                            ->state(function (Get $get) {
                                return static::getAbsensiCount($get('peserta_didik_id'), 'hadir') . ' hari';
                            }),
                        TextEntry::make('_absensi_sakit')
                            ->label('Sakit')
                            ->state(function (Get $get) {
                                return static::getAbsensiCount($get('peserta_didik_id'), 'sakit') . ' hari';
                            }),
                        TextEntry::make('_absensi_izin')
                            ->label('Izin')
                            ->state(function (Get $get) {
                                return static::getAbsensiCount($get('peserta_didik_id'), 'izin') . ' hari';
                            }),
                        TextEntry::make('_absensi_alpa')
                            ->label('Alpa')
                            ->state(function (Get $get) {
                                return static::getAbsensiCount($get('peserta_didik_id'), 'alpa') . ' hari';
                            }),
                    ])->columns(4),
            ]);
    }

    /**
     * Build the assessment fields grouped by KategoriCapaian.
     */
    protected static function buildNilaiPerkembanganSchema(): array
    {
        $components = [];

        // Tombol Muat Semua Capaian
        $components[] = Actions::make([
            Action::make('muat_capaian')
                ->label('Muat Semua Capaian Pembelajaran')
                ->icon('heroicon-o-arrow-down-tray')
                ->color(fn() => 'primary')
                ->action(function (Get $get, Set $set) {
                    $capaians = CapaianPembelajaran::orderBy('kategori_capaian_id')
                        ->orderBy('urutan')
                        ->get();

                    $existing = $get('nilaiPerkembangan') ?? [];
                    // Filter out empty rows
                    $existing = array_filter($existing, function($item) {
                        return !empty($item['capaian_pembelajaran_id']);
                    });
                    $existingIds = collect($existing)->pluck('capaian_pembelajaran_id')->filter()->toArray();

                    foreach ($capaians as $cp) {
                        if (!in_array($cp->id, $existingIds)) {
                            $existing[] = [
                                'capaian_pembelajaran_id' => $cp->id,
                                'tingkat_capaian' => null,
                            ];
                        }
                    }

                    $set('nilaiPerkembangan', array_values($existing));
                }),
        ]);

        // Repeater Penilaian
        $components[] = Repeater::make('nilaiPerkembangan')
            ->relationship()
            ->label('')
            ->schema([
                Hidden::make('capaian_pembelajaran_id'),
                TextEntry::make('_capaian_display')
                    ->label('Capaian Pembelajaran')
                    ->state(function (Get $get) {
                        $id = $get('capaian_pembelajaran_id');
                        if (!$id) return '-';
                        $cp = CapaianPembelajaran::with('kategoriCapaian')->find($id);
                        return $cp ? '[' . $cp->kategoriCapaian->nama_kategori . '] ' . $cp->deskripsi : '-';
                    })
                    ->columnSpan(2),
                Select::make('tingkat_capaian')
                    ->label('Tingkat Capaian')
                    ->options([
                        'BB' => 'BB - Belum Berkembang',
                        'MB' => 'MB - Mulai Berkembang',
                        'BSH' => 'BSH - Berkembang Sesuai Harapan',
                        'BSB' => 'BSB - Berkembang Sangat Baik',
                    ])
                    ->required()
                    ->validationMessages(['required' => 'Pilih capaian'])
                    ->columnSpan(1),
            ])
            ->columns(3)
            ->defaultItems(0)
            ->addable(false)
            ->deletable(false)
            ->reorderable(false)
            ->columnSpanFull();

        return $components;
    }

    /**
     * Get absensi count for a specific status.
     */
    protected static function getAbsensiCount(?string $pesertaDidikId, string $status): int
    {
        if (!$pesertaDidikId) {
            return 0;
        }

        return Absensi::where('peserta_didik_id', $pesertaDidikId)
            ->where('status', $status)
            ->count();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pesertaDidik.nama_lengkap')
                    ->label('Peserta Didik')
                    ->searchable(),
                TextColumn::make('pesertaDidik.kelas.nama_kelas')
                    ->label('Kelas'),
                TextColumn::make('tahun_ajaran')
                    ->label('Tahun Ajaran'),
                TextColumn::make('semester')
                    ->label('Semester')
                    ->formatStateUsing(fn (string $state) => ucfirst($state))
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'ganjil' => 'info',
                        'genap' => 'success',
                    }),
                TextColumn::make('guru.nama_lengkap')
                    ->label('Guru Penilai'),
                TextColumn::make('nilai_perkembangan_count')
                    ->counts('nilaiPerkembangan')
                    ->label('Jml Penilaian'),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                Action::make('cetak_pdf')
                    ->label('Cetak PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color(fn() => 'success')
                    ->url(fn (PerkembanganAnak $record) => route('perkembangan-anak.pdf', $record))
                    ->openUrlInNewTab(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPerkembanganAnaks::route('/'),
            'create' => CreatePerkembanganAnak::route('/create'),
            'edit' => EditPerkembanganAnak::route('/{record}/edit'),
        ];
    }
}