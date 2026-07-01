<?php

namespace App\Filament\Pages;

use App\Models\Absensi; 
use App\Models\Kelas;
use App\Models\PesertaDidik;
use BackedEnum;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class InputAbsensiHarian extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static bool $shouldRegisterNavigation = false;
    
    public static function canAccess(): bool
    {
        return Auth::user()->can('create_absensi');
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Akademik';
    }
    protected string $view = 'filament.pages.input-absensi-harian';
    
    public static function getNavigationLabel(): string
    {
        return 'Input Absensi Kelas';
    }

    public ?array $data = [];
    public $students = [];
    public $absensi = []; 

    public function mount(): void
    {
        $defaultKelasId = null;
        $namaKelas = null;
        $user = Auth::user();
        
        // Auto-select kelas jika user terhubung dengan entitas guru
        if ($user->guru) {
            $kelas = Kelas::where('guru_id', $user->guru->id)->first();
            if ($kelas) {
                $defaultKelasId = $kelas->id;
                $namaKelas = $kelas->nama_kelas;
            }
        }

        $this->form->fill([
            'tanggal' => now()->format('Y-m-d'),
            'kelas_id' => $defaultKelasId,
            'kelas_nama' => $namaKelas ?? 'Tidak ada kelas',
        ]);

        // Langsung tampilkan daftar siswa jika kelas sudah diset
        if ($defaultKelasId) {
            $this->loadStudents($defaultKelasId);
        }
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                DatePicker::make('tanggal')
                    ->label('Tanggal Absensi')
                    ->required()
                    ->maxDate(now())
                    ->live()
                    ->afterStateUpdated(function ($state, $livewire) {
                        if (isset($livewire->data['kelas_id']) && $livewire->data['kelas_id']) {
                            $livewire->loadStudents($livewire->data['kelas_id']);
                        }
                    }), 

                \Filament\Forms\Components\Hidden::make('kelas_id'),
                \Filament\Forms\Components\TextInput::make('kelas_nama')
                    ->label('Kelas Anda')
                    ->disabled()
                    ->dehydrated(false),
            ])
            ->columns(2)
            ->statePath('data');
    }

    public function loadStudents($kelasId)
    {
        $tanggal = $this->data['tanggal'] ?? now()->format('Y-m-d');
        $this->students = PesertaDidik::where('kelas_id', $kelasId)->orderBy('nama_lengkap', 'asc')->get();
        $this->absensi = [];
        
        $existingAbsensi = Absensi::whereIn('peserta_didik_id', $this->students->pluck('id'))
            ->where('tanggal', $tanggal)
            ->get()
            ->keyBy('peserta_didik_id');

        foreach ($this->students as $student) {
            if ($existingAbsensi->has($student->id)) {
                $this->absensi[$student->id] = $existingAbsensi[$student->id]->status;
            } else {
                $this->absensi[$student->id] = 'hadir';
            }
        }
    }

    public function simpanAbsensi()
    {
        $tanggal = $this->data['tanggal'];

        foreach ($this->absensi as $peserta_didik_id => $status) {
            Absensi::updateOrCreate(
                [
                    'peserta_didik_id' => $peserta_didik_id,
                    'tanggal' => $tanggal,
                ],
                [
                    'status' => $status,
                    'keterangan' => null
                ]
            );
        }
        
        Notification::make()
            ->title('Berhasil!')
            ->body('Data absensi kelas berhasil disimpan.')
            ->success()
            ->send();
        // $this->students = [];
    } 
}