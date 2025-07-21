<?php

use App\Http\Controllers\Api\ProductApiController;

Route::middleware(['throttle:60,1'])->group(function () {
    Route::get('/products', [ProductApiController::class, 'index']);
    Route::get('/products/{id}', [ProductApiController::class, 'show']);
});

