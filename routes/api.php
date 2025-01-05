<?php

use App\Http\Controllers\SirenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\InseeTokenController;
use App\Models\ProjectStatus;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;


Route::post('/projects', [ProjectController::class, 'store']);
Route::post('/projects/payment-success', [ProjectController::class, 'handlePaymentSuccess']);
Route::get('/projects/pending', [ProjectController::class, 'getPendingProjects']);
Route::get('/projects/confirmed', [ProjectController::class, 'getConfirmedProjects']);

Route::middleware('api')->group(function () {
    Route::post('/verify-siren', [SirenController::class, 'verify'])->name('api.verify-siren');
});

Route::get('/project-statuses', function () {
    return ProjectStatus::select('order_number', 'status', 'progress')->get();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/create-payment', [OrderController::class, 'createPaymentSession']);
});

Route::post('/contact', [ContactController::class, 'send']);
