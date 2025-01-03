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
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Admin\ProjectStatusController;

Route::get('/home', function () {
    return Inertia::render('Website/Home');
});
// Page À propos
Route::get('/about', function () {
    return Inertia::render('Website/About');
});

// Page de gestion des forfaits
Route::get('/services', function () {
    return Inertia::render('Website/Services');
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
    // Dashboard
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Nouvelles routes pour le suivi de projet
    Route::prefix('projects')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('projects.index');
        Route::get('/pending', [ProjectController::class, 'pending'])->name('projects.pending');
        Route::get('/in-progress', [ProjectController::class, 'inProgress'])->name('projects.in-progress');
        Route::get('/completed', [ProjectController::class, 'completed'])->name('projects.completed');
        Route::get('/{project}', [ProjectController::class, 'show'])->name('projects.show');
        Route::put('/{project}/progress', [ProjectController::class, 'updateProgress'])->name('projects.update.progress');
    });

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
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

// Routes Stripe publiques (hors middleware auth)
Route::controller(StripeController::class)->group(function () {
    Route::post('/stripe/create-session', 'createSession')->name('stripe.create-session');
    Route::get('/payment/success', 'success')->name('payment.success');
    Route::get('/payment/cancel', 'cancel')->name('payment.cancel');
});

// Routes protégées
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    // Route pour sauvegarder les données du projet
    Route::post('/save-project-data', [ProjectController::class, 'saveData'])->name('project.save');
});

Route::get('/project/summary', [ProjectController::class, 'summary'])
    ->name('project.summary');



Route::post('/stripe/webhook', [StripeController::class, 'webhook'])->name('stripe.webhook');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/payments', [App\Http\Controllers\Admin\PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/{payment}', [App\Http\Controllers\Admin\PaymentController::class, 'show'])->name('payments.show');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

Route::get('/stripe/check-payment-status', [StripeController::class, 'checkPaymentStatus'])
    ->name('stripe.check-payment-status')
    ->middleware(['auth']);

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware(['auth:sanctum', 'verified']);

Route::get('/orders', [OrderController::class, 'index'])
    ->name('orders.index')
    ->middleware(['auth:sanctum', 'verified']);

Route::get('/clients', [ClientController::class, 'index'])
    ->name('clients.index');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/projects', [ProjectStatusController::class, 'index'])->name('admin.projects.index');
    Route::get('/projects/{order}', [ProjectStatusController::class, 'show'])->name('admin.projects.show');
    Route::patch('/projects/{order}/status', [ProjectStatusController::class, 'update'])
        ->name('admin.projects.update-status')
        ->where('order', '[0-9]+');
    Route::patch('/projects/{order}/progress', [ProjectStatusController::class, 'updateProgress'])
        ->name('admin.projects.update-progress');
});

Route::middleware(['auth'])->group(function () {
    Route::patch('/projects/{order:order_number}/status', [ProjectStatusController::class, 'update'])
        ->name('projects.update-status');
});
