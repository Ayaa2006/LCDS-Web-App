<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AbonnementController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\GalerieController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\GamificationController;
use App\Http\Controllers\LivraisonController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\ParrainageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaimentController;
use App\Http\Controllers\TaskSubmissionController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\DecorController;
use App\Http\Controllers\AgendaCrmController;
use App\Http\Controllers\PrestationController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\ContactController;

// ==================== PUBLIC ROUTES ====================

// Main pages
Route::get('/lcds', [GalerieController::class, 'indexsLCDS'])->name('lcds');
Route::get('about', function () {
    return view('about');
})->name('about');
Route::get('rendez-vous', function () {
    return view('service-photographie');
})->name('rendez-vous');
Route::get('sphoto', function () {
    return view('service-photographie');
})->name('sphoto');
Route::get('contact', function () {
    return view('Contact');
})->name('contact');

// Public gallery routes
Route::get('/galerie', [GalerieController::class, 'indexs'])->name('galerie.index');
Route::get('/blog', [BlogController::class, 'indexs'])->name('blog.index');
Route::get('/blog/{id}', [BlogController::class, 'showForUser'])->name('user.blogs.show');
Route::get('/service-photographie', [StockController::class, 'indexs'])->name('sphoto');

// Contact form
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// ==================== AUTHENTICATION ROUTES ====================

Route::prefix('auth')->group(function () {
    // Registration
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register', [AuthController::class, 'registerSave'])->name('register.save');
    
    // Login
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::get('login-admin', [AuthController::class, 'AdminLogin'])->name('AdminLogin');
    Route::post('login', [AuthController::class, 'userLoginAction'])->name('login.action');
    Route::post('login-admin', [AuthController::class, 'adminLoginAction'])->name('login.admin');
    
    // Logout
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

// ==================== ADMIN ROUTES ====================
Route::middleware(['auth:admin'])->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    // Settings
    Route::get('/settings', [AuthController::class, 'indexss'])->name('settings.indexss');

Route::get('/galeries', [GalerieController::class, 'index'])->name('galeries.index');
Route::get('/galeries/create', [GalerieController::class, 'create'])->name('galeries.create');
Route::get('/galeries/{galerie}/edit', [GalerieController::class, 'edit'])->name('galeries.edit');
Route::put('/galeries/{galerie}', [GalerieController::class, 'update'])->name('galeries.update');
Route::delete('/galeries/{galerie}', [GalerieController::class, 'destroy'])->name('galeries.destroy');
Route::post('/galeries', [GalerieController::class, 'store'])->name('galeries.store');
Route::get('/galeries/{galerie}', [GalerieController::class, 'show'])->name('galeries.show');

Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');


Route::get('/utilisateurs', [AuthController::class, 'index'])->name('utilisateurs.index');
Route::delete('/utilisateurs/{id}', [AuthController::class, 'destroy'])->name('utilisateurs.destroy');

// ==================== PHOTO ROUTES ====================

Route::post('/photo', [PhotoController::class, 'store'])->name('photo');
Route::get('/photoget', [PhotoController::class, 'index'])->name('photoget');
Route::delete('/photos/{id}', [PhotoController::class, 'destroy'])->name('photos.destroy');

// ==================== EQUIPMENT ROUTES ====================

Route::resource('machines', MachineController::class);
Route::get('/machines/create', [MachineController::class, 'create'])->name('machines.create');
Route::post('/machines', [MachineController::class, 'store'])->name('machines.store');
Route::get('/machines/{machine}/edit', [MachineController::class, 'edit'])->name('machines.edit');
Route::put('/machines/{machine}', [MachineController::class, 'update'])->name('machines.update');

// ==================== DECOR ROUTES ====================

Route::resource('decors', DecorController::class);

// ==================== CRM ROUTES ====================

Route::resource('agenda-crm', AgendaCrmController::class);

// ==================== SERVICE ROUTES ====================

Route::resource('prestations', PrestationController::class);

// ==================== MISSION ROUTES ====================

Route::resource('missions', MissionController::class);

// ==================== EVENT ROUTES ====================

Route::resource('evenements', EvenementController::class);
Route::patch('/evenements/{id}/status', [EvenementController::class, 'updateStatus'])
     ->name('evenements.updateStatus');
Route::get('/evenements/image/{filename}', [EvenementController::class, 'showImage'])
     ->name('evenements.showImage');

     

});


// ==================== AUTHENTICATED USER ROUTES ====================

Route::middleware('auth')->group(function () {
    
    Route::get('vs', function () {
        return view('visite-virtuelle');
    })->name('vs');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.index');
    Route::get('profile/edit', [AuthController::class, 'edit'])->name('profile-edit');
    Route::put('profile/update', [AuthController::class, 'update'])->name('profile.update');
    Route::delete('profile/delete', [AuthController::class, 'destroyProfile'])->name('deleteAccount');
    
    
   // ==================== GAMIFICATION ROUTES ====================
    Route::get('gamification', [AuthController::class, 'indexsss'])->name('gamification');
    Route::post('gamification/{task}', [AuthController::class, 'completeTask'])->name('complete-task');
Route::get('/gamifications', [GamificationController::class, 'index'])->name('gamifications.index');
Route::post('/gamifications/add-points', [GamificationController::class, 'addPoints'])->name('gamifications.addPoints');
Route::get('/gamifications/{userId}', [GamificationController::class, 'show'])->name('gamifications.show');
Route::get('/gamification', [GamificationController::class, 'index'])
     ->name('gamification')
     ->middleware('auth');
Route::get('/get-submissions/{userId}', [GamificationController::class, 'getUserSubmissionsForAjax']);
Route::post('/gamification/generate-code', [GamificationController::class, 'generateCode'])
    ->name('gamification.generate-code')
    ->middleware('auth');
    // ==================== PAYMENT ROUTES ====================

Route::post('/vs', [PaimentController::class, 'savePayment'])->name('save.payment');
Route::post('abnstore', [AbonnementController::class, 'store'])->name('abnstore');
Route::post('/desabonner', [AbonnementController::class, 'destroyByCode'])->name('desabonner');


Route::DELETE('/submissions/delete/{id}', [TaskSubmissionController::class, 'delete'])->name('submissions.delete');

});

// ==================== RESERVATION ROUTES ====================

Route::post('reservationsclient', [ReservationController::class, 'store'])->name('reservationsclient');
Route::delete('resdestroy/{id}', [ReservationController::class, 'destroy'])->name('resdestroy');
Route::get('/Reservations/{Reservation}/edit', [ReservationController::class, 'edit'])->name('Reservation.edit');
Route::put('/Reservations/{id}', [ReservationController::class, 'update'])->name('Reservation.update');
Route::delete('/reservation/supprimer', [ReservationController::class, 'deleteReservationByCode'])->name('reservation.delete');
Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
Route::get('/reservations/existantes', [ReservationController::class, 'getReservations']);





// ==================== SUBSCRIPTION ROUTES ====================



// ==================== STOCK ROUTES ====================

Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
Route::get('/stock/create', [StockController::class, 'create'])->name('stock.create');
Route::post('/stock/store', [StockController::class, 'store'])->name('stock.store');
Route::get('/stock/{stock}/edit', [StockController::class, 'edit'])->name('stock.edit');
Route::put('/stock/{stock}', [StockController::class, 'update'])->name('stock.update');
Route::delete('/stock/{stock}', [StockController::class, 'destroy'])->name('stock.destroy');



// ==================== TASK MANAGEMENT ROUTES ====================

Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::post('/tasks/add-task', [TaskController::class, 'addTask'])->name('tasks.add-task');
Route::get('/tasks/edit-task/{id}', [TaskController::class, 'edit'])->name('tasks.edit-task');
Route::post('/tasks/update-task/{id}', [TaskController::class, 'update'])->name('tasks.update-task');
Route::delete('/tasks/delete-task/{id}', [TaskController::class, 'deleteTask'])->name('tasks.delete-task');
Route::get('/edit/{id}', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/update/{id}', [TaskController::class, 'update'])->name('tasks.update-task');

// Task submissions
Route::post('/tasks/{task}/submit', [TaskSubmissionController::class, 'store'])->name('submitMyTask');
Route::get('/tasks/{id}/submissions', [TaskSubmissionController::class, 'viewSubmissions'])->name('tasks.submissions');
Route::post('/submissions/{id}/approve', [TaskSubmissionController::class, 'approve'])->name('submissions.approve');
Route::post('/submissions/{id}/reject', [TaskSubmissionController::class, 'reject'])->name('submissions.reject');
Route::get('/submissions/download/{path}', [TaskSubmissionController::class, 'download'])
    ->name('submissions.download')
    ->where('path', '.*');



// ==================== DELIVERY ROUTES ====================

Route::get('/livraisons', [LivraisonController::class, 'index'])->name('livraisons.index');
Route::get('/livraisons/create', [LivraisonController::class, 'create'])->name('livraisons.create');
Route::post('/livraisons', [LivraisonController::class, 'store'])->name('livraisons.store');
Route::get('/livraisons/{id}', [LivraisonController::class, 'show'])->name('livraisons.show');
Route::get('/livraisons/{id}/edit', [LivraisonController::class, 'edit'])->name('livraisons.edit');
Route::put('/livraisons/{id}', [LivraisonController::class, 'update'])->name('livraisons.update');
Route::delete('/livraisons/{id}', [LivraisonController::class, 'destroy'])->name('livraisons.destroy');

// ==================== SALES ROUTES ====================

Route::resource('ventes', VenteController::class);

// ==================== SPONSORSHIP ROUTES ====================

Route::post('/store-code', [ParrainageController::class, 'storeCode'])->name('store.code');
Route::post('/validate-referral-code', [ParrainageController::class, 'validateReferralCode'])->name('validate.referral.code');
Route::get('/parrainages', [ParrainageController::class, 'index'])->name('parrainages.index');
Route::post('/validate-referral-code', [ParrainageController::class, 'validateReferralCode'])
    ->middleware('auth');
Route::post('/test-referral', function(Request $request) {
    \Log::info('Test endpoint hit');
    return response()->json(['success' => true]);
});



// ==================== CONTACT MESSAGES ROUTES ====================

Route::get('/messages', [ContactController::class, 'index'])->name('contact.messages');
Route::post('/contact/{id}/reply', [ContactController::class, 'reply'])->name('contact.reply');