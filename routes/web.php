<?php

use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\DetailSaleController;

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


// Sessions
Route::get('/login', [SessionsController::class, 'create'])->name('login')->middleware('guest');
Route::post('/login', [SessionsController::class, 'store'])->middleware('guest');
Route::post('/logout', [SessionsController::class, 'destroy'])->name('logout')->middleware('auth');
Route::redirect('/home', '/')->middleware('auth');


Route::middleware('auth')->group(function () {
    // Rute dashboard
    Route::redirect('/', '/dashboard');
    Route::get('/dashboard', [UserController::class, 'showDashboard'])->name('sessions.index');
    

    // Rute medicine
    Route::get('/medicines', [MedicineController::class, 'index'])->name('medicines.index');

    Route::middleware('administrator')->group(function () {
        Route::post('/medicines', [MedicineController::class, 'store'])->name('medicines.store');
        Route::get('/medicines/create', [MedicineController::class, 'create'])->name('medicines.create');
        Route::get('/medicines/{medicine}/edit', [MedicineController::class, 'edit'])->name('medicines.edit');
        Route::put('/medicines/{medicine}', [MedicineController::class, 'update'])->name('medicines.update');
        Route::delete('/medicines/{medicine}', [MedicineController::class, 'destroy'])->name('medicines.destroy');
    });

    // Rute accounts
    Route::middleware('administrator')->group(function () {
        Route::get('/accounts', [UserController::class, 'index'])->name('accounts.index');
        Route::post('/accounts', [UserController::class, 'store'])->name('accounts.store');
        Route::get('/accounts/create', [UserController::class, 'create'])->name('accounts.create');
        Route::delete('/accounts/{user}', [UserController::class, 'destroy'])->name('accounts.destroy');
    });

    // Rute sales
    Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
    Route::get('/sales/search', [SaleController::class, 'search'])->name('sales.search');
    
    // sales admin
    Route::middleware('administrator')->group(function () {
        Route::get('/sales/{sale}', [DetailSaleController::class, 'show'])->name('sales.show');
    });

    // sales kasir
    Route::middleware('cashier')->group(function () {
        Route::post('/sales', [SaleController::class, 'store'])->name('sales.store');
        Route::post('/sales/{sale}', [DetailSaleController::class, 'store'])->name('detailsales.store');
    });

    // Rute profil
    Route::get('/profile', [UserController::class, 'showProfile'])->name('profile.index');
    Route::get('/profile/{user}/edit', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/{user}', [UserController::class, 'updateProfile'])->name('profile.update');
});
