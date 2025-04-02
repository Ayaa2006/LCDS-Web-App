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
// Public route for the /lcds page, using GalerieController's indexsLCDS method to fetch galleries
Route::get('/lcds', [GalerieController::class, 'indexsLCDS'])->name('lcds');

Route::get('about', function () {
    return view('about');
})->name('about');

Route::get('rendez-vous', function () {
    return view('service-photographie');
})->name('rendez-vous');

Route::get('contact', function () {
    return view('Contact');
})->name('contact');

Route::get('vs', function () {
    return view('visite-virtuelle');
})->name('vs');
Route::get('sphoto', function () {
    return view('service-photographie');
})->name('sphoto');


//Route::get('vs', function ()) {
//    return view('processPayment');
//}


// *! Reservation

Route::post('reservationsclient', [ReservationController::class, 'store'])->name('reservationsclient');
Route::delete('resdestroy/{id}', [ReservationController::class, 'destroy'])->name('resdestroy');
Route::get('/Reservations/{Reservation}/edit', [ReservationController::class, 'edit'])->name('Reservation.edit');
Route::put('/Reservations/{id}', [ReservationController::class, 'update'])->name('Reservation.update');
Route::delete('/reservation/supprimer', [ReservationController::class, 'deleteReservationByCode'])->name('reservation.delete');
Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
Route::get('/reservations/existantes', [ReservationController::class, 'getReservations']);

// web.php
Route::post('/photo', [PhotoController::class, 'store'])->name('photo');
Route::get('/photoget', [PhotoController::class, 'index'])->name('photoget');

Route::delete('/photos/{id}', [PhotoController::class, 'destroy'])->name('photos.destroy');



//paiment
Route::post('/vs', [PaimentController::class, 'savePayment'])->name('save.payment');

// *!

Route::prefix('auth')->group(function () {
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register', [AuthController::class, 'registerSave'])->name('register.save');

    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'loginAction'])->name('login.action');

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

});

Route::get('dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Route::get('gamif', function () {
//     return view('gamification');
// })->name('gamif');

###########################################################
Route::middleware('auth')->group(function () {




    Route::get('vs', function () {
        return view('visite-virtuelle');
    })->name('vs');
    Route::get('sphoto', function () {
        return view('service-photographie');
    })->name('sphoto');

});

####Abonnement
Route::post('abnstore', [AbonnementController::class, 'store'])->name('abnstore');


// Route::get('/generate-pdf', [ProductController::class, 'generatePdf'])->name('generate.pdf');
// Route::get('/contact', [ActivityLogController::class, 'index'])->name('contact.index');

// Route::get('/products', [ProductController::class, 'index'])->name('products');
//Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// ***************************************************************


// Routes pour les ventes
//Route::get('/ventes', [VenteController::class, 'index'])->name('ventes.index');



// Display the list of stock items (GET) to the admin
Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
//To the user interface
Route::get('/service-photographie', [StockController::class, 'indexs'])->name('sphoto');


// Display the stock creation form (GET)
Route::get('/stock/create', [StockController::class, 'create'])->name('stock.create');
// Handle form submission to store the new stock item (POST)
Route::post('/stock/store', [StockController::class, 'store'])->name('stock.store');
// Show form for editing a stock item (GET)
Route::get('/stock/{stock}/edit', [StockController::class, 'edit'])->name('stock.edit');
// Update a stock item
Route::put('/stock/{stock}', [StockController::class, 'update'])->name('stock.update');
// Delete stock item
Route::delete('/stock/{stock}', [StockController::class, 'destroy'])->name('stock.destroy');


// routes/web.php
// Public blog page route
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
// User-facing blog route
Route::get('/blog', [BlogController::class, 'indexs'])->name('blog.index');
// Display all blogs for admin
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
// Display blogs for users (if different from admin view)
Route::get('/user-blogs', [BlogController::class, 'indexs'])->name('blogs.user');
// Display the form to create a new blog
Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
// Store a new blog
Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
// Display the form to edit an existing blog
Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
// Update an existing blog
Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
// Delete an existing blog
Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');
//show route
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/blog/{id}', [BlogController::class, 'showForUser'])->name('user.blogs.show');




// Define the route for the gallery
Route::get('/galerie', [GalerieController::class, 'index'])->name('galerie.index');
// Public routes for the gallery
Route::get('/galerie', [GalerieController::class, 'indexs'])->name('galerie.index'); // Display galleries for users


// // Admin routes for the gallery (grouped under admin prefix for clarity)
//Route for displaying the list of galleries
Route::get('/galeries', [GalerieController::class, 'index'])->name('galeries.index');
// Route for showing the form to create a new gallery
Route::get('/galeries/create', [GalerieController::class, 'create'])->name('galeries.create');
// Route for storing a new gallery
Route::post('/galeries', [GalerieController::class, 'store'])->name('galeries.store');
// Route for displaying a specific gallery (if needed)
Route::get('/galeries/{galerie}', [GalerieController::class, 'show'])->name('galeries.show');
// Route for showing the form to edit a specific gallery
Route::get('/galeries/{galerie}/edit', [GalerieController::class, 'edit'])->name('galeries.edit');
// Route for updating a specific gallery
Route::put('/galeries/{galerie}', [GalerieController::class, 'update'])->name('galeries.update');
// Route for deleting a specific gallery
Route::delete('/galeries/{galerie}', [GalerieController::class, 'destroy'])->name('galeries.destroy');



// Display all users for admin
Route::get('/utilisateurs', [AuthController::class, 'index'])->name('utilisateurs.index');
Route::delete('/utilisateurs/{id}', [AuthController::class, 'destroy'])->name('utilisateurs.destroy');

Route::get('/profile', [AuthController::class, 'indexs'])->name('profile.index');
// Route for editing profile
Route::get('profile/edit', [AuthController::class, 'edit'])->name('profile-edit');
Route::put('profile/update', [AuthController::class, 'update'])->name('profile.update');
Route::delete('profile/delete', [AuthController::class, 'destroyProfile'])->name('deleteAccount');
// Route::delete('profile/delete/{id}', [AuthController::class, 'destroy'])->name('deleteAccount');
Route::get('gamification', [AuthController::class, 'indexsss'])->name(name: 'gamification');
Route::post('gamification/{task}', [AuthController::class, 'completeTask'])->name('complete-task');



Route::get('/settings', [AuthController::class, 'indexss'])->name('settings.indexss');



Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::post('/tasks/add-task', [TaskController::class, 'addTask'])->name('tasks.add-task');
Route::get('/tasks/edit-task/{id}', [TaskController::class, 'edit'])->name('tasks.edit-task');
Route::post('/tasks/update-task/{id}', [TaskController::class, 'update'])->name('tasks.update-task');
Route::delete('/tasks/delete-task/{id}', [TaskController::class, 'deleteTask'])->name('tasks.delete-task');
Route::post('/tasks/{task}/submit', [TaskSubmissionController::class, 'store'])->name('submitMyTask');
Route::get('/edit/{id}', [TaskController::class, 'edit'])->name('tasks.edit'); // Ajoutez cette ligne
Route::put('/update/{id}', [TaskController::class, 'update'])->name('tasks.update-task'); // Notez le changement de nom
Route::get('/tasks/{id}/submissions', [TaskSubmissionController::class, 'viewSubmissions'])->name('tasks.submissions');
Route::post('/submissions/{id}/approve', [TaskSubmissionController::class, 'approve'])
    ->name('submissions.approve');
Route::post('/submissions/{id}/reject', [TaskSubmissionController::class, 'reject'])
    ->name('submissions.reject');
Route::get('/submissions/download/{path}', [TaskSubmissionController::class, 'download'])
    ->name('submissions.download')
    ->where('path', '.*');




Route::get('/gamifications', [GamificationController::class, 'index'])->name('gamifications.index');
Route::post('/gamifications/add-points', [GamificationController::class, 'addPoints'])->name('gamifications.addPoints');
Route::get('/gamifications/{userId}', [GamificationController::class, 'show'])->name('gamifications.show');
Route::get('/gamification', [GamificationController::class, 'index'])
     ->name('gamification')
     ->middleware('auth');
Route::get('/get-submissions/{userId}', [GamificationController::class, 'getUserSubmissionsForAjax']);




// Routes pour les livraisons
Route::get('/livraisons', [LivraisonController::class, 'index'])->name('livraisons.index');
Route::get('/livraisons/create', [LivraisonController::class, 'create'])->name('livraisons.create');
Route::post('/livraisons', [LivraisonController::class, 'store'])->name('livraisons.store');
Route::get('/livraisons/{id}', [LivraisonController::class, 'show'])->name('livraisons.show');
Route::get('/livraisons/{id}/edit', [LivraisonController::class, 'edit'])->name('livraisons.edit');
Route::put('/livraisons/{id}', [LivraisonController::class, 'update'])->name('livraisons.update');
Route::delete('/livraisons/{id}', [LivraisonController::class, 'destroy'])->name('livraisons.destroy');

Route::resource('ventes', VenteController::class);




// Route::post('gamification/storeCode', [ParrainageController::class, 'storeCode']);
// // Route to generate a referral code
// Route::post('gamification/generateCode', [ParrainageController::class, 'generateCode']);
// // Route to validate a referral code
// Route::post('gamification/validateReferralCode', [ParrainageController::class, 'validateReferralCode']);


Route::post('/store-code', [ParrainageController::class, 'storeCode'])->name('store.code');
Route::post('/validate-referral-code', [ParrainageController::class, 'validateReferralCode'])->name('validate.referral.code');


Route::get('gamification', [AuthController::class, 'indexsss'])->name('gamification');



Route::get('/profile', [ParrainageController::class, 'showProfile'])->name('profile.index');
Route::get('/profile', [ReservationController::class, 'indexUserReservations'])->name('profile.index');
Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.index');
//pour ladmin
Route::get('/parrainages', [ParrainageController::class, 'index'])->name('parrainages.index');




Route::resource('machines', MachineController::class);

Route::get('/machines/create', [MachineController::class, 'create'])->name('machines.create');
Route::post('/machines', [MachineController::class, 'store'])->name('machines.store');
Route::get('/machines/{machine}/edit', [MachineController::class, 'edit'])->name('machines.edit');
Route::put('/machines/{machine}', [MachineController::class, 'update'])->name('machines.update');

Route::resource('decors', DecorController::class);
Route::resource('agenda-crm', AgendaCrmController::class);