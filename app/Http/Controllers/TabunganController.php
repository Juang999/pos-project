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

        $saldo = Tabungan::where('user_id', $id)->latest()->first();

        return response()->json([
            'notification' => 'berhasil',
            'message' => 'saldo member berhasil diambil',
            'data' => $saldo,
            'code' => '200',
        ]);
    }
}
