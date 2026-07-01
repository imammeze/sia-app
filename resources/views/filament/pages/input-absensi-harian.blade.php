<x-filament-panels::page>
    <form wire:submit="simpanAbsensi">
        
        <div style="margin-bottom: 2rem;">
            {{ $this->form }}
        </div>

        @if(count($students) > 0)
            <x-filament::section>
                <x-slot name="heading">
                    Daftar Peserta Didik
                </x-slot>

                <div style="overflow-x: auto; margin-top: 1rem;">
                    <table style="width: 100%; text-align: left; border-collapse: collapse; min-width: 600px;">
                        <thead>
                            <tr style="border-bottom: 2px solid #e5e7eb;">
                                <th style="padding: 16px; font-weight: 600; font-size: 14px; width: 40%; color: #374151;">
                                    Nama Lengkap Siswa
                                </th>
                                <th style="padding: 16px; font-weight: 600; font-size: 14px; text-align: center; color: #16a34a;">
                                    Hadir
                                </th>
                                <th style="padding: 16px; font-weight: 600; font-size: 14px; text-align: center; color: #ca8a04;">
                                    Izin
                                </th>
                                <th style="padding: 16px; font-weight: 600; font-size: 14px; text-align: center; color: #2563eb;">
                                    Sakit
                                </th>
                                <th style="padding: 16px; font-weight: 600; font-size: 14px; text-align: center; color: #dc2626;">
                                    Alpa
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                            <tr style="border-bottom: 1px solid #f3f4f6;">
                                <td style="padding: 16px; font-size: 14px; font-weight: 500; color: #374151;">
                                    {{ $student->nama_lengkap }}
                                </td>
                                <td style="padding: 16px; text-align: center;">
                                    <input type="radio" wire:model="absensi.{{ $student->id }}" value="hadir" style="width: 20px; height: 20px; accent-color: #16a34a; cursor: pointer;">
                                </td>
                                <td style="padding: 16px; text-align: center;">
                                    <input type="radio" wire:model="absensi.{{ $student->id }}" value="izin" style="width: 20px; height: 20px; accent-color: #ca8a04; cursor: pointer;">
                                </td>
                                <td style="padding: 16px; text-align: center;">
                                    <input type="radio" wire:model="absensi.{{ $student->id }}" value="sakit" style="width: 20px; height: 20px; accent-color: #2563eb; cursor: pointer;">
                                </td>
                                <td style="padding: 16px; text-align: center;">
                                    <input type="radio" wire:model="absensi.{{ $student->id }}" value="alpa" style="width: 20px; height: 20px; accent-color: #dc2626; cursor: pointer;">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 1.5rem; border-top: 1px solid #e5e7eb; padding-top: 1.5rem; display: flex; justify-content: flex-end;">
                    <x-filament::button type="submit" size="lg" icon="heroicon-o-check-circle" color="primary">
                        Simpan Absensi Kelas
                    </x-filament::button>
                </div>
            </x-filament::section>

        @else
            <x-filament::section>
                <div style="text-align: center; padding: 3rem 0; color: #6b7280;">
                    <p style="font-size: 16px;">Pilih kelas pada form di atas terlebih dahulu untuk memunculkan daftar kehadiran peserta didik.</p>
                </div>
            </x-filament::section>
        @endif

    </form>
</x-filament-panels::page>