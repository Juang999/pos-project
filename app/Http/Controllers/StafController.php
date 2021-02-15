<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class StafController extends Controller
{
    public function index()
    {
        $supplier = Supplier::all();

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
}
