<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'alamat_jalan', 'dusun', 'rt', 'rw', 'kelurahan_desa', 'kecamatan',
        'kabupaten_kota', 'provinsi', 'kode_pos', 'jenis_tinggal',
        'alat_transportasi', 'jarak_ke_sekolah', 'waktu_tempuh',
    ];
}
