<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['kategori'];

    public function Barang()
    {
        return $this->hasMany('App\Barang');
    }
}
