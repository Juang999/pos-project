<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    public function Transaksi()
    {
        return $this->belongsTo('App\Transaksi');
    }

    public function Kategori()
    {
        return $this->hasMany('App\Kategori');
    }
}
