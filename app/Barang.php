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

    protected $fillable = ['kategori_id', 'nama_barang', 'kode_barang', 'harga'];

    public function Pembelian()
    {
        return $this->hasMany('App\PembelianP');
    }

    public function Supplier()
    {
        return $this->belongsTo('App\Supplier');
    }

}
