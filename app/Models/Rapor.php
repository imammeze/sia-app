<?php

namespace App\Models;

use App\Models\Kelas;
use App\Models\PesertaDidik;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rapor extends Model
{
    use HasUuids, SoftDeletes;
    protected $guarded = ['id'];

    public function pesertaDidik() { 
        return $this->belongsTo(PesertaDidik::class); 
    }
    
    public function kelas() { 
        return $this->belongsTo(Kelas::class); 
    }
}