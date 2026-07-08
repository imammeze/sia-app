<?php

namespace App\Models;

use App\Traits\RestrictsSoftDeletes;
use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\PerkembanganAnak;
use App\Models\Rapor;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PesertaDidik extends Model
{
    use RestrictsSoftDeletes;

    protected array $restrictSoftDeletes = [
        'absensi' => 'Data PesertaDidik ini tidak bisa dimasukkan ke keranjang sampah karena masih memiliki relasi data absensi.',
        'perkembanganAnak' => 'Data PesertaDidik ini tidak bisa dimasukkan ke keranjang sampah karena masih memiliki relasi data perkembanganAnak.',
        'rapor' => 'Data PesertaDidik ini tidak bisa dimasukkan ke keranjang sampah karena masih memiliki relasi data rapor.'
    ];


    use HasUuids, SoftDeletes;
    protected $guarded = ['id'];

    public function alamat() {
        return $this->belongsTo(Alamat::class);
    }

    public function orang_tua() {
        return $this->belongsTo(OrangTua::class);
    }

    public function data_periodik() {
        return $this->belongsTo(DataPeriodik::class);
    }

    public function kelas() { 
        return $this->belongsTo(Kelas::class); 
    }
    
    public function absensi() { 
        return $this->hasMany(Absensi::class); 
    }

    public function perkembanganAnak() { 
        return $this->hasMany(PerkembanganAnak::class); 
    }

    public function rapor() { 
        return $this->hasMany(Rapor::class); 
    }
}