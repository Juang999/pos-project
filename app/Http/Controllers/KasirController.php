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

        // dd($barang_id1);

        $barang_id = $barang_id1->id;

        $harga = $barang_id1->harga * $request->jumlah;

        try {
            $belanja = Penjualan::create([
                'pj' => $pj,
                'barang_id' => $barang_id,
                'kode_barang' => $request->kode_barang,
                'jumlah' => $request->jumlah,
                'harga' => $harga,
            ]);

            $Belanja = [
                'item' => $belanja,
                'barang' => Barang::where('kode_barang', $belanja->kode_barang)->get(),
            ];

            return $this->sendResponse('berhasil', 'barang belanja berhasil diinputkan ke table', $Belanja, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('gagal', 'barang belanja gagal diinputkan ke table', $th->getMessage(), 500);
        }

    }

    public function getTotal()
    {
        $pj = Auth::user()->id;

        $belanja = Penjualan::where('pj', $pj)->where('status', 0)->with('Barang')->get();

        $total = $belanja->sum('harga');

        $Total = [
            'item' => $belanja,
            'total' => $total,
        ];

        return $this->sendResponse('berhasil', 'total barang belanjaan berhasil ditampilkan', $Total, 200);
    }

    public function payTotal(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'total_uang' => 'required',
        ]);

        $pj = Auth::user()->id;

        $belanja = Penjualan::where('pj', $pj)->where('status', 0)->with('Barang')->get();

        $total = $belanja->sum('harga');

        $kembali = $request->total_uang - $total;

        $akhir = Keuangan::latest()->first('saldo');

        $saldo = $akhir->saldo + $total;

        $keuangan = Keuangan::create([
            'pj' => $pj,
            'debit' => $total,
            'saldo' => $saldo,
        ]);

        foreach ($belanja as $key) {
            $barang = Jumlah::where('barang_id', $key['barang_id'])->first('total');

            $jumlah = $barang->total - $key['jumlah'];

            try {
                $jumlah = Jumlah::create([
                    'barang_id' => $key['barang_id'],
                    'input' => $key['input'],
                    'total' => $jumlah,
                ]);

                $update = Penjualan::where('id', $key['id'])->first();

                $update->update(['status' => 1]);

            } catch (\Throwable $th) {
                return $this->sendResponse('gagal', 'data gagal diinputkan', $th->getMessage(), 500);
            }
        }

        $ids = $belanja->map(function($data) {
            return $data->id;
        });

        $result = Penjualan::whereIn('id', $ids)->with('Barang')->get();

        $Total = [
            'item' => $result,
            'total' => $total,
            'uang' => $request->total_uang,
            'kembali' => $kembali,
        ];

        return $this->sendResponse('berhasil', 'data berhasil diinputkan', $Total, 200);
    }
}
