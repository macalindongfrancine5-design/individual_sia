<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Items;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    public function generalStock()
    {
        try {
            $summary = Items::getGeneralStock();

            if (!$summary) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Items not found',
                    'data' => null
                ], 404);
            } else {
                return response()->json([
                    'status' => 200,
                    'message' => 'success',
                    'data' => $summary
                ]);
            }

        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function category()
    {
        try {
            $summary = Items::getItemsByCategorySummary();
            if (!$summary) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Items not found',
                    'data' => null
                ], 404);
            } else {
                return response()->json([
                    'status' => 200,
                    'message' => 'success',
                    'data' => $summary
                ]);
            }   
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function supplier()
    {
        try {
            $summary = Items::getItemsBySupplierSummary();
            if (!$summary) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Items not found',
                    'data' => null
                ], 404);
            } else {
                return response()->json([
                    'status' => 200,
                    'message' => 'success',
                    'data' => $summary
                ]);
            }   
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function all()
    {
        try {
            $summary = Items::getAllSummary();
            if (!$summary) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Items not found',
                    'data' => null
                ], 404);
            } else {
                return response()->json([
                    'status' => 200,
                    'message' => 'success',
                    'data' => $summary
                ]);
            }   
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
