<?php

namespace App\Models;

use App\Traits\RestrictsSoftDeletes;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guru extends Model
{
    use RestrictsSoftDeletes;

    protected array $restrictSoftDeletes = [
        'kelas' => 'Data Guru ini tidak bisa dimasukkan ke keranjang sampah karena masih memiliki relasi data kelas.'
    ];


    use HasUuids, SoftDeletes;
    protected $guarded = ['id'];

    public function user() { 
        return $this->belongsTo(User::class); 
    }
    
    public function kelas() { 
        return $this->hasMany(Kelas::class); 
    }
}