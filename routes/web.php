<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('UI');
})->withoutMiddleware(['web', 'auth']);