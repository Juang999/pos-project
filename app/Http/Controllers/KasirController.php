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
            'barcode' => 'required',
            'jumlah' => 'required',
        ]);

        $pj = Auth::user()->id;

        if ($validator->fails()) {
            return $this->sendResponse('gagal', 'data gagal divalidasi', $validator->errors(), 500);
        }

        $id_barang = Barang::where('barcode', $request->barcode)->first();

        $harga = $id_barang->harga_jual * $request->jumlah;

        try {

            $barang = Penjualan::create([
                'pj' => $pj,
                'barang_id' => $id_barang->id,
                'jumlah' => $request->jumlah,
                'harga' => $harga,
                ]);

                $result = Penjualan::with('Barang')->find($barang->id);

            return $this->sendResponse('berhasil', 'transaksi berhasil dimasukkan kedalam keranjang', $result, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('gagal', 'transaksi gagal dimasukkan kedalam keranjang', $th->getMessage(), 500);
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
            'total_uang' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendResponse('gagal', 'transaksi gagal divalidasi', $validator->errors(), 500);
        }

        $pj = Auth::user()->id;

        $barang = Penjualan::where('pj', $pj)->where('status', 0)->get();

        $total_harga = $barang->sum('harga');

        $keuangan = Keuangan::latest()->first('saldo');

        $kembali = $request->total_uang - $total_harga;

        $tambahan = $keuangan->saldo + $total_harga;

        $input_keuntungan = Keuangan::create([
            'pj' => $pj,
            'input' => $total_harga,
            'saldo' => $tambahan,
        ]);

        foreach ($barang as $key) {
            $barangUpdate = Barang::where('id', $key['barang_id'])->first('jumlah');

            $kurang = $barangUpdate->jumlah - $key['jumlah'];

            try {
                $update_barang = Barang::where('id', $key['barang_id'])->update(['jumlah' => $kurang]);

                $update = Penjualan::where('id', $key['id'])->update(['status' => 1]);

            } catch (\Throwable $th) {
                return $this->sendResponse('gagal', 'transaksi gagal di lakukan', $th->getMessage(), 500);
            }
        }

        $ids = $barang->map(function($data){
            return $data->id;
        });

        $result = Penjualan::whereIn('id', $ids)->with('Barang')->get();

        $data = [
            'item' => $result,
            'total' => $total_harga,
            'total_uang' => $request->total_uang,
            'kembali' => $kembali,
        ];

        return $this->sendResponse('berhasil', 'penjualan berhasil', $data, 200);

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

        $barang_belanja = Penjualan::where('pj', $pj)->where('status', 0)->get();

        $total_harga = $barang_belanja->sum('harga');
        
        $saldo_member = Tabungan::where('user_id', $request->member_id)->latest()->first('saldo');

        if ($total_harga > $saldo_member->saldo) {
            return response()->json('saldo anda tidak mencukupi');
        }

        $saldo_akhir = $saldo_member->saldo - $total_harga;

        $tabungan_akhir = Tabungan::create([
            'user_id' => $request->member_id,
            'credit' => $total_harga,
            'saldo' => $saldo_akhir,
        ]);

        $keuangan = Keuangan::latest()->first('saldo');

        $saldo_keuangan = $keuangan->saldo + $total_harga;

        $keuangan_akhir = Keuangan::create([
            'pj' => $pj,
            'credit' => $total_harga,
            'saldo' => $saldo_keuangan,
        ]);

        foreach ($barang_belanja as $key) {

            $barangUpdate = Barang::where('id', $key['barang_id'])->first('jumlah');

            $kurangi = $barangUpdate->jumlah - $key['jumlah'];

            try {

                $barang_update = Barang::where('id', $key['barang_id'])->update(['jumlah' => $kurang1]);
                
                $statusUpdate = Penjualan::where('id', $key['id'])->update([
                    'status' => 1,
                    'member_id' => $request->member_id,
                ]);

            } catch (\Throwable $th) {
                return $this->sendResponse('gagal', 'transaksi gagal diupdate', $th->getMessage(), 500);
            }

        }

        $ids = $barang_belanja->map(function($data){
            return $data->id;
        });

        $result = Penjualan::whereIn('id', $ids)->with('Barang')->get();

        $Total_semua = [
            'item' => $result,
            'potongan_harga' => '10%',
            'total_harga' => $total_harga,
            'sisa_saldo' => saldo_akhir,
        ];

        return $this->sendResponse('berhasil', 'transaksi berhasil', $Total_semua, 200);

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
