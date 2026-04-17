<?php

namespace App\Filament\Resources\Absensis;

use App\Filament\Resources\Absensis\Pages\ManageAbsensis;
use App\Models\Absensi;
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

class AbsensiResource extends Resource
{
    protected static ?string $model = Absensi::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;

    public static function getNavigationGroup(): ?string { return 'Akademik'; }
    public static function getNavigationLabel(): string { return 'Absensi Harian'; }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Form Absensi')->schema([
                    Select::make('peserta_didik_id')
                        ->relationship('pesertaDidik', 'nama_lengkap')
                        ->label('Nama Peserta Didik')
                        ->searchable()
                        ->preload()
                        ->required(),
                    DatePicker::make('tanggal')
                        ->default(now())
                        ->required(),
                    Select::make('status')
                        ->options([
                            'hadir' => 'Hadir',
                            'izin' => 'Izin',
                            'sakit' => 'Sakit',
                            'alpa' => 'Alpa',
                        ])
                        ->required(),
                    Textarea::make('keterangan')
                        ->placeholder('Catatan tambahan jika sakit/izin...')
                        ->columnSpanFull(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tanggal')->date()->sortable(),
                TextColumn::make('pesertaDidik.nama_lengkap')->label('Peserta Didik')->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'hadir' => 'success',
                        'izin' => 'warning',
                        'sakit' => 'info',
                        'alpa' => 'danger',
                    }),
                TextColumn::make('keterangan')->limit(30),
            ])
            ->defaultSort('tanggal', 'desc')
            ->recordActions([EditAction::make(), DeleteAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageAbsensis::route('/'),
        ];
    }
}