<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Supplier;
use App\Kategori;
use App\Keuangan;
use App\Output;
use App\Pembelian;
use App\Penjualan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function getStaf()
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

    public function showData($id)
    {
        $barang = Barang::where('id', $id)->first();

        $supplier = Supplier::all();

        $kategori = Kategori::all();

        return view('superadmin.edit', compact('barang', 'supplier', 'kategori'));
    }

    public function editData(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'nama_barang' => 'required',
            'supplier_id'  => 'required',
            'kategori_id' => 'required',
            'jumlah' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
        ]);

        try {
            Barang::where('id', $id)->update([
                'nama_barang' => $request->nama_barang,
                'supplier_id' => $request->supplier_id,
                'kategori_id' => $request->kategori_id,
                'jumlah' => $request->jumlah,
                'harga_beli' => $request->harga_beli,
                'harga_jual' => $request->harga_jual,
            ]);

            return redirect('/super-admin/staf/')->with('status', 'Barang berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect('/super-admin/staf/')->with('status', $th->getMessage());
        }
    }

    public function createSupplier()
    {
        return view('superadmin.createSupplier');
    }

    public function storeSupplier(Request $request)
    {
        $request->validate([
            'supplier' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => 'required'
        ]);

        try {
            Supplier::create([
                'supplier' => $request->supplier,
                'alamat' => $request->alamat,
                'nomor_telepon' => $request->nomor_telepon
            ]);

            return redirect('/super-admin/staf/')->with('status', 'Supplier Berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect('/super-admin/staf/')->with('status', $th->getMessage());
        }
    }

    public function deleteSupplier($id)
    {
        try {
        Supplier::where('id', $id)->delete();

            return redirect('/super-admin/staf/')->with('status', 'supplier berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect('/super-admin/staf')->with('status', $th->getMessage());
        }
    }

    public function showSupplier($id)
    {
        $supplier = Supplier::where('id', $id)->first();

        return view('superadmin.showSupplier', compact('supplier'));
    }

    public function editSupplier(Request $request, $id)
    {
        $request->validate([
            'supplier' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => 'required',
        ]);

        try {

            Supplier::where('id', $id)->update([
                'supplier' => $request->supplier,
                'alamat' => $request->alamat,
                'nomor_telepon' => $request->nomor_telepon,
            ]);

            return redirect('/super-admin/staf/')->with('status', 'supplier berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect('/super-admin/staf/')->with('status', $th->getMessage());
        }
    }

    public function createkategori()
    {
        return view('superadmin.createKategori');
    }

    public function storeKategori(Request $request)
    {
        $request->validate([
            'kategori' => 'required'
        ]);

        try {
            Kategori::create([
                'kategori' => $request->kategori,
            ]);

            return redirect('/super-admin/staf/')->with('status', 'Kategori berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect('super-admin/staf/')->with('status', $th->getMessage());
        }
    }

    public function deleteKategori($id)
    {
        try {
            Kategori::where('id', $id)->delete();

            return redirect('/super-admin/staf/')->with('status', 'Kategori berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect('/super-admin/staf/')->with('status', $th->getMessage());
        }
    }

    public function showKategori($id)
    {
        $kategori = Kategori::where('id', $id)->first();

        return view('superadmin.showKategori', compact('kategori'));
    }

    public function editKategori(Request $request, $id)
    {
        $request->validate([
            'kategori' => 'required'
        ]);

        try {
            Kategori::where('id', $id)->update([
                'kategori' => $request->kategori
            ]);

            return redirect('/super-admin/staf/')->with('status', 'kategori berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect('/super-admin/staf/')->with('status', $th->getMessage());
        }
    }

    public function getOfficer()
    {
        $my_id = Auth::user()->id;

        $officer = User::where('role', '!=', 5)->where('role', '!=', 1)->get();

        return view('superadmin.officer', compact('officer'));
    }

    public function createOfficer()
    {
        return view('superadmin.createOfficer');
    }

    public function storeOfficer(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nomor_telepon' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
        ]);

        if ($request->password != $request->password_confirmation) {
            return back()->with('status', 'konfirmasi password salah');
        }

        try {
            User::create([
                'name' => $request->name,
                'nomor_telepon' => $request->nomor_telepon,
                'email' => $request->email,
                'password' => $request->password,
                'role' => $request->role
            ]);

            return redirect('/super-admin/officer')->with('status', 'karyawan berhasil didaftarkan');
        } catch (\Throwable $th) {
            return redirect('/super-admin/officer')->with('status', $th->getMessage());
        }
    }

    public function deleteOfficer($id)
    {
        try {
            User::where('id', $id)->delete();

            return back()->with('status', 'karyawan berhasil dihapus');
        } catch (\Throwable $th) {
            return back()->with('status', $th->getMessage());
        }
    }

    public function showOfficer($id)
    {
        $officer = User::where('id', $id)->first();

        return view('superadmin.showOfficer', compact('officer'));
    }

    public function editOfficer(Request $request, $id)
    {
        // dd($request);

        $request->validate([
            'name' => 'required',
            'nomor_telepon' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);

        try {
            User::where('id', $id)->update([
                'name' => $request->name,
                'nomor_telepon' => $request->nomor_telepon,
                'email' => $request->email,
                'role' => $request->role,
            ]);

            return redirect('/super-admin/officer')->with('status', 'karyawan berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect('/super-admin/officer')->with('status', $th->getMessage());
        }
    }

    public function getTransaction()
    {
        $pembelian = Pembelian::where('status', 1)->get();

        $penjualan = Penjualan::where('status', 1)->get();

        $debit = Keuangan::sum('debit');

        $credit = Keuangan::sum('credit');

        $saldo = Keuangan::latest()->first();

        $output = Output::all();

        // dd($output);

        return view('superadmin.transaction', compact('pembelian', 'penjualan', 'debit', 'credit', 'saldo', 'output'));
    }

    public function createTransaction(Request $request)
    {
        return view('superadmin.createTransaction');
    }

    public function storeTransaction(Request $request)
    {
        $request->validate([
            'keterangan' => 'required',
            'jumlah' => 'required',
            'total' => 'required',
        ]);

        $saldo = Keuangan::latest()->first();

        if ($request->total > $saldo->saldo) {
            return redirect('/super-admin/createTransaction')->with('status', 'Keuangan Perusahaan tidak mencukupi');
        }

        $pj = Auth::user()->id;

        $kurang = $saldo->saldo - $request->total;

        try {

            Output::create([
                'pj' => $pj,
                'pengeluaran' => $request->total,
                'jumlah' => $request->jumlah,
                'keterangan' => $request->keterangan,
            ]);

            Keuangan::create([
                'pj' => $pj,
                'credit' => $request->total,
                'saldo' => $kurang,
            ]);

            return redirect('/super-admin/transaction')->with('status', 'data pengeluaran berhasil diinputkan');

        } catch (\Throwable $th) {
            return redirect('/super-admin/transaction')->with('status', $th->getMessage());
        }
    }

    public function deleteTransaction($id)
    {

        $pj_id = Output::where('id', $id)->first();

        try {
        DB::beginTransaction();

        $output = Output::where('id', $id)->delete();

        $keuangan_id = Keuangan::where('pj', $pj_id->pj)->latest()->first();

        $hasil = Keuangan::where('id', $keuangan_id->id)->delete();

        DB::commit();

        return redirect('/super-admin/transaction')->with('status', 'data berhasil dihapus');
        } catch (\Throwable $th) {
        DB::rollback();
        return redirect('/super-admin/transaction')->with('status', $th->getMessage());
        }
    }

    public function showTransaction($id)
    {
        $trans = Output::where('id', $id)->first();

        return view('superadmin.showTransaction', compact('trans'));
    }

    public function editTransaction(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required',
            'jumlah' => 'required',
            'pengeluaran' => 'required',
        ]);

        $pengeluaran = Output::where('id', $id)->first();

        if ($request->pengeluaran > $pengeluaran->pengeluaran) {

        }
    }
}
