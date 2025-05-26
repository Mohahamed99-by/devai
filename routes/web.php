<?php


use App\Http\Controllers\ClientResponseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Routes publiques
Route::get('/', function () {
    // Si l'utilisateur est connecté, rediriger vers la page des fiches techniques
    if (auth()->check()) {
        // Si c'est un admin, rediriger vers le tableau de bord admin
        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }
        // Sinon, rediriger vers la page des fiches techniques
        return redirect()->route('technical-sheets.index');
    }

    // Si l'utilisateur n'est pas connecté, afficher la page d'accueil
    return view('welcome');
});
Route::get('/client-response/form', [ClientResponseController::class, 'showFormModal'])->name('client-response.form');
Route::post('/client-response', [ClientResponseController::class, 'store'])->middleware('extend.time:180'); // 3 minutes pour l'analyse
Route::get('/client-response/confirmation/{clientResponse}', [ClientResponseController::class, 'showConfirmation'])->name('client-response.confirmation');
Route::post('/client-response/{clientResponse}/reanalyze', [ClientResponseController::class, 'reanalyze'])->middleware('extend.time:180')->name('client-response.reanalyze');
Route::get('/pdf/generate/{clientResponse}', [App\Http\Controllers\PdfController::class, 'generatePdf']);

// Routes de test pour l'envoi d'email
Route::get('/test-mail', [App\Http\Controllers\TestEmailController::class, 'testEmail']);
Route::get('/test-unified-notification', [App\Http\Controllers\TestEmailController::class, 'testUnifiedNotification']);







// Routes d'authentification
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

// Routes protégées par authentification
Route::middleware(['auth'])->group(function () {
    // Routes communes à tous les utilisateurs authentifiés
    Route::get('/technical-sheets', [App\Http\Controllers\TechnicalSheetController::class, 'index'])
        ->name('technical-sheets.index');

    // Accès aux fiches techniques de l'utilisateur connecté
    Route::get('/my-technical-sheets', [App\Http\Controllers\ClientResponseController::class, 'myResponses'])
        ->name('client-response.my');

    // Association d'une réponse temporaire à un utilisateur
    Route::post('/client-response/associate', [App\Http\Controllers\ClientResponseController::class, 'associateTemporaryResponse'])
        ->name('client-response.associate');

    // Routes pour les notifications
    Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index'])
        ->name('notifications.index');
    Route::post('/notifications/{id}/read', [App\Http\Controllers\NotificationController::class, 'markAsRead'])
        ->name('notifications.read');
    Route::post('/notifications/read-all', [App\Http\Controllers\NotificationController::class, 'markAllAsRead'])
        ->name('notifications.read-all');
    Route::get('/notifications/unread-count', [App\Http\Controllers\NotificationController::class, 'getUnreadCount'])
        ->name('notifications.unread-count');
    Route::get('/notifications/latest', [App\Http\Controllers\NotificationController::class, 'getLatest'])
        ->name('notifications.latest');

    // Routes pour le chatbot
    Route::get('/chat', [App\Http\Controllers\ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/new', [App\Http\Controllers\ChatController::class, 'newConversation'])->name('chat.new');
    Route::get('/chat/{id}', [App\Http\Controllers\ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat', [App\Http\Controllers\ChatController::class, 'store'])->middleware('extend.time:90')->name('chat.store'); // 90 secondes pour le chat
    Route::put('/chat/{id}/title', [App\Http\Controllers\ChatController::class, 'updateTitle'])->name('chat.update-title');
    Route::post('/chat/{id}/archive', [App\Http\Controllers\ChatController::class, 'archiveConversation'])->name('chat.archive');

    // Route pour afficher une fiche technique spécifique (doit être après les routes spécifiques)
    Route::get('/client-response/{clientResponse}', [ClientResponseController::class, 'show'])->name('client-response.show');

    // Routes pour les clients (utilisateurs standard)
    Route::middleware(['role:client'])->group(function () {

        // Suppression des fiches techniques de l'utilisateur connecté uniquement
        Route::delete('/technical-sheets/{clientResponse}', [App\Http\Controllers\TechnicalSheetController::class, 'destroy'])
            ->middleware('permission:delete_own_technical_sheets')
            ->name('technical-sheets.destroy')
            ->where('clientResponse', '[0-9]+'); // Accepte uniquement les valeurs numériques
    });

    // Routes pour les administrateurs
    Route::middleware(['role:admin'])->group(function () {
        // Tableau de bord administrateur
        Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])
            ->name('admin.dashboard');

        // Validation des fiches techniques
        Route::patch('/technical-sheets/{clientResponse}/validate', [App\Http\Controllers\TechnicalSheetController::class, 'validateSheet'])
            ->middleware('permission:validate_technical_sheets')
            ->name('technical-sheets.validate');

        // Suppression de n'importe quelle fiche technique
        Route::delete('/technical-sheets/admin/{clientResponse}', [App\Http\Controllers\TechnicalSheetController::class, 'adminDestroy'])
            ->middleware('permission:delete_technical_sheets')
            ->name('technical-sheets.admin.destroy');

        // Les routes de chat sont définies au niveau utilisateur

        // Gestion des utilisateurs
        Route::middleware('permission:manage_users')->group(function () {
            Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
            Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
            Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
            Route::get('/users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
            Route::put('/users/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
            Route::delete('/users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
        });
    });
});
