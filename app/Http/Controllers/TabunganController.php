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

        $saldo1 = Tabungan::latest('saldo')->first()->where('user_id', $id);

        $saldo = $saldo1->saldo;

        return response()->json([
            'notification' => 'berhasil',
            'message' => 'saldo member berhasil diambil',
            'saldo' => $saldo,
            'code' => '200',
        ]);
    }
}
