<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    public function index()
    {
        try {
            $suppliers = Suppliers::all();
            if ($suppliers->isEmpty()) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Categories not found',
                    'data' => null
                ], 404);
            }
            return response()->json([
                'status' => 200,
                'message' => 'success',
                'data' => $suppliers
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
                'contact_info' => 'required',
            ]);

            $admin = Admin::first();

            if ($admin) {
                $supplier = Suppliers::create([
                    'name' => $request->name,
                    'contact_info' => $request->contact_info,
                    'created_by' => $admin->id
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'success',
                    'data' => $supplier
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
