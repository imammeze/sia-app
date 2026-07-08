<?php

namespace App\Filament\Resources\Pendaftarans;

use App\Filament\Resources\Pendaftarans\Pages\ManagePendaftarans;
use App\Models\Kelas;
use App\Models\Pendaftaran;
use App\Models\PesertaDidik;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction; 
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema; 
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Filament\Actions\RestoreAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ForceDeleteBulkAction;

class PendaftaranResource extends Resource
{
    protected static ?string $model = Pendaftaran::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected static ?string $modelLabel = 'Data Pendaftaran';
    protected static ?string $pluralModelLabel = 'Data Pendaftaran';
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Status & Administrasi')
                        ->schema([
                            Grid::make()
                                ->columns(3)
                                ->schema([
                                    TextInput::make('no_pendaftaran')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->disabled() 
                                    ->dehydrated()
                                    ->default(function () {
                                        $datePrefix = now()->format('dmY'); 
                                        $lastPendaftaran = Pendaftaran::whereDate('created_at', now()->today())
                                            ->orderBy('id', 'desc')
                                            ->first();
                                        if ($lastPendaftaran) {
                                            $lastNumber = (int) substr($lastPendaftaran->no_pendaftaran, -3);
                                            $newNumber = $lastNumber + 1;
                                        } else {
                                            $newNumber = 1;
                                        }
                                        return 'REG-' . $datePrefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
                                    }),

                                    DatePicker::make('tanggal_daftar')
                                        ->required()
                                        ->default(now()),
                                    Select::make('status')
                                        ->options([
                                            'pending' => 'Pending',
                                            'sudah_daftar_ulang' => 'Sudah Daftar Ulang',
                                            'batal' => 'Batal',
                                        ])
                                        ->default('pending')
                                        ->required(),
                                ]), 
                        ]),

                    Step::make('Identitas Anak')
                        ->schema([
                            Grid::make()
                                ->columns(2)
                                ->schema([
                                    TextInput::make('nama_lengkap')
                                        ->required()
                                        ->maxLength(255)
                                        ->validationMessages(['required' => 'Nama lengkap wajib diisi']),
                                    Select::make('jenis_kelamin')
                                        ->options(['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan'])
                                        ->required()
                                        ->validationMessages(['required' => 'Jenis kelamin wajib dipilih']),
                                ]),
                            Grid::make()
                                ->columns(2)
                                ->schema([
                                    TextInput::make('nisn')->maxLength(20),
                                    TextInput::make('nik')->maxLength(16)->rule('regex:/^[0-9]*$/')->validationMessages(['regex' => 'NIK hanya boleh berisi angka']),
                                ]),
                            Grid::make()
                                ->columns(2)
                                ->schema([
                                    TextInput::make('tempat_lahir')
                                        ->required()
                                        ->validationMessages(['required' => 'Tempat lahir wajib diisi']),
                                    DatePicker::make('tanggal_lahir')
                                        ->required()
                                        ->validationMessages(['required' => 'Tanggal lahir wajib diisi']),
                                ]),
                            Grid::make()
                                ->columns(2)
                                ->schema([
                                    Select::make('agama')
                                        ->options([
                                            'Islam' => 'Islam',
                                            'Kristen' => 'Kristen',
                                            'Katolik' => 'Katolik',
                                            'Hindu' => 'Hindu',
                                            'Buddha' => 'Buddha',
                                            'Konghucu' => 'Konghucu',
                                        ]),
                                    TextInput::make('berkebutuhan_khusus'),
                                ]),  
                        ]),

                    Step::make('Alamat')
                        ->schema([
                            \Filament\Schemas\Components\Group::make()->relationship('alamat')->schema([
                                Grid::make()
                                    ->columns(3)
                                    ->schema([
                                        TextInput::make('alamat_jalan'),
                                        TextInput::make('rt')->numeric(),
                                        TextInput::make('rw')->numeric(),
                                    ]), 
                                Grid::make()
                                    ->columns(3)
                                    ->schema([
                                        TextInput::make('kelurahan_desa'),
                                        TextInput::make('kecamatan'),
                                        TextInput::make('kabupaten_kota'),
                                    ]),
                            ]),
                        ]),

                    Step::make('Data Orang Tua')
                        ->schema([
                            \Filament\Schemas\Components\Group::make()->relationship('orang_tua')->schema([
                                TextInput::make('no_hp')
                                    ->tel()
                                    ->required()
                                    ->validationMessages(['required' => 'Nomor WhatsApp wajib diisi'])
                                    ->label('No. WhatsApp (Kontak Keluarga)')
                                    ->columnSpanFull(),
                                Grid::make(2)->schema([
                                    Section::make()->heading('Data Ayah Kandung')->schema([
                                        TextInput::make('nama_ayah'),
                                        TextInput::make('tahun_lahir_ayah')->numeric(),
                                        TextInput::make('pendidikan_ayah'),
                                        TextInput::make('pekerjaan_ayah'),
                                        TextInput::make('penghasilan_ayah'),
                                    ])->columnSpan(1),
                                    Section::make()->heading('Data Ibu Kandung')->schema([
                                        TextInput::make('nama_ibu'),
                                        TextInput::make('tahun_lahir_ibu')->numeric(),
                                        TextInput::make('pendidikan_ibu'),
                                        TextInput::make('pekerjaan_ibu'),
                                        TextInput::make('penghasilan_ibu'),
                                    ])->columnSpan(1),
                                ]),
                            ]),
                        ]),

                    Step::make('Data Periodik')
                        ->schema([
                            \Filament\Schemas\Components\Group::make()->relationship('data_periodik')->schema([
                                TextInput::make('tinggi_badan')->numeric()->suffix('cm'),
                                TextInput::make('berat_badan')->numeric()->suffix('kg'),
                                TextInput::make('jumlah_saudara_kandung')->numeric(),
                                TextInput::make('jarak_ke_sekolah'),
                            ])->columns(2)->columnSpanFull(),
                        ]),
                ])->columnSpanFull()
                ->submitAction(new HtmlString(Blade::render('<x-filament::button type="submit">Simpan Pendaftaran</x-filament::button>'))),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no_pendaftaran')->searchable(),
                TextColumn::make('nama_lengkap')->searchable(),
                TextColumn::make('tanggal_daftar')->date()->sortable(),
                TextColumn::make('orang_tua.no_hp')->label('No. HP'),
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => ucwords(str_replace('_', ' ', $state)))
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'sudah_daftar_ulang' => 'success',
                        'batal' => 'danger',
                    }),
            ])
            ->filters([
                \Filament\Tables\Filters\TrashedFilter::make(),
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'sudah_daftar_ulang' => 'Sudah Daftar Ulang',
                        'batal' => 'Batal',
                    ]),
            ])
            ->recordActions([
                RestoreAction::make(),
                ForceDeleteAction::make(),
                Action::make('sudah_daftar_ulang')
                    ->label('Daftar Ulang')
                    ->icon('heroicon-o-check-circle')
                    ->color(fn() => 'success')
                    ->requiresConfirmation()
                    ->modalHeading('Konfirmasi Daftar Ulang')
                    ->modalDescription('Tindakan ini memindahkan data anak ke tabel Peserta Didik dan menentukan penempatan kelas secara otomatis berdasarkan usia.')
                    ->visible(fn (Pendaftaran $record) => $record->status === 'pending')
                    ->action(function (Pendaftaran $record) {
                        $usia = \Carbon\Carbon::parse($record->tanggal_lahir)->diff(now());

                        if ($usia->y < 4) { 
                            $kategoriUsia = '3-4 Tahun'; 
                        } elseif ($usia->y == 4) { 
                            $kategoriUsia = '4-5 Tahun';
                        } else { 
                            $kategoriUsia = '5-6 Tahun';
                        }

                        $kelas = Kelas::where('kelompok_usia', $kategoriUsia)->first();
                        $dataPesertaDidik = Arr::except($record->toArray(), [
                            'id', 'no_pendaftaran', 'status', 'tanggal_daftar', 'created_at', 'updated_at'
                        ]);
                        // alamat_id and orang_tua_id will be copied over naturally because they are in toArray()

                        if ($kelas) {
                            $dataPesertaDidik['kelas_id'] = $kelas->id;
                        }

                        // Auto-generate NIS
                        $lastNis = PesertaDidik::max('nis');
                        $dataPesertaDidik['nis'] = $lastNis ? (int) $lastNis + 1 : 1;

                        PesertaDidik::create($dataPesertaDidik);

                        $record->update(['status' => 'sudah_daftar_ulang']);

                        Notification::make()
                            ->title('Berhasil Daftar Ulang')
                            ->body('Data dipindahkan dan ditempatkan pada kelompok usia: ' . $kategoriUsia)
                            ->success()
                            ->send();
                    }),

                Action::make('batal')
                    ->label('Batal')
                    ->icon('heroicon-o-x-circle')
                    ->color(fn() => 'danger')
                    ->requiresConfirmation()
                    ->modalHeading('Batalkan Pendaftaran')
                    ->modalDescription('Apakah Anda yakin ingin membatalkan pendaftaran ini? Data tidak akan dihapus, hanya diubah statusnya menjadi Batal.')
                    ->visible(fn (Pendaftaran $record) => $record->status === 'pending')
                    ->action(function (Pendaftaran $record) {
                        $record->update(['status' => 'batal']);
                        Notification::make()
                            ->title('Pendaftaran Dibatalkan')
                            ->body('Status pendaftaran telah diubah menjadi Batal.')
                            ->success()
                            ->send();
                    }),
                    
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Detail Pendaftaran')
                    ->tabs([
                        Tab::make('Status Administrasi')
                            ->icon('heroicon-o-clipboard-document-check')
                            ->components([
                                TextEntry::make('no_pendaftaran')->label('Nomor Registrasi')->weight('bold'),
                                TextEntry::make('tanggal_daftar')->date('d F Y'),
                                TextEntry::make('status')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'pending' => 'warning',
                                        'sudah_daftar_ulang' => 'success',
                                        'batal' => 'danger',
                                    }),
                            ])->columns(3),

                        Tab::make('Identitas Anak')
                            ->icon('heroicon-o-user')
                            ->components([
                                TextEntry::make('nama_lengkap')->size('text-lg')->weight('bold')->columnSpanFull(),
                                TextEntry::make('jenis_kelamin'),
                                TextEntry::make('tempat_lahir'),
                                TextEntry::make('tanggal_lahir')->date('d F Y'),
                                TextEntry::make('agama'),
                                TextEntry::make('nik')->label('NIK (16 Digit)'),
                                TextEntry::make('no_registrasi_akta_lahir')->label('No. Akta Lahir'),
                            ])->columns(3),

                        Tab::make('Kontak & Alamat')
                            ->icon('heroicon-o-map-pin')
                            ->components([
                                TextEntry::make('alamat.alamat_jalan')->label('Alamat Jalan')->columnSpanFull(),
                                TextEntry::make('alamat.kelurahan_desa')->label('Kelurahan/Desa'),
                                TextEntry::make('alamat.kecamatan')->label('Kecamatan'),
                                TextEntry::make('orang_tua.no_hp')->label('No. WhatsApp')->icon('heroicon-m-phone'),
                                TextEntry::make('alamat.alat_transportasi')->label('Alat Transportasi'),
                            ])->columns(3),

                        Tab::make('Data Orang Tua')
                            ->icon('heroicon-o-users')
                            ->components([
                                Grid::make(2)->components([
                                    Section::make()->heading('Data Ayah Kandung')
                                        ->components([
                                            TextEntry::make('orang_tua.nama_ayah')->label('Nama Ayah'),
                                            TextEntry::make('orang_tua.tahun_lahir_ayah')->label('Tahun Lahir'),
                                            TextEntry::make('orang_tua.pendidikan_ayah')->label('Pendidikan'),
                                            TextEntry::make('orang_tua.pekerjaan_ayah')->label('Pekerjaan'),
                                        ])->columnSpan(1),
                                        
                                    Section::make()->heading('Data Ibu Kandung')
                                        ->components([
                                            TextEntry::make('orang_tua.nama_ibu')->label('Nama Ibu'),
                                            TextEntry::make('orang_tua.tahun_lahir_ibu')->label('Tahun Lahir'),
                                            TextEntry::make('orang_tua.pendidikan_ibu')->label('Pendidikan'),
                                            TextEntry::make('orang_tua.pekerjaan_ibu')->label('Pekerjaan'),
                                        ])->columnSpan(1),
                                ]),
                            ]),

                        Tab::make('Data Periodik')
                            ->icon('heroicon-o-chart-bar')
                            ->components([
                                TextEntry::make('data_periodik.tinggi_badan')->label('Tinggi Badan')->suffix(' cm'),
                                TextEntry::make('data_periodik.berat_badan')->label('Berat Badan')->suffix(' kg'),
                                TextEntry::make('data_periodik.jumlah_saudara_kandung')->label('Jumlah Saudara')->suffix(' orang'),
                                TextEntry::make('data_periodik.jarak_ke_sekolah')->label('Jarak ke Sekolah'),
                            ])->columns(2),
                    ])
                    ->columnSpanFull() 
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManagePendaftarans::route('/'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Pendaftaran';
    }

    public static function getNavigationLabel(): string
    {
        return 'Data Pendaftaran';
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                \Illuminate\Database\Eloquent\SoftDeletingScope::class,
            ]);
    }
}