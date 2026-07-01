<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasUuids;
   
    protected $guarded = ['id'];

    public function alamat() {
        return $this->belongsTo(Alamat::class);
    }

    public function orang_tua() {
        return $this->belongsTo(OrangTua::class);
    }

    public function data_periodik() {
        return $this->belongsTo(DataPeriodik::class);
    }
}