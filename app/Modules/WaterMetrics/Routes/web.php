<?php

use App\Modules\WaterMetrics\Http\Controllers\WaterQualityController;
use Illuminate\Support\Facades\Route;

Route::prefix('water')->group(function () {
    Route::get('/', function () {
        return response()->json([
            'status' => '200',
            'message' => 'No action specified'
        ]);
    });

    Route::get('ph', [WaterQualityController::class, 'ph']);

    Route::get('chlorine', [WaterQualityController::class, 'chlorine']);

    Route::get('alkalinity', [WaterQualityController::class, 'alkalinity']);
})->middleware('api');
