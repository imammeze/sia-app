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
use Filament\Actions\RestoreAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ForceDeleteBulkAction;

class TemaResource extends Resource
{
    protected static ?string $model = Tema::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;

    protected static ?string $modelLabel = 'Data Tema';
    protected static ?string $pluralModelLabel = 'Data Tema';
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
                Section::make()->heading('Informasi Tema')
                    ->schema([
                        TextInput::make('nama_tema')
                            ->label('Nama Tema')
                            ->placeholder('Contoh: Diriku, Keluargaku, Alam Semesta')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('alokasi_waktu')
                            ->label('Alokasi Waktu')
                            ->placeholder('Contoh: 3 Minggu')
                            ->maxLength(255),
                        Textarea::make('deskripsi')
                            ->label('Deskripsi')
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
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
                \Filament\Tables\Filters\TrashedFilter::make(),
                //
            ])
            ->recordActions([
                RestoreAction::make(),
                ForceDeleteAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make(),
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

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                \Illuminate\Database\Eloquent\SoftDeletingScope::class,
            ]);
    }
}