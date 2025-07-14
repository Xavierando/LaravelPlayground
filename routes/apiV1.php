<?php

use App\Http\Controllers\Api\V1\BookingController;
use App\Http\Controllers\Api\V1\ServiceController;
use App\Http\Controllers\Api\V1\SlotsController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->middleware('auth:sanctum')->group(function () {
    Route::get('services/{service}/slots/{date}', [SlotsController::class, 'index'])->name('services.slots');
    Route::apiResource('services', ServiceController::class);
    Route::apiResource('bookings', BookingController::class);
});
