<?php

namespace App\Http\Controllers;

use App\Jumlah;
use App\Barang;
use App\Kategori;
use App\Supplier;
use App\Keuangan;
use App\Pembelian;
use App\Transaksi;
use App\Penjualan;
use App\DetailPenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KasirController extends Controller
{
    public function Store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jumlah' => 'required',
            'kode_barang' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendResponse('gagal', 'data gagal divalidasi', $validator->errors(), 501);
        }

        $pj = Auth::user()->id;

        $barang_id1 = Barang::where('kode_barang', $request->kode_barang)->first();

        $barang_id = $barang_id1->id;

        $harga = $barang_id1->harga * $request->jumlah;

        try {
            $belanja = Penjualan::create([
                'pj' => $pj,
                'barang_id' => $barang_id,
                'kode_barang' => $request->kode_barang,
                'jumlah' => $request->jumlah,
                'harga' => $harga,
            ])->with('Barang')->first();

            return $this->sendResponse('berhasil', 'barang belanja berhasil diinputkan ke table', $belanja, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('gagal', 'barang belanja gagal diinputkan ke table', $th->getMessage(), 500);
        }

    }

    public function getTotal()
    {
        $pj = Auth::user()->id;

        $belanja = Penjualan::where('pj', $pj)->where('status', 0)->get();

        $total = $belanja->sum('harga');

        $Total = [
            'item' => $belanja,
            'total' => $total,
        ];

        return $this->sendResponse('berhasil', 'total barang belanjaan berhasil ditampilkan', $Total, 200);
    }

    public function payTotal()
    {
        $pj = Auth::user()->id;

        $belanja = Pembelian::where('pj', $pj)->where('status', 0)->get();
    }
}
