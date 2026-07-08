<?php

namespace App\Models;

use App\Traits\RestrictsSoftDeletes;
use App\Models\Guru;
use App\Models\PesertaDidik;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use RestrictsSoftDeletes;

    protected array $restrictSoftDeletes = [
        'pesertaDidik' => 'Data Kelas ini tidak bisa dimasukkan ke keranjang sampah karena masih memiliki relasi data pesertaDidik.'
    ];


    use HasUuids, SoftDeletes;
    protected $guarded = ['id'];

    public function waliKelas() { 
        return $this->belongsTo(Guru::class, 'guru_id'); 
    }
    
    public function pesertaDidik() { 
        return $this->hasMany(PesertaDidik::class);
    }
}