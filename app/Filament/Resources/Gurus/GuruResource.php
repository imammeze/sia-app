<?php

namespace App\Filament\Resources\Gurus;

use App\Filament\Resources\Gurus\Pages\ManageGurus;
use App\Models\Guru;
use BackedEnum;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GuruResource extends Resource
{
    protected static ?string $model = Guru::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    public static function getNavigationGroup(): ?string
    {
        return 'Data Master';
    }

    public static function getNavigationLabel(): string
    {
        return 'Data Guru';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Guru')->schema([
                    TextInput::make('nip')
                        ->label('NIP / NUPTK')
                        ->unique(ignoreRecord: true)
                        ->maxLength(255),
                    TextInput::make('nama_lengkap')
                        ->required()
                        ->maxLength(255),
                    Select::make('jenis_kelamin')
                        ->options([
                            'Laki-laki' => 'Laki-laki',
                            'Perempuan' => 'Perempuan',
                        ])
                        ->required(),
                    TextInput::make('no_hp')
                        ->tel()
                        ->maxLength(255),
                    Textarea::make('alamat')
                        ->columnSpanFull(),
                ])->columnspanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_lengkap')->searchable(),
                TextColumn::make('nip')->label('NIP')->searchable(),
                TextColumn::make('jenis_kelamin'),
                TextColumn::make('no_hp'),
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
            'index' => ManageGurus::route('/'),
        ];
    }
}