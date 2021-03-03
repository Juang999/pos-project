<?php

namespace App\Http\Controllers;

use App\User;
use App\Jumlah;
use App\Barang;
use App\Kategori;
use App\Supplier;
use App\Keuangan;
use App\Tabungan;
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
            $barang = Jumlah::where('barang_id', $key['barang_id'])->latest()->first('total');

            $jumlah = $barang->total - $key['jumlah'];

            try {
                $jumlah = Jumlah::create([
                    'barang_id' => $key['barang_id'],
                    'output' => $key['jumlah'],
                    'total' => $jumlah,
                ]);

                $update = Penjualan::where('id', $key['id'])->where('status', 0)->update(['status' => 1]);

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

    public function payMember(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'member_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendResponse('gagal', 'data gagal divalidasi', $validator->errors(), 500);
        }

        $pj = Auth::user()->id;

        $saldo_member = Tabungan::where('user_id', $request->member_id)->latest()->first('saldo');

        $total_belanja = Penjualan::where('pj', $pj)->where('status', 0)->get();

        $total_harga = $total_belanja->sum('harga');

        if ($total_harga > $saldo_member->saldo) {
            return response()->json('saldo anda tidak mencukupi!!!');
        }

        $harga_akhir = $saldo_member->saldo - $total_harga;

        $saldo_baru_member = Tabungan::create([
            'user_id' => $request->member_id,
            'credit' => $total_harga,
            'saldo' => $harga_akhir,
        ]);

        $keuangan_akhir = Keuangan::latest()->first('saldo');

        $total_keuangan = $keuangan_akhir->saldo + $total_harga;

        $keuangan = Keuangan::create([
            'pj' => $pj,
            'debit' => $total_harga,
            'saldo' => $total_keuangan,
        ]);

        foreach ($total_belanja as $key) {
            $update_belanja = Jumlah::where('barang_id', $key['barang_id'])->latest()->first('total');

            $jumlah = $update_belanja->total - $key['total'];

            try {
                $jumlah_akhir = Jumlah::create([
                    'barang_id' => $key['barang_id'],
                    'output' => $key['jumlah'],
                    'total' => $jumlah,
                ]);

                $update = Penjualan::where('id', $key['id'])->where('status', 0)->update(['status' => 1]);

            } catch (\Throwable $th) {
                return $this->sendResponse('gagal', 'data belanja gagal di update', $th->getMessage(), 500);
            }
        }

        $ids = $total_belanja->map(function($data) {
            return $data->id;
        });

        $result = Penjualan::whereIn('id', $ids)->with('Barang')->get();

        $data = [
            'item' => $result,
            'total_harga' => $total_harga,
            'sisa_saldo' => $harga_akhir,
        ];

        return $this->sendResponse('berhasil', 'transaksi berhasil', $data, 200);

    }

    public function inputSaldoMember(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_member' => 'required',
            'input_saldo' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendResponse('gagal', 'data gagal divalidasi', $validator->errors(), 500);
        }

        $id_member = User::where('kode_member', $request->kode_member)->first();

        $saldo_akhir = Tabungan::where('user_id', $id_member->id)->latest()->first('saldo');

        $tambah_saldo = $saldo_akhir->saldo + $request->input_saldo;

        try {
            $tambah_saldo_akhir = Tabungan::create([
                'user_id' => $id_member->id,
                'debit' => $request->input_saldo,
                'saldo' => $tambah_saldo,
            ]);

            return $this->sendResponse('berhasil', 'berhasil menambahkan saldo member', $tambah_saldo_akhir, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('gagal', 'gagal menambahkan saldo member', $th->getMessage(), 500);
        }

    }

    public function getHistory()
    {
        $pj = Auth::user()->id;

        $history = Penjualan::where('pj', $pj)->where('status', 1)->get();

        return $this->sendResponse('berhasil', 'history penjualan dirimu berhasil ditampilkan', $history, 200);
    }
}
