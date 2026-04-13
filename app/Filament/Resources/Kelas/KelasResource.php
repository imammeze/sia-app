<?php

namespace App\Filament\Resources\Kelas;

use App\Filament\Resources\Kelas\Pages\ManageKelas;
use App\Models\Kelas;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class KelasResource extends Resource
{
    protected static ?string $model = Kelas::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHomeModern;

    public static function getNavigationGroup(): ?string
    {
        return 'Data Master';
    }

    public static function getNavigationLabel(): string
    {
        return 'Data Kelas';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Fieldset::make('Informasi Kelas')
                    ->columns([
                        'default' => 1,
                        'md' => 2,
                        'xl' => 3,
                    ])
                    ->schema([ 
                        TextInput::make('nama_kelas')
                            ->placeholder('Contoh: Kelompok A1 / Bintang')
                            ->required()
                            ->maxLength(255),
                        Select::make('kelompok_usia')
                            ->options([
                                '3-4 Tahun' => '3-4 Tahun (Playgroup)',
                                '4-5 Tahun' => '4-5 Tahun (TK A)',
                                '5-6 Tahun' => '5-6 Tahun (TK B)',
                            ])
                            ->required(),
                        Select::make('guru_id')
                            ->relationship('waliKelas', 'nama_lengkap')
                            ->label('Wali Kelas')
                            ->searchable()
                            ->preload()
                            ->required(),
                ])->columnspanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_kelas')->searchable(),
                TextColumn::make('kelompok_usia')->searchable(),
                TextColumn::make('waliKelas.nama_lengkap')
                    ->label('Wali Kelas')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
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
            'index' => ManageKelas::route('/'),
        ];
    }
}