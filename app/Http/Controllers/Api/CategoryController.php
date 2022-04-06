<?php

namespace App\Http\Controllers\Api;

use App\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'successfully get all categories',
            'data' => Kategori::get(),
        ], 200);
    }

    public function store(CategoryRequest $r)
    {
        try {

            $category = Kategori::create([
                'category_name' => $r->category_name
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Category created successfully',
                'data' => $category
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Category created failed',
                'error' => $th->getMessage()
            ], 400);
        }
    }

    public function update($id, CategoryRequest $r)
    {
        if (!Kategori::find($id)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'data not found!',
            ], 400);
        }

        try {
            Kategori::where('id', $id)->update([
                'category_name' => $r->category_name,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'category successfully updated!',
                'data' => Kategori::find($id),
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'failed to update data',
                'error' => $th->getMessage()
            ], 400);
        }
    }

    public function destroy($id)
    {
        if (!Kategori::find($id)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'data not found!'
            ], 400);
        }

        try {
            Kategori::destroy($id);

            return response()->json([
                'status' => 'success',
                'message' => 'successfully delete category'
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'failed delete category',
                'error' => $th->getMessage()
            ], 400);
        }
    }
}
