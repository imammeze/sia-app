<?php

namespace App\Models;

use App\Models\KategoriCapaian;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CapaianPembelajaran extends Model
{
    use HasUuids, SoftDeletes;
    
    protected $guarded = ['id'];

    public function kategoriCapaian()
    {
        return $this->belongsTo(KategoriCapaian::class);
    }
}
