<?php

namespace App\Models;

use App\Models\Guru;
use App\Models\NilaiPerkembangan;
use App\Models\PesertaDidik;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class PerkembanganAnak extends Model
{
    use HasUuids;
    
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