<?php

namespace App\Http\Controllers;

use App\Jumlah;
use App\Barang;
use App\Kategori;
use App\Supplier;
use App\Transaksi;
use BarangSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class StafController extends Controller
{
    public function index()
    {
        $supplier = Supplier::select('id', 'supplier')->get();

        return $this->sendResponse('berhasil', 'data supplier berhasil ditampilkan', $supplier, 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'supplier' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendResponse('gagal', 'data gagal divalidasi', $validator->errors(), 501);
        }


        try {
            $supplier = Supplier::create([
                'supplier' => $request->get('supplier'),
                'alamat' => $request->get('alamat'),
                'nomor_telepon' => $request->get('nomor_telepon'),
            ]);

            return $this->sendResponse('berhasil', 'data supplier berhasil diinputkan', $supplier, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('gagal', 'data gagal diinputkan', $th->getMessage(), 500);
        }

    }

    public function createGoods(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'input' => 'required',
            'debit' => 'required',
            'saldo' => 'required',
            'kredit' => 'required',
            'keterangan' => 'required',
            'kategori_id' => 'required',
            'supplier_id' => 'required',
            'nama_barang' => 'required',
            'kode_barang' => 'required',
            'harga_satuan' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendResponse('gagal', 'data gagal divalidasi', $validator->errors(), 500);
        }

        if (count($request->nama_barang) > 0) {
            foreach ($request as $item) {
                $barang = [
                    'kategori_id' => $item['kategori_id'],
                ];
            }
        }

    }

    public function postCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendResponse('gagal', 'data gagal divalidasi', $validator->errors(), 501);
        }

        try {
            $Kategori = Kategori::create([
                'kategori' => $request->get('kategori'),
            ]);

            return $this->sendResponse('berhasil', 'kategori berhasil ditambahkan', $Kategori, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('gagal', 'kategori gagal ditambahkan', $th->getMessage(), 501);
        }
    }

    public function getCategory()
    {
        $Kategori = Kategori::all();

        return $this->sendResponse('berhasil', 'kategori data berhasil ditampilkan', $Kategori, 200);
    }

}
