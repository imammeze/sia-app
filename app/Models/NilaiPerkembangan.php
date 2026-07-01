<?php

namespace App\Models;

use App\Models\CapaianPembelajaran;
use App\Models\PerkembanganAnak;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class NilaiPerkembangan extends Model
{
    use HasUuids;
    
    protected $guarded = ['id'];

    public function perkembanganAnak()
    {
        return $this->belongsTo(PerkembanganAnak::class);
    }

    public function capaianPembelajaran()
    {
        return $this->belongsTo(CapaianPembelajaran::class);
    }
}
