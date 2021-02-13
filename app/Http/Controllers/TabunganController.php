<?php

namespace App\Http\Controllers;

use App\User;
use App\Tabungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TabunganController extends Controller
{
    public function index()
    {
        $id = Auth::id();

        // dd($id);

        $saldo1 = Tabungan::latest('saldo')->first();

        $saldo = $saldo1->saldo;

        // dd($saldo);

        return response()->json([
            'notification' => 'berhasil',
            'message' => 'saldo member berhasil diambil',
            'data' => $saldo,
            'code' => '200',
        ]);
    }
}
