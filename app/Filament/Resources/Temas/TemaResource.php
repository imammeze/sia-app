<?php

namespace App\Filament\Resources\Temas;

use App\Filament\Resources\Temas\Pages\ManageTemas;
use App\Models\Tema;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TemaResource extends Resource
{
    protected static ?string $model = Tema::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;

    public static function getNavigationGroup(): ?string
    {
        return 'Data Master';
    }

    public static function getNavigationLabel(): string
    {
        return 'Data Tema Pembelajaran';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Tema')->schema([
                    TextInput::make('nama_tema')
                        ->placeholder('Contoh: Diriku, Keluargaku, Alam Semesta')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('alokasi_waktu')
                        ->placeholder('Contoh: 3 Minggu')
                        ->maxLength(255),
                    Textarea::make('deskripsi')
                        ->columnSpanFull(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_tema')->searchable(),
                TextColumn::make('alokasi_waktu'),
                TextColumn::make('deskripsi')->limit(50),
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
            'index' => ManageTemas::route('/'),
        ];
    }
}