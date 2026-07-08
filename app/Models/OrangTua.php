<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrangTua extends Model
{
    use SoftDeletes;
    use HasFactory, HasUuids;

    protected $fillable = [
        'no_hp', 'email_pribadi',
        'nama_ayah', 'tahun_lahir_ayah', 'pendidikan_ayah', 'pekerjaan_ayah', 'penghasilan_ayah', 'berkebutuhan_khusus_ayah',
        'nama_ibu', 'tahun_lahir_ibu', 'pendidikan_ibu', 'pekerjaan_ibu', 'penghasilan_ibu', 'berkebutuhan_khusus_ibu',
    ];
}
