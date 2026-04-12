<?php

namespace App\Models;

use App\Models\Guru;
use App\Models\PesertaDidik;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasUuids;
    protected $guarded = ['id'];

    public function waliKelas() { 
        return $this->belongsTo(Guru::class, 'guru_id'); 
    }
    
    public function pesertaDidik() { 
        return $this->hasMany(PesertaDidik::class);
    }
}