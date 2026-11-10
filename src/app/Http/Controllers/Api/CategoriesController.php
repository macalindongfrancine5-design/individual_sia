<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //
    public function index()
    {
        try {
            $categories = Categories::all();
            if ($categories->isEmpty()) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Categories not found',
                    'data' => null
                ], 404);
            }
            return response()->json([
                'status' => 200,
                'message' => 'success',
                'data' => $categories
            ]);
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'description' => 'required',
            ]);

            $admin = Admin::first();

            if ($admin) {
                $category = Categories::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'created_by' => $admin->id
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'success',
                    'data' => $category
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Admin not found'
                ], 404);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Database error',
                'error' => $e->getMessage()
            ], 500);
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
