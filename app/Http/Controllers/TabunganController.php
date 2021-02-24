<<<<<<< HEAD
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

        $saldo1 = Tabungan::where('user_id', $id)->latest('saldo')->first('saldo');

        $saldo = $saldo1->saldo;

        return response()->json([
            'notification' => 'berhasil',
            'message' => 'saldo member berhasil diambil',
            'saldo' => $saldo,
            'code' => '200',
        ]);
    }
}
=======
<?php namespace App\Http\Controllers; use App\User; use App\Tabungan; use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; class TabunganController extends Controller
{ public function index() { $id=A uth::id(); // dd($id); $saldo1=T abungan::where(
'user_id', $id)->latest()->first('saldo'); $saldo = $saldo1->saldo; return response()->json([ 'notification'
=> 'berhasil', 'message' => 'saldo member berhasil diambil', 'saldo' => $saldo,
'code' => '200', ]); } }

<!--
Visual Code Mobile
Developed By Manish Nirmal
App Available on Play Store :-
https://play.google.com/store/apps/details?id=lk.visual.code.mobile
YouTube :-
https://youtube.com/ManishNirmal
-->
>>>>>>> 384a540e0d997e87c786e690931622c934936545
