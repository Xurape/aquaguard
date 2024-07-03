<?php

namespace App\Modules\WaterMetrics\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WaterQualityController extends Controller
{
    public function ph(Request $request)
    {
        return response()->json([
            'status' => '200',
            'message' => '7.5'
        ]);
    }

    public function chlorine(Request $request)
    {
        return response()->json([
            'status' => '200',
            'message' => '0.5'
        ]);
    }

    public function alkalinity(Request $request)
    {
        return response()->json([
            'status' => '200',
            'message' => '100'
        ]);
    }

    public function turbidity(Request $request)
    {
        return response()->json([
            'status' => '200',
            'message' => '0.1'
        ]);
    }
}
