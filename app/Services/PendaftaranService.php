<?php

namespace App\Services;

use App\Models\Alamat;
use App\Models\OrangTua;
use App\Models\DataPeriodik;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\DB;

class PendaftaranService
{
    /**
     * Handle the registration of a new student (Pendaftaran).
     *
     * @param array $data
     * @return Pendaftaran
     */
    public function registerPendaftaran(array $data): Pendaftaran
    {
        $datePrefix = now()->format('dmY'); 
        $lastPendaftaran = Pendaftaran::whereDate('created_at', now()->today())
                            ->orderBy('id', 'desc')
                            ->first();

        if ($lastPendaftaran) {
            $lastNumber = (int) substr($lastPendaftaran->no_pendaftaran, -3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        $no_pendaftaran = 'REG-' . $datePrefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        return DB::transaction(function () use ($data, $no_pendaftaran) {
            $alamat = Alamat::create([
                'alamat_jalan' => $data['alamat_jalan'] ?? null,
                'kelurahan_desa' => $data['kelurahan_desa'] ?? null,
                'kecamatan' => $data['kecamatan'] ?? null,
                'kabupaten_kota' => $data['kabupaten_kota'] ?? null,
                'provinsi' => $data['provinsi'] ?? null,
                'alat_transportasi' => $data['alat_transportasi'] ?? null,
            ]);

            $orangTua = OrangTua::create([
                'no_hp' => $data['no_hp'] ?? null,
                'nama_ayah' => $data['nama_ayah'] ?? null,
                'tahun_lahir_ayah' => $data['tahun_lahir_ayah'] ?? null,
                'pendidikan_ayah' => $data['pendidikan_ayah'] ?? null,
                'pekerjaan_ayah' => $data['pekerjaan_ayah'] ?? null,
                'nama_ibu' => $data['nama_ibu'] ?? null,
                'tahun_lahir_ibu' => $data['tahun_lahir_ibu'] ?? null,
                'pendidikan_ibu' => $data['pendidikan_ibu'] ?? null,
                'pekerjaan_ibu' => $data['pekerjaan_ibu'] ?? null,
            ]);

            $dataPeriodik = DataPeriodik::create([
                'tinggi_badan' => $data['tinggi_badan'] ?? null,
                'berat_badan' => $data['berat_badan'] ?? null,
                'jumlah_saudara_kandung' => $data['jumlah_saudara_kandung'] ?? null,
                'jarak_ke_sekolah' => $data['jarak_ke_sekolah'] ?? null,
            ]);

            return Pendaftaran::create([
                'no_pendaftaran' => $no_pendaftaran,
                'status' => 'pending',
                'tanggal_daftar' => now(),
                'nama_lengkap' => $data['nama_lengkap'] ?? null,
                'jenis_kelamin' => $data['jenis_kelamin'] ?? null,
                'agama' => $data['agama'] ?? null,
                'tempat_lahir' => $data['tempat_lahir'] ?? null,
                'tanggal_lahir' => $data['tanggal_lahir'] ?? null,
                'nik' => $data['nik'] ?? null,
                'no_registrasi_akta_lahir' => $data['no_registrasi_akta_lahir'] ?? null,
                'alamat_id' => $alamat->id,
                'orang_tua_id' => $orangTua->id,
                'data_periodik_id' => $dataPeriodik->id,
            ]);
        });
    }
}
