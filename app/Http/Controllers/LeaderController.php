<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Jumlah;
use App\Penjualan;
use App\Pembelian;
use Illuminate\Http\Request;

class LeaderController extends Controller
{
    public function getTransPenjualan()
    {
        $transPenjualan = Penjualan::where('status', 1)->get();

        return $this->sendResponse('berhasil', 'history transaksi penjualan berhasil ditampilkan', $transPenjualan, 200);
    }

    public function getTransPembelian()
    {
        $transPembelian = Pembelian::where('status', 1)->get();

        return $this->sendResponse('berhasil', 'history transaksi pembelian berhasil ditampilkan', $transPembelian, 200);
    }
}
