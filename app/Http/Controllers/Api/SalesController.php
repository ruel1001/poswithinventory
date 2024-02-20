<?php

namespace App\Http\Controllers\Api;

use App\Models\Sales;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalesController extends Controller
{
    public function index(Request $request)
    {
        $materialName = $request->input('material_name');

        // If material_name is provided, search by name
        if (!empty($materialName)) {
            $sales = Sales::where('material_name', 'like', "%$materialName%")->get();
        } else {
            // If material_name is empty, show all records
            $sales = Sales::all();
        }

        // Check if any records are found
        if ($sales->count() > 0) {
            $totalAmountSales = $sales->sum('amount_sales');
            $totalAmountgain = $sales->sum('amount_gain');
            return response()->json([
                'status' => 200,
                 'total_amount_sales' => $totalAmountSales,
                 'total_amount_gain' => $totalAmountgain,
                'data' => $sales
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No records available"
            ], 404);
        }
    }


    // Create

}