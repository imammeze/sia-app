<?php

namespace App\Models;

use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\PerkembanganAnak;
use App\Models\Rapor;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class PesertaDidik extends Model
{
    use HasUuids;
    protected $guarded = ['id'];

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