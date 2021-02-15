<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    public function User()
    {
        return $this->hasMany('App\User');
    }

    public function Barang()
    {
        return $this->hasMany('App\Barang');
    }

    protected $fillable = ['member_id', 'pj', 'kode_barang', 'keterangan', 'debit', 'credit', 'saldo'];
}
