<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $fillable = ['member_id', 'pj', 'barang_id', 'jumlah', 'harga'];

    public function User()
    {
        return $this->belongsTo('App\User');
    }

    public function Barang()
    {
        return $this->hasMany('App\Barang', 'id', 'barang_id');
    }
}
