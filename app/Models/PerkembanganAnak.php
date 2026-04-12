<?php

namespace App\Models;

use App\Models\Guru;
use App\Models\PesertaDidik;
use App\Models\Tema;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class PerkembanganAnak extends Model
{
    use HasUuids;
    
    protected $guarded = ['id'];

    public function pesertaDidik() { 
        return $this->belongsTo(PesertaDidik::class);
    }
    
    public function guru() { 
        return $this->belongsTo(Guru::class); 
    }
    
    public function tema() { 
        return $this->belongsTo(Tema::class);
    }
}