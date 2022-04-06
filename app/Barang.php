<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'goods_name',
        'category_id',
        'barcode',
        'unit_price',
        'selling_price',
        'status',
    ];

    public function Transaksi()
    {
        return $this->belongsTo('App\Transaksi');
    }

    public function Kategori()
    {
        return $this->belongsTo('App\Kategori');
    }

    public function Pembelian()
    {
        return $this->hasMany('App\Pembelian');
    }

    public function Supplier()
    {
        return $this->belongsTo('App\Supplier');
    }

    public function Penjualan()
    {
        return $this->hasMany('App\Penjualan');
    }

    public function Jumlah()
    {
        return $this->belongsTo('App\Jumlah');
    }

}
