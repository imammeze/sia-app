<?php

namespace App\Models;

use App\Traits\RestrictsSoftDeletes;
use App\Models\Guru;
use App\Models\NilaiPerkembangan;
use App\Models\PesertaDidik;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerkembanganAnak extends Model
{
    use RestrictsSoftDeletes;

    protected array $restrictSoftDeletes = [
        'nilaiPerkembangan' => 'Data PerkembanganAnak ini tidak bisa dimasukkan ke keranjang sampah karena masih memiliki relasi data nilaiPerkembangan.'
    ];


    use HasUuids, SoftDeletes;
    
    protected $guarded = ['id'];

    protected $casts = [
        'tinggi_badan' => 'decimal:2',
        'berat_badan' => 'decimal:2',
        'foto_kegiatan' => 'array',
    ];

    public function pesertaDidik() { 
        return $this->belongsTo(PesertaDidik::class);
    }
    
    public function guru() { 
        return $this->belongsTo(Guru::class); 
    }

    public function nilaiPerkembangan()
    {
        return $this->hasMany(NilaiPerkembangan::class);
    }
}