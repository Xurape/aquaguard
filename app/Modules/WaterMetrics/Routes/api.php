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
    Route::get('all', [WaterQualityController::class, 'all']);
    Route::post('register', [WaterQualityController::class, 'registerValues']);
})->middleware('api');