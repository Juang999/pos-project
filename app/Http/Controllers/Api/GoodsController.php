<?php

namespace App\Http\Controllers\Api;

use App\Barang;
use App\Supplier;
use App\Kategori;
use Illuminate\Http\Request;
use App\Http\Requests\GoodsRequest;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    public function index()
    {
        // your code
    }

    public function store(GoodsRequest $r)
    {
        try {
            $goods = Barang::create([
                'goods_name' => $r->goods_name,
                'category_id' => $r->category_id,
                'unit_price' => $r->unit_price,
                'barcode' => 'hello world'
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'successfully added goods',
                'data' => $goods,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'failed to add goods',
                'error' => $th->getMessage(),
            ], 400);
        }
    }
}
