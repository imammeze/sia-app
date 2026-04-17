<?php

namespace App\Filament\Resources\Rapors;

use App\Filament\Resources\Rapors\Pages\ManageRapors;
use App\Models\Rapor;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RaporResource extends Resource
{
    protected static ?string $model = Rapor::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    public static function getNavigationGroup(): ?string { return 'Akademik'; }
    public static function getNavigationLabel(): string { return 'Rapor Semester'; }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Data Rapor')->schema([
                    Select::make('peserta_didik_id')
                        ->relationship('pesertaDidik', 'nama_lengkap')
                        ->label('Peserta Didik')
                        ->searchable()
                        ->required(),
                    Select::make('kelas_id')
                        ->relationship('kelas', 'nama_kelas')
                        ->label('Kelas')
                        ->searchable()
                        ->required(),
                    TextInput::make('tahun_ajaran')
                        ->placeholder('Contoh: 2025/2026')
                        ->default('2025/2026')
                        ->required(),
                    Select::make('semester')
                        ->options([
                            'ganjil' => 'Semester Ganjil',
                            'genap' => 'Semester Genap',
                        ])
                        ->required(),
                    Textarea::make('catatan_wali_kelas')
                        ->label('Catatan/Narasi Wali Kelas')
                        ->rows(5)
                        ->columnSpanFull(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pesertaDidik.nama_lengkap')->label('Siswa')->searchable(),
                TextColumn::make('kelas.nama_kelas')->label('Kelas'),
                TextColumn::make('tahun_ajaran'),
                TextColumn::make('semester')->formatStateUsing(fn (string $state) => ucfirst($state)),
            ])
            ->recordActions([EditAction::make(), DeleteAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageRapors::route('/'),
        ];
    }
}