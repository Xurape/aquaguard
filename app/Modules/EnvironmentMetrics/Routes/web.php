<?php

use Illuminate\Support\Facades\Route;
use App\Modules\EnvironmentMetrics\Http\Controllers\EnvironmentMetricsController;

Route::get('/EnvironmentMetrics', [EnvironmentMetricsController::class, 'index']);
