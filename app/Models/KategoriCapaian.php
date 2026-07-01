<?php

namespace App\Models;

use App\Models\CapaianPembelajaran;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class KategoriCapaian extends Model
{
    use HasUuids;
    
    protected $guarded = ['id'];

    public function capaianPembelajaran()
    {
        return $this->hasMany(CapaianPembelajaran::class)->orderBy('urutan');
    }
}
