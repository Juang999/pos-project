<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Supplier;
use App\Kategori;
use App\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function stafRead()
    {
        $barang = Barang::with('Supplier', 'Kategori')->get();

        $supplier = Supplier::all();

        $kategori = Kategori::all();

        $riwayat = Pembelian::with(['User', 'Barang'])->where('status', 1)->get();

        // dd($riwayat);

        return view('superadmin.index', compact('barang', 'supplier', 'kategori', 'riwayat'));
    }

    //showBarang

    //storeBarang
    public function createData(Request $request)
    {

        $request->validate([
            'nama_barang' => 'required',
            'supplier_id' => 'required',
            'kategori_id' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
        ]);

        try {

            Barang::create([
                'nama_barang' => $request->nama_barang,
                'supplier_id' => $request->supplier_id,
                'kategori_id' => $request->kategori_id,
                'harga_beli' => $request->harga_beli,
                'harga_jual' => $request->harga_jual,
                'barcode' => rand(),
            ]);

            return back()->with('status', 'barang berhasil diinput');

        } catch (\Throwable $th) {
            return back()->with('status', 'barang gagal diinputkan');
        }
    }

    //updateBarang

    //deleteBarang
    public function stafDelete($id)
    {
        try {
            Barang::where('id', $id)->delete();

            return back()->with('status', 'barang berhasil dihapus');
        } catch (\Throwable $th) {
            return back()->with('status', 'barang gagal dihapus');
        }
    }
}
