<?php

namespace App\Filament\Resources\PesertaDidiks;

use App\Filament\Resources\PesertaDidiks\Pages\ManagePesertaDidiks;
use App\Models\PesertaDidik;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\RestoreAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ForceDeleteBulkAction;

class PesertaDidikResource extends Resource
{
    protected static ?string $model = PesertaDidik::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    protected static ?string $modelLabel = 'Data Peserta Didik';
    protected static ?string $pluralModelLabel = 'Data Peserta Didik';
    public static function getNavigationGroup(): ?string { return 'Data Master'; }
    public static function getNavigationLabel(): string { return 'Data Peserta Didik'; }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Fieldset::make('Penempatan Akademik')->schema([
                    TextInput::make('nis')
                        ->label('NIS (Nomor Induk Siswa)')
                        ->unique(ignoreRecord: true)
                        ->default(function () {
                            $lastNis = PesertaDidik::max('nis');
                            return $lastNis ? (int) $lastNis + 1 : 1;
                        }),
                    Select::make('kelas_id')
                        ->relationship('kelas', 'nama_kelas')
                        ->label('Penempatan Kelas')
                        ->searchable()
                        ->preload(),
                ])->columnspanFull(),

                Tabs::make('Data Detail Siswa')->tabs([
                    Tab::make('Identitas Anak')->schema([
                        TextInput::make('nama_lengkap')->required()->maxLength(255),
                        Select::make('jenis_kelamin')->options(['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan'])->required(),
                        TextInput::make('nisn')
                            ->unique(ignoreRecord: true)
                            ->validationMessages(['unique' => 'NISN sudah digunakan'])
                            ->maxLength(20),
                        TextInput::make('nik')
                            ->label('NIK (Nomor Induk Kependudukan)')
                            ->maxLength(16)
                            ->rule('regex:/^[0-9]+$/')
                            ->validationMessages(['regex' => 'NIK hanya boleh berisi angka']),
                        TextInput::make('tempat_lahir')->required(),
                        DatePicker::make('tanggal_lahir')->required(),
                        Select::make('agama')
                            ->options([
                                'Islam' => 'Islam',
                                'Kristen' => 'Kristen',
                                'Katolik' => 'Katolik',
                                'Hindu' => 'Hindu',
                                'Buddha' => 'Buddha',
                                'Konghucu' => 'Konghucu',
                            ]),
                    ])->columns(2),

                    Tab::make('Kontak & Alamat')->schema([
                        \Filament\Schemas\Components\Group::make()->relationship('alamat')->schema([
                            TextInput::make('alamat_jalan')->columnSpanFull(),
                            Grid::make(2)->schema([
                                TextInput::make('rt')->numeric(),
                                TextInput::make('rw')->numeric(),
                            ]),
                            TextInput::make('kelurahan_desa'),
                            TextInput::make('kecamatan'),
                            TextInput::make('kabupaten_kota'),
                        ])->columns(2)->columnSpanFull()
                    ]),

                    Tab::make('Data Orang Tua')->schema([
                        \Filament\Schemas\Components\Group::make()->relationship('orang_tua')->schema([
                            TextInput::make('no_hp')->tel()->required()->label('No. HP / WhatsApp Keluarga')->columnSpanFull(),
                            Grid::make(2)->schema([
                                Section::make()->heading('Ayah')->schema([
                                    TextInput::make('nama_ayah'),
                                    TextInput::make('tahun_lahir_ayah')->numeric(),
                                    TextInput::make('pendidikan_ayah'),
                                    TextInput::make('pekerjaan_ayah'),
                                    TextInput::make('penghasilan_ayah'),
                                ])->columnSpan(1),
                                Section::make()->heading('Ibu')->schema([
                                    TextInput::make('nama_ibu'),
                                    TextInput::make('tahun_lahir_ibu')->numeric(),
                                    TextInput::make('pendidikan_ibu'),
                                    TextInput::make('pekerjaan_ibu'),
                                    TextInput::make('penghasilan_ibu'),
                                ])->columnSpan(1),
                            ])
                        ])->columnSpanFull()
                    ]),

                    Tab::make('Data Periodik')->schema([
                        \Filament\Schemas\Components\Group::make()->relationship('data_periodik')->schema([
                            TextInput::make('tinggi_badan')->numeric()->suffix('cm'),
                            TextInput::make('berat_badan')->numeric()->suffix('kg'),
                            TextInput::make('jumlah_saudara_kandung')->numeric(),
                            TextInput::make('jarak_ke_sekolah'),
                        ])->columns(2)->columnSpanFull()
                    ]),
                ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nis')->searchable(),
                TextColumn::make('nama_lengkap')->searchable(),
                TextColumn::make('kelas.nama_kelas')->label('Kelas')->sortable(),
                TextColumn::make('jenis_kelamin'),
                TextColumn::make('orang_tua.no_hp')->label('No. Hp Orang Tua / Wali'),
            ])
            ->filters([
                \Filament\Tables\Filters\TrashedFilter::make(),])
            ->recordActions([
                RestoreAction::make(),
                ForceDeleteAction::make(),ViewAction::make(), EditAction::make(), DeleteAction::make()])
            ->toolbarActions([BulkActionGroup::make([
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make(),DeleteBulkAction::make()])]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Detail Peserta Didik')
                    ->tabs([
                        Tab::make('Penempatan Akademik')
                            ->icon('heroicon-o-academic-cap')
                            ->components([
                                TextEntry::make('nis')->label('NIS (Nomor Induk Siswa)')->weight('bold'),
                                TextEntry::make('kelas.nama_kelas')->label('Penempatan Kelas'),
                            ])->columns(2),

                        Tab::make('Identitas Anak')
                            ->icon('heroicon-o-user')
                            ->components([
                                TextEntry::make('nama_lengkap')->size('text-lg')->weight('bold')->columnSpanFull(),
                                TextEntry::make('jenis_kelamin')->label('Jenis Kelamin'),
                                TextEntry::make('nisn')->label('NISN'),
                                TextEntry::make('nik')->label('NIK (16 Digit)'),
                                TextEntry::make('tempat_lahir')->label('Tempat Lahir'),
                                TextEntry::make('tanggal_lahir')->label('Tanggal Lahir')->date('d F Y'),
                                TextEntry::make('agama')->label('Agama'),
                            ])->columns(3),

                        Tab::make('Kontak & Alamat')
                            ->icon('heroicon-o-map-pin')
                            ->components([
                                TextEntry::make('alamat.alamat_jalan')->label('Alamat Jalan')->columnSpanFull(),
                                TextEntry::make('alamat.rt')->label('RT'),
                                TextEntry::make('alamat.rw')->label('RW'),
                                TextEntry::make('alamat.kelurahan_desa')->label('Kelurahan/Desa'),
                                TextEntry::make('alamat.kecamatan')->label('Kecamatan'),
                                TextEntry::make('alamat.kabupaten_kota')->label('Kabupaten/Kota'),
                                TextEntry::make('orang_tua.no_hp')->label('No. WhatsApp')->icon('heroicon-m-phone'),
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
                                            TextEntry::make('orang_tua.penghasilan_ayah')->label('Penghasilan'),
                                        ])->columnSpan(1),
                                        
                                    Section::make()->heading('Data Ibu Kandung')
                                        ->components([
                                            TextEntry::make('orang_tua.nama_ibu')->label('Nama Ibu'),
                                            TextEntry::make('orang_tua.tahun_lahir_ibu')->label('Tahun Lahir'),
                                            TextEntry::make('orang_tua.pendidikan_ibu')->label('Pendidikan'),
                                            TextEntry::make('orang_tua.pekerjaan_ibu')->label('Pekerjaan'),
                                            TextEntry::make('orang_tua.penghasilan_ibu')->label('Penghasilan'),
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
            'index' => ManagePesertaDidiks::route('/'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                \Illuminate\Database\Eloquent\SoftDeletingScope::class,
            ]);
    }
}