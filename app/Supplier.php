<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['supplier', 'alamat', 'nomor_telepon'];

    public function Jumlah()
    {
        return $this->belongsTo('App\Jumlah');
    }
}
