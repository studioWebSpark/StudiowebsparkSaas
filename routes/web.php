<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/home', function () {
    return Inertia::render('Website/Home');
});
// Page À propos
Route::get('/about', function () {
    return Inertia::render('Website/About');
});

// Page de gestion des forfaits
Route::get('/services', function () {
    return Inertia::render('Website/Ser');
});

// Page de support
Route::get('/support', function () {
    return Inertia::render('Website/Support');
});
Route::get('/tarifs', function () {
    return Inertia::render('Website/Tarifs');
});

Route::get('/', function () {
    return Inertia::render('Website/Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
