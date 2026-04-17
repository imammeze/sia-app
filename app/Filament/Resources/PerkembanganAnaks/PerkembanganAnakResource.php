<?php

namespace App\Filament\Resources\PerkembanganAnaks;

use App\Filament\Resources\PerkembanganAnaks\Pages\ManagePerkembanganAnaks;
use App\Models\PerkembanganAnak;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class PerkembanganAnakResource extends Resource
{
    protected static ?string $model = PerkembanganAnak::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

    public static function getNavigationGroup(): ?string { return 'Akademik'; }
    public static function getNavigationLabel(): string { return 'Perkembangan Anak'; }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Penilaian Perkembangan')->schema([
                    Select::make('peserta_didik_id')
                        ->relationship('pesertaDidik', 'nama_lengkap')
                        ->label('Peserta Didik')
                        ->searchable()
                        ->required(),
                    Select::make('guru_id')
                        ->relationship('guru', 'nama_lengkap')
                        ->label('Guru Penilai')
                        ->default(fn () => Auth::user()->guru?->id)
                        ->searchable()
                        ->required(),
                    Select::make('tema_id')
                        ->relationship('tema', 'nama_tema')
                        ->label('Tema Pembelajaran')
                        ->searchable(),
                    DatePicker::make('tanggal')
                        ->default(now())
                        ->required(),
                    Select::make('aspek_perkembangan')
                        ->options([
                            'nilai_agama_moral' => 'Nilai Agama & Moral',
                            'fisik_motorik' => 'Fisik Motorik',
                            'kognitif' => 'Kognitif',
                            'bahasa' => 'Bahasa',
                            'sosial_emosional' => 'Sosial Emosional',
                            'seni' => 'Seni',
                        ])
                        ->required(),
                    Textarea::make('catatan')
                        ->label('Catatan Perkembangan')
                        ->required()
                        ->columnSpanFull(),
                ])->columnspanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tanggal')->date()->sortable(),
                TextColumn::make('pesertaDidik.nama_lengkap')->label('Siswa')->searchable(),
                TextColumn::make('aspek_perkembangan')->formatStateUsing(fn (string $state) => ucwords(str_replace('_', ' ', $state))),
                TextColumn::make('tema.nama_tema')->label('Tema'),
                TextColumn::make('guru.nama_lengkap')->label('Penilai'),
            ])
            ->defaultSort('tanggal', 'desc')
            ->recordActions([EditAction::make(), DeleteAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManagePerkembanganAnaks::route('/'),
        ];
    }
}