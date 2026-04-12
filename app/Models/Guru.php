<?php

namespace App\Models;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasUuids;
    protected $guarded = ['id'];

    public function user() { 
        return $this->belongsTo(User::class); 
    }
    
    public function kelas() { 
        return $this->hasMany(Kelas::class); 
    }
}