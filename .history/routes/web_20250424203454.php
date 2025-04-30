<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticationSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Utilisateur\UtilisateurDashboardController;
use App\Http\Controllers\Leader\LeaderDashboardController;
use App\Http\Controllers\Leader\LeaderController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use App\Http\Controllers\SuperAdmin\MaterialController;
use App\Http\Controllers\SuperAdmin\LocationController;
use App\Http\Controllers\MaterielController;
use App\Http\Controllers\AffectationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuperAdmin\SuperAdminDashboardController;
use App\Models\Floor;
use App\Http\Controllers\SuperAdmin\BrancheController;


// Public Route
Route::get('/', function () {
    return view('welcome');
});

// Auth
Route::get('/login', [AuthenticationSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticationSessionController::class, 'store'])->name('login.store');
Route::post('/logout', [AuthenticationSessionController::class, 'destroy'])->name('logout');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Common
    Route::get('/informations', [InformationController::class, 'informations'])->name('informations');
    Route::get('/parametres', [CommonController::class, 'parametres'])->name('parametre');
    Route::get('/statistiques', [CommonController::class, 'statistiques'])->name('statistiques');

    // Dashboards
    Route::get('/utilisateur/dashboard', [UtilisateurDashboardController::class, 'utilisateuredashboard'])->name('utilisateur.dashboard');
    Route::get('/superadmin/dashboard', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');
    Route::get('/leader/dashboard', [LeaderDashboardController::class, 'leaderdashboard'])->name('leader.dashboard');
    Route::get('/admin/dashboard', [AdminController::class, 'admindashboard'])->name('admin.dashboard');

});
 // SuperAdmin Management
Route::middleware(['auth', 'superadmin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    // User Management
    Route::get('/utilisateurs', [SuperAdminController::class, 'utilisateurs'])->name('utilisateurs');
    Route::get('/utilisateurs/create', [SuperAdminController::class, 'create'])->name('utilisateurs.create');
    Route::post('/utilisateurs', [SuperAdminController::class, 'store'])->name('utilisateurs.store');
    Route::get('/utilisateurs/{id}/edit', [SuperAdminController::class, 'edit'])->name('utilisateurs.edit');
    Route::put('/utilisateurs/{id}', [SuperAdminController::class, 'update'])->name('utilisateurs.update');
    Route::delete('/utilisateurs/{id}', [SuperAdminController::class, 'destroy'])->name('utilisateurs.destroy');
    Route::get('cbr', [BrancheController::class, 'carburantSites'])->name('branches.carburant');
    Route::get('comm', [BrancheController::class, 'commercialDetails'])->name('branches.commercial');

    // Dashboard
    Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('dashboard');

    // Locations
    Route::get('/locations', [LocationController::class, 'gestionLocalite'])->name('locations.gestion-localite');

    // Materials
    Route::get('/materials', [MaterialController::class, 'index'])->name('materials.gestion-material');
    Route::get('/materials/computers', [MaterialController::class, 'computers'])->name('materials.computers');
    Route::get('/materials/printers', [MaterialController::class, 'printers'])->name('materials.printers');
    Route::get('/materials/hotspots', [MaterialController::class, 'hotspots'])->name('materials.hotspots');
    Route::get('/materials/ip-phones', [MaterialController::class, 'ipPhones'])->name('materials.ip-phones');
    Route::get('/materials/site/{site}/{type}', [MaterialController::class, 'siteMaterials'])->name('materials.site');

    // Reclamations
    Route::get('/reclamations/reclamations', [SuperAdminController::class, 'reclamations'])->name('superadmin.reclamations');
    Route::get('/reclamations/addreclamation', [SuperAdminController::class, 'addreclamation'])->name('reclamations.addreclamation');
    Route::post('/reclamations', [SuperAdminController::class, 'storeReclamation'])->name('storeReclamation');
    Route::get('/reclamations/{id}', [SuperAdminController::class, 'showReclamation'])->name('reclamations');
    Route::delete('/reclamations/{id}', [SuperAdminController::class, 'destroyReclamation'])->name('superadmin.reclamations.destroy');

    // Reclamation Messaging
    Route::post('/reclamations/{reclamationId}/messages', [SuperAdminController::class, 'storeMessage'])->name('messages.store');

    // Messages
    Route::get('/messages', [SuperAdminController::class, 'messages'])->name('messages.index');
    Route::get('/messages/{id}/view', [SuperAdminController::class, 'viewMessage'])->name('messages.view');
    Route::get('/messages/{id}/resolve', [SuperAdminController::class, 'resolveMessage'])->name('messages.resolve');
    Route::delete('/messages/{id}', [SuperAdminController::class, 'deleteMessage'])->name('messages.delete');
    Route::post('/messages/{messageId}/mark-as-seen', [SuperAdminController::class, 'markAsSeen'])->name('messages.mark-as-seen');
    Route::get('/messages/unread-count', [SuperAdminController::class, 'getUnreadCount'])->name('messages.unread-count');

    // COM & CBR routes
    Route::get('/cbr', [BrancheController::class, 'carburantSites'])->name('cbr');
    Route::get('/com', [BrancheController::class, 'commercialDetails'])->name('com');
});


    // Admin Management
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/utilisateurs', [AdminController::class, 'utilisateurs'])->name('utilisateurs');
        Route::get('/gestion-material', [AdminController::class, 'gestionMaterial'])->name('gestion-material');
        Route::get('/gestion-localite', [AdminController::class, 'gestionLocalite'])->name('gestion-localite');
        Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserManagementController::class, 'create'])->name('users.create');
        Route::post('/users', [UserManagementController::class, 'store'])->name('users.store');
    });

    // Leader Management
    Route::prefix('leader')->name('leader.')->group(function () {
        Route::get('/dashboard', [LeaderController::class, 'dashboard'])->name('dashboard');
        Route::get('/utilisateurs', [LeaderController::class, 'utilisateurs'])->name('utilisateurs');
        Route::get('/gestion-material', [LeaderController::class, 'gestionMaterial'])->name('gestion-material');
        Route::get('/gestion-localite', [LeaderController::class, 'gestionLocalite'])->name('gestion-localite');
        Route::get('/affectations', [AffectationController::class, 'index'])->name('affectations.index');
    });



    Route::middleware(['auth'])->prefix('superadmin/locations')->name('superadmin.locations.')->group(function () {
        // Location management routes
        Route::get('/gestion-localite', [LocationController::class, 'gestionLocalite'])->name('gestion-localite');
        Route::get('/create', [LocationController::class, 'create'])->name('create');
        Route::post('/store', [LocationController::class, 'store'])->name('store');
        Route::get('/{id}/edit-type', [LocationController::class, 'editType'])->name('edit-type');
        Route::put('/{id}/update-type', [LocationController::class, 'updateType'])->name('update-type');
        Route::get('/store', [LocationController::class, 'showStore']);
        // Room management routes (nested under locations)
        Route::delete('/{location}', [LocationController::class, 'destroy'])->name('destroy');
            Route::get('{id}/rooms', [LocationController::class, 'rooms'])->name('rooms');
            Route::get('{location}/addroom', [LocationController::class, 'addroom'])->name('addroom');
            Route::post('{location}/rooms', [LocationController::class, 'storeRoom'])->name('storeRoom');
            Route::put('/{room}/update-type', [LocationController::class, 'updateRoomType'])->name('update-type');
            Route::delete('/{room}', [LocationController::class, 'destroyRoom'])->name('destroyRoom');

    });
Route::prefix('superadmin/materials')->group(function () {
    // Main dashboard
    Route::get('/', [\App\Http\Controllers\SuperAdmin\MaterialController::class, 'index'])
        ->name('superadmin.materials.index');

    // Material type lists
    Route::get('/computers', [\App\Http\Controllers\SuperAdmin\MaterialController::class, 'computers'])
        ->name('superadmin.materials.computers');
    Route::get('/printers', [\App\Http\Controllers\SuperAdmin\MaterialController::class, 'printers'])
        ->name('superadmin.materials.printers');
    Route::get('/hotspots', [\App\Http\Controllers\SuperAdmin\MaterialController::class, 'hotspots'])
        ->name('superadmin.materials.hotspots');
    Route::get('/ip-phones', [\App\Http\Controllers\SuperAdmin\MaterialController::class, 'ipPhones'])
        ->name('superadmin.materials.ip-phones');

    // Site-specific materials
    Route::get('/sites/{site}/{type}', [\App\Http\Controllers\SuperAdmin\MaterialController::class, 'siteMaterials'])
        ->name('superadmin.materials.site');

    // CRUD operations
    Route::get('/{type}/create', [\App\Http\Controllers\SuperAdmin\MaterialController::class, 'create'])
        ->name('superadmin.materials.create');
    Route::post('/{type}', [\App\Http\Controllers\SuperAdmin\MaterialController::class, 'store'])
        ->name('superadmin.materials.store');
    Route::get('/{type}/{material}', [\App\Http\Controllers\SuperAdmin\MaterialController::class, 'show'])
        ->name('superadmin.materials.show');
    Route::get('/{type}/{material}/edit', [\App\Http\Controllers\SuperAdmin\MaterialController::class, 'edit'])
        ->name('superadmin.materials.edit');
    Route::put('/{type}/{material}', [\App\Http\Controllers\SuperAdmin\MaterialController::class, 'update'])
        ->name('superadmin.materials.update');
    Route::delete('/{type}/{material}', [\App\Http\Controllers\SuperAdmin\MaterialController::class, 'destroy'])
        ->name('superadmin.materials.destroy');
        Route::prefix('computers')->group(function () {
            Route::get('/create', [ComputerController::class, 'create'])->name('computers.create');
            Route::post('/', [ComputerController::class, 'store'])->name('computers.store');});
});

Route::post('/superadmin/reclamations/add-reclamation', [SuperAdminController::class, 'storeReclamation'])
    ->name('superadmin.add-reclamation');
    Route::delete('/superadmin/reclamations/{id}', [SuperAdminController::class, 'destroy'])->name('superadmin.reclamations.destroy');
    Route::get('/superadmin/reclamations', [SuperAdminController::class, 'showReclamations'])->name('superadmin.reclamations');
    Route::delete('/superadmin/reclamations/{id}', [SuperAdminController::class, 'destroyReclamation'])->name('superadmin.reclamations.destroy');

    // Resources
    Route::resource('computers', \App\Http\Controllers\ComputerController::class);
    Route::resource('printers', \App\Http\Controllers\PrinterController::class);
    Route::resource('ip-phones', \App\Http\Controllers\IpPhoneController::class);
    Route::resource('hotspots', \App\Http\Controllers\HotspotController::class);

    Route::post('/superadmin/reclamations/store', [SuperAdminController::class, 'storeReclamation'])->name('storeReclamation');
    require __DIR__.'/auth.php';
