<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController1 extends Controller
{
    public function read()
    {
        return view('test');
    }
}
