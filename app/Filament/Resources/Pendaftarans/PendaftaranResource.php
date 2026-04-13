<?php

namespace App\Filament\Resources\Pendaftarans;

use App\Filament\Resources\Pendaftarans\Pages\ManagePendaftarans;
use App\Models\Pendaftaran;
use App\Models\PesertaDidik;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
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

class PendaftaranResource extends Resource
{
    protected static ?string $model = Pendaftaran::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

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
                                    $lastPendaftaran = \App\Models\Pendaftaran::whereDate('created_at', now()->today())
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
                                TextInput::make('nama_lengkap')->required()->maxLength(255),
                                Select::make('jenis_kelamin')
                                    ->options(['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan'])
                                    ->required(),
                            ]),
                        Grid::make()
                            ->columns(2)
                            ->schema([
                                TextInput::make('nisn')->maxLength(20),
                                TextInput::make('nik')->maxLength(16)->numeric(),
                            ]),
                        Grid::make()
                            ->columns(2)
                            ->schema([
                                TextInput::make('tempat_lahir')->required(),
                                DatePicker::make('tanggal_lahir')->required(),
                            ]),
                        Grid::make()
                            ->columns(2)
                            ->schema([
                                TextInput::make('agama'),
                                TextInput::make('berkebutuhan_khusus'),
                            ]),  
                    ]),

                Step::make('Alamat')
                    ->schema([
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
                        TextInput::make('no_hp')->tel()->required(),
                    ]),

                Step::make('Data Orang Tua')
                    ->schema([
                        Grid::make(2)->schema([
                            Section::make('Data Ayah Kandung')->schema([
                                TextInput::make('nama_ayah'),
                                TextInput::make('tahun_lahir_ayah')->numeric(),
                                TextInput::make('pendidikan_ayah'),
                                TextInput::make('pekerjaan_ayah'),
                                TextInput::make('penghasilan_ayah'),
                            ]),
                            Section::make('Data Ibu Kandung')->schema([
                                TextInput::make('nama_ibu'),
                                TextInput::make('tahun_lahir_ibu')->numeric(),
                                TextInput::make('pendidikan_ibu'),
                                TextInput::make('pekerjaan_ibu'),
                                TextInput::make('penghasilan_ibu'),
                            ]),
                        ]),
                    ]),

                Step::make('Kesejahteraan')
                    ->schema([
                        TextInput::make('tinggi_badan')->numeric()->suffix('cm'),
                        TextInput::make('berat_badan')->numeric()->suffix('kg'),
                        TextInput::make('jumlah_saudara_kandung')->numeric(),
                        Toggle::make('penerima_kps_pkh')->label('Penerima KPS/PKH'),
                        Toggle::make('penerima_kip')->label('Penerima KIP'),
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
                TextColumn::make('no_hp'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'sudah_daftar_ulang' => 'success',
                        'batal' => 'danger',
                    }),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'sudah_daftar_ulang' => 'Sudah Daftar Ulang',
                        'batal' => 'Batal',
                    ]),
            ])
            ->recordActions([
                Action::make('sudah_daftar_ulang')
                    ->label('Daftar Ulang')
                    ->icon(Heroicon::OutlinedCheckCircle)
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Konfirmasi Daftar Ulang')
                    ->modalDescription('Tindakan ini akan memindahkan data anak ke tabel Peserta Didik secara otomatis.')
                    ->visible(fn (Pendaftaran $record) => $record->status === 'pending')
                    ->action(function (Pendaftaran $record) {
                        $dataPesertaDidik = Arr::except($record->toArray(), [
                            'id', 'no_pendaftaran', 'status', 'tanggal_daftar', 'created_at', 'updated_at'
                        ]);
                        PesertaDidik::create($dataPesertaDidik);
                        $record->update(['status' => 'sudah_daftar_ulang']);
                    }),

                Action::make('batal')
                    ->label('Batal')
                    ->icon(Heroicon::OutlinedXCircle)
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn (Pendaftaran $record) => $record->status === 'pending')
                    ->action(fn (Pendaftaran $record) => $record->update(['status' => 'batal'])),

                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
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
        return 'Akademik';
    }

    public static function getNavigationLabel(): string
    {
        return 'Pendaftaran Baru';
    }
}