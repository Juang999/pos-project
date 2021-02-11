<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jumlah extends Model
{
    public function Barang()
    {
        return $this->hasMany('App\Barang');
    }

    public function Supplier()
    {
        return $this->hasMany('App\Supplier');
    }
}
