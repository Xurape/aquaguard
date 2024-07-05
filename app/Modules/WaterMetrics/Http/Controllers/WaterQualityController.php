<?php

namespace App\Modules\WaterMetrics\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\WaterMetrics\Models\WaterQuality;
use Illuminate\Http\Request;

class WaterQualityController extends Controller
{
    public function registerValues(Request $request) {
        $waterQuality = new WaterQuality();
        $waterQuality->ph = $request->ph;
        $waterQuality->chlorine = $request->chlorine;
        $waterQuality->alkalinity = $request->alkalinity;
        $waterQuality->turbidity = $request->turbidity;
        $waterQuality->temperature = $request->temperature;
        $waterQuality->date = now();
        $waterQuality->save();

        return response()->json([
            'status' => '200',
            'message' => 'Water quality registered'
        ]);
    }

    public function all(Request $request) {
        return response()->json([
            'temperature' => WaterQuality::get('temperature')->where('created_at', '>=', now()->subDay())->avg('value') ?? 'Sem dados',
            'ph' => WaterQuality::get('ph')->where('created_at', '>=', now()->subDay())->avg('value') ?? 'Sem dados',
            'turbidity' => WaterQuality::get('turbidity')->where('created_at', '>=', now()->subDay())->avg('value') ?? 'Sem dados',
            'alkalinity' => WaterQuality::get('alkalinity')->where('created_at', '>=', now()->subDay())->avg('value') ?? 'Sem dados',
            'chlorine' => WaterQuality::get('chlorine')->where('created_at', '>=', now()->subDay())->avg('value') ?? 'Sem dados',
            'quality' => 'Good'
        ]);
    }
}
