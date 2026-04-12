<?php

namespace App\Models;

use App\Models\PerkembanganAnak;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    use HasUuids;
    
    protected $guarded = ['id'];

    public function perkembanganAnak()
    {
        return $this->hasMany(PerkembanganAnak::class);
    }
}