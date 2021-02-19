<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $fillable = ['penjualan_id'];

    public function Pembelian()
    {
        return $this->belongsTo('App\Pembelian');
    }

    public function User()
    {
        return $this->belongsTo('App\User');
    }
}
