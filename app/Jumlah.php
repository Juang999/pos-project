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

    protected $fillable = ['barang_id', 'supplier_id', 'kode_barang_id', 'input', 'output', 'total'];
}
