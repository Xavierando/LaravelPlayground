<?php

use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {
    Route::get('services', function () {
        return 'CIAO';
    });
});
