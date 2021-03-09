<?php

namespace App\Http\Controllers;

use App\Absensi;
use App\Barang;
use App\Jumlah;
use App\Penjualan;
use App\Pembelian;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Null_;

class LeaderController extends Controller
{
    public function getTransPenjualan()
    {
        $transPenjualan = Penjualan::where('status', 1)->with('Barang')->get();

        return $this->sendResponse('berhasil', 'history transaksi penjualan berhasil ditampilkan', $transPenjualan, 200);
    }

    public function getTransPembelian()
    {
        $transPembelian = Pembelian::where('status', 1)->with('Barang')->get();

        return $this->sendResponse('berhasil', 'history transaksi pembelian berhasil ditampilkan', $transPembelian, 200);
    }

    public function registerKaryawan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required',
            'nomor_telepon' => 'required',
            'email' => 'required',
            'role' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendResponse('gagal', 'data gagal divalidasi', $validator->errors(), 500);
        }

        try {
            $karyawan = User::create([
                'name' => $request->nama_lengkap,
                'nomor_telepon' => $request->nomor_telepon,
                'email' => $request->email,
                'role' => $request->role,
                'kode_member' => NULL,
                'password' => Hash::make($request->password),
            ]);

            $absen = Absensi::create([
                'kasir_id' => $karyawan->id,
            ]);

                return $this->sendResponse('berhasil', 'karyawan berhasil didaftarkan', $karyawan, 200);
        } catch (\Throwable $th) {
                return $this->sendResponse('gagal', 'gagal didaftarkan', $th->getMessage(), 500);
        }
    }
}
