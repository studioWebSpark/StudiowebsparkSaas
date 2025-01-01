<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SirenController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\VerifyEmailController;

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

// Routes pour les services
Route::get('/web-creation', function () {
    return Inertia::render('Website/componentsService/WebCreation');
})->name('web-creation');

Route::get('/marketing-digital', function () {
    return Inertia::render('Website/componentsService/Marketing');
})->name('marketing-digital');

Route::get('/maintenance-support', function () {
    return Inertia::render('Website/componentsService/Maintenance');
})->name('maintenance-support');

Route::get('/conseil', function () {
    return Inertia::render('Website/componentsService/Conseil');
})->name('conseil');

// Route pour le wizard de projet
Route::get('/demarrer-projet', [ProjectController::class, 'wizard'])
    ->name('demarrer-projet');

// Route pour soumettre le projet
Route::post('/demarrer-projet', [ProjectController::class, 'store'])
    ->name('project.store');

Route::get('/project/resume/{projectId}', [ProjectController::class, 'resumeProject'])
    ->name('project.resume');

Route::middleware(['auth'])->group(function () {
    Route::post('/stripe/create-session', [StripeController::class, 'createSession'])
        ->name('stripe.create-session');
    Route::get('/payment/success', [StripeController::class, 'success'])
        ->name('payment.success');
    Route::get('/payment/cancel', [StripeController::class, 'cancel'])
        ->name('payment.cancel');
});

Route::get('/project/summary', [ProjectController::class, 'summary'])
    ->name('project.summary');

Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');
// Po