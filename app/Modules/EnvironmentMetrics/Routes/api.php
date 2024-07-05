<?php

use Illuminate\Support\Facades\Route;
use App\Modules\EnvironmentMetrics\Http\Controllers\EnvironmentMetricsController;

Route::prefix('environment')->group(function () {
    Route::get('/', function () {
        return response()->json([
            'status' => '200',
            'message' => 'No action specified'
        ]);
    });

    Route::get('temperature', [EnvironmentMetricsController::class, 'temperature']);
    Route::get('date', [EnvironmentMetricsController::class, 'date']);
    Route::get('all', [EnvironmentMetricsController::class, 'all']);
})->middleware('api');