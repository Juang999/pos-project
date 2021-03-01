<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    public function User()
    {
        return $this->belongsTo('App\User');
    }

    public function Barang()
    {
        return $this->hasMany('App\Barang', 'id', 'barang_id');
    }

    public function DetailPenjualan()
    {
        return $this->hasMany('App\DetailPenjualan');
    }

    public function Supplier()
    {
        return $this->belongsTo('App\Supplier');
    }

    protected $fillable = ['pj', 'status', 'barang_id', 'jumlah', 'harga'];
}
