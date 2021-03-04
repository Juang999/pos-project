<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Jumlah;
use App\Supplier;
use App\Kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function getJumlah()
    {
        $jumlah_awal = Barang::select(
            'id',
            'nama_barang',
            'jumlah',
            'barcode',
            'supplier_id',
            'kategori_id',
            'harga_beli',
            'harga_jual'
            )->with('Kategori', 'Supplier')->get();

        return $this->sendResponse('berhasil', 'jumlah barang berhasil ditampilkan', $jumlah_awal, 200);
    }
}
