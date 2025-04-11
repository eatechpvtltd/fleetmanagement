<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardDataController extends Controller
{
    public function index(Request $request)
    {
        try {
            $drivers = \App\Models\Driver::all();
            return response()->json([
                'success' => true,
                'message' => 'Drivers retrieved successfully',
                'data' => $drivers
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve drivers: ' . $e->getMessage(),
                'data' => []
            ], 500);
        }
    }
}
