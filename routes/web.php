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
use App\Http\Controllers\StatisticsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Models\Order;

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

// Route pour démarrer projet avec vérification
Route::get('/demarrer-projet', function (Request $request) {
    // Si l'utilisateur est connecté
    if (Auth::check()) {
        $user = Auth::user();

        // Vérifier si l'utilisateur a une commande
        $hasOrder = $user->orders()->exists();

        if ($hasOrder) {
            // Rediriger vers la page compte-existant si une commande existe
            return redirect()->route('compte-existant');
        }
    }

    // Si pas de commande, afficher la page démarrer projet
    return Inertia::render('Website/Project/ProjectWizard');
})->name('demarrer-projet');

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

Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics.index');

Route::middleware(['auth', 'verified'])->group(function () {
    // ... autres routes admin ...

    Route::get('/statistics', [App\Http\Controllers\Admin\StatisticsController::class, 'index'])
        ->name('statistics.index');
});

// Nouvelles routes pour les dashboards
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Dashboard Admin (accessible uniquement aux admins)
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])
        ->name('admin.dashboard')
        ->middleware('admin');

    // Dashboard Client (accessible à tous les utilisateurs authentifiés)
    Route::get('/client/dashboard', [DashboardController::class, 'clientDashboard'])
        ->name('client.dashboard');
});

Route::get('/payment/cancel', function () {
    return Inertia::render('Payment/PaymentCancel');
})->name('payment.cancel');

Route::middleware(['auth'])->prefix('client')->name('client.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [ClientController::class, 'dashboard'])->name('dashboard');

    // Projets
    Route::get('/projects', [ClientController::class, 'projects'])->name('projects');
    Route::get('/projects/{project}', [ClientController::class, 'showProject'])->name('projects.show');

    // Commandes
    Route::get('/orders', [ClientController::class, 'orders'])->name('orders');
    Route::get('/orders/{order}', [ClientController::class, 'showOrder'])->name('orders.show');

    // Support
    Route::get('/support', [ClientController::class, 'support'])->name('support');
    Route::post('/support/send', [ClientController::class, 'sendSupport'])->name('support.send');
});

Route::get('/compte-existant', function () {
    return Inertia::render('Website/CompteExistant');
})->name('compte-existant');

// Route de connexion personnalisée
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $user = Auth::user();

        // Si c'est un admin
        if ($user->is_admin) {
            return redirect()->intended('/admin/dashboard');
        }

        // Vérifier si l'utilisateur a une commande payée
        $hasPaidOrder = Order::where('user_id', $user->id)
            ->whereNotNull('paid_at')
            ->exists();

        if ($hasPaidOrder) {
            return redirect()->intended('/dashboard');
        }

        // Si pas de commande payée, rediriger vers démarrer-projet
        return redirect()->intended('/demarrer-projet');
    }

    return back()->withErrors([
        'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
    ])->withInput($request->except('password'));
})->middleware('guest')->name('login');

// Route du dashboard admin protégée
Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');

// Route pour afficher le formulaire d'inscription
Route::get('/register', function () {
    return Inertia::render('Auth/Register');
})->middleware('guest')->name('register');

// Route pour traiter l'inscription
Route::post('/register', [RegisterController::class, 'register'])
    ->middleware('guest')
    ->name('register.store');
