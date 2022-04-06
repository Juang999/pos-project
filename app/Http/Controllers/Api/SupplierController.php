<?php

namespace App\Http\Controllers\Api;

use App\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierRequest;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{

    public function index()
    {
        $supplier = Supplier::get(['id','supplier_name']);

        return response()->json([
            'status' => 'success',
            'message' => 'successfully get suppliers name',
            'data' => $supplier
        ], 200);
    }

    public function show($id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            return response()->json([
                'message' => 'data not found!'
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'successfully show data',
            'data' => $supplier
        ], 200);
    }

    public function store(SupplierRequest $r)
    {

        try {
            $supplier = Supplier::create([
                'supplier_name' => $r->supplier_name,
                'address' => $r->address,
                'phone_number' => $r->phone_number,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'successfully added one supplier',
                'data' => $supplier
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'failed added one supplier',
                'error' => $th->getMessage(),
            ], 400);
        }
    }

    public function update($id, SupplierRequest $r)
    {
        $filter = Supplier::find($id);

        if (!$filter) {
            return response()->json([
                'status' => 'failed',
                'message' => 'data not found!'
            ], 400);
        }

        try {

            $supplierUpdate = Supplier::where('id', $id)->update([
                'supplier_name' => $r->supplier_name,
                'address' => $r->address,
                'phone_number' => $r->phone_number,
            ]);

            $supplier = Supplier::find($id);

            return response()->json([
                'status' => 'success',
                'message' => 'successfully updated supplier',
                'data' => $supplier
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'status' => 'failed',
                'message' => 'failed to update supplier',
                'error' => $th->getMessage(),
            ], 400);

        }
    }

    public function destroy($id)
    {
        $filter = Supplier::find($id);

        if (!$filter) {
            return response()->json([
                'status' => 'failure',
                'message' => 'data not found!',
            ], 400);
        }

        try {
            Supplier::destroy($id);

            return response()->json([
                'status' => 'success',
                'message' => 'Successfully deleted supplier'
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Failed to delete supplier',
                'error' => $th->getMessage(),
            ], 400);
        }
    }
}
