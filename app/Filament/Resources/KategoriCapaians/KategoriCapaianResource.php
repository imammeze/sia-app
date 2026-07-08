<?php

namespace App\Filament\Resources\KategoriCapaians;

use App\Filament\Resources\KategoriCapaians\Pages\ManageKategoriCapaians;
use App\Models\KategoriCapaian;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Repeater;
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

class KategoriCapaianResource extends Resource
{
    protected static ?string $model = KategoriCapaian::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    protected static ?string $modelLabel = 'Data Kategori Capaian';
    protected static ?string $pluralModelLabel = 'Data Kategori Capaian';
    public static function getNavigationGroup(): ?string { return 'Akademik'; }
    public static function getNavigationLabel(): string { return 'Kategori Capaian'; }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->heading('Informasi Kategori')->schema([
                    TextInput::make('nama_kategori')
                        ->label('Nama Kategori')
                        ->placeholder('Contoh: Nilai Agama dan Budi Pekerti')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('urutan')
                        ->label('Urutan')
                        ->numeric()
                        ->default(0)
                        ->required(),
                    TextInput::make('judul_capaian')
                        ->label('Judul Capaian')
                        ->placeholder('Contoh: Anak percaya kepada Tuhan Yang Maha Esa')
                        ->maxLength(255)
                        ->columnSpanFull(), 
                ])
                ->columns(2)
                ->columnSpanFull(),

                Section::make()->heading('Capaian Pembelajaran')->schema([
                    Repeater::make('capaianPembelajaran')
                        ->relationship('capaianPembelajaran')
                        ->label('')
                        ->schema([
                            Textarea::make('deskripsi')
                                ->label('Deskripsi Capaian Pembelajaran')
                                ->placeholder('Tuliskan deskripsi capaian pembelajaran...')
                                ->required()
                                ->maxLength(50)
                                ->validationMessages(['max' => 'Maksimal 50 karakter'])
                                ->rows(2),
                            TextInput::make('urutan')
                                ->label('Urutan')
                                ->numeric()
                                ->default(0)
                                ->required(),
                        ])
                        ->columns(1)
                        ->defaultItems(1)
                        ->addActionLabel('+ Tambah Capaian Pembelajaran')
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['deskripsi'] ?? 'Capaian Baru')
                        ->columnSpanFull(),
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('urutan')->label('No')->sortable(),
                TextColumn::make('nama_kategori')->label('Nama Kategori')->searchable(),
                TextColumn::make('capaian_pembelajaran_count')
                    ->counts('capaianPembelajaran')
                    ->label('Jumlah Capaian'),
            ])
            ->defaultSort('urutan', 'asc')
            ->filters([
                \Filament\Tables\Filters\TrashedFilter::make(),
            ])
            ->recordActions([
                RestoreAction::make(),
                ForceDeleteAction::make(),EditAction::make(), DeleteAction::make()])
            ->toolbarActions([BulkActionGroup::make([
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make(),DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageKategoriCapaians::route('/'),
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
