<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Jumlah;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function getJumlah()
    {
        $jumlah_barang = Barang::select('barangs.id', 'barangs.nama_barang', 'barangs.kode_barang')
        ->leftJoin('jumlahs', 'barangs.id', '=', 'jumlahs.barang_id')->latest('jumlahs.total')->first();

        dd($jumlah_barang);
    }
}
