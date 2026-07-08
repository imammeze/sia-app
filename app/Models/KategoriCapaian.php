<?php

namespace App\Models;

use App\Traits\RestrictsSoftDeletes;
use App\Models\CapaianPembelajaran;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriCapaian extends Model
{
    use RestrictsSoftDeletes;

    protected array $restrictSoftDeletes = [
        'capaianPembelajaran' => 'Data KategoriCapaian ini tidak bisa dimasukkan ke keranjang sampah karena masih memiliki relasi data capaianPembelajaran.'
    ];


    use HasUuids, SoftDeletes;
    
    protected $guarded = ['id'];

    public function capaianPembelajaran()
    {
        return $this->hasMany(CapaianPembelajaran::class)->orderBy('urutan');
    }
}
