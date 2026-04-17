<?php

namespace App\Filament\Resources\PesertaDidiks;

use App\Filament\Resources\PesertaDidiks\Pages\ManagePesertaDidiks;
use App\Models\PesertaDidik;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
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

class PesertaDidikResource extends Resource
{
    protected static ?string $model = PesertaDidik::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    public static function getNavigationGroup(): ?string { return 'Akademik'; }
    public static function getNavigationLabel(): string { return 'Peserta Didik'; }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Fieldset::make('Penempatan Akademik')->schema([
                    TextInput::make('nis')
                        ->label('NIS (Nomor Induk Siswa)')
                        ->unique(ignoreRecord: true),
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
                        TextInput::make('nisn')->maxLength(20),
                        TextInput::make('nik')->label('NIK (Nomor Induk Kependudukan)')->maxLength(16)->numeric(),
                        TextInput::make('tempat_lahir')->required(),
                        DatePicker::make('tanggal_lahir')->required(),
                        TextInput::make('agama'),
                    ])->columns(2),

                    Tab::make('Kontak & Alamat')->schema([
                        TextInput::make('alamat_jalan')->columnSpanFull(),
                        TextInput::make('kelurahan_desa'),
                        TextInput::make('kecamatan'),
                        TextInput::make('kabupaten_kota'),
                        TextInput::make('no_hp')->tel()->required(),
                    ])->columns(2),

                    Tab::make('Data Orang Tua')->schema([
                        Grid::make(2)->schema([
                            Section::make('Ayah')->schema([
                                TextInput::make('nama_ayah'),
                                TextInput::make('pekerjaan_ayah'),
                                TextInput::make('no_hp_ayah')->tel(),
                            ])->columnSpan(1),
                            Section::make('Ibu')->schema([
                                TextInput::make('nama_ibu'),
                                TextInput::make('pekerjaan_ibu'),
                                TextInput::make('no_hp_ibu')->tel(),
                            ])->columnSpan(1),
                        ])
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
                TextColumn::make('no_hp'),
            ])
            ->filters([])
            ->recordActions([EditAction::make(), DeleteAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManagePesertaDidiks::route('/'),
        ];
    }
}