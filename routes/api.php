<?php

use App\Http\Controllers\SirenController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function () {
    Route::post('/verify-siren', [SirenController::class, 'verify'])->name('api.verify-siren');
});
// Route::get('/marketing-digital', function () {