<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['supplier_name', 'address', 'phone_number'];

    protected $guarded = [];

    public function Jumlah()
    {
        return $this->belongsTo('App\Jumlah');
    }

    public function Pembelian()
    {
        return $this->hasMany('App\Barang');
    }

    public function Barang()
    {
        return $this->hasMany('App\Barang');
    }
}
