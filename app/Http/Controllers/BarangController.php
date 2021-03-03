<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Jumlah;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function getJumlah()
    {
        $jumlah_barang = Barang::with('Jumlah')->latest()->first();

        dd($jumlah_barang);
    }
}
