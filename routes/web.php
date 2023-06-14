<?php

use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\UserController;

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
    // Rute Dashboard
    Route::redirect('/', '/medicines');

    // Rute Medicine
    Route::get('/medicines', [MedicineController::class, 'index'])->name('medicines.index');

    Route::middleware('administrator')->group(function () {
        Route::post('/medicines', [MedicineController::class, 'store'])->name('medicines.store');
        Route::get('/medicines/create', [MedicineController::class, 'create'])->name('medicines.create');
        Route::get('/medicines/{medicine}/edit', [MedicineController::class, 'edit'])->name('medicines.edit');
        Route::put('/medicines/{medicine}', [MedicineController::class, 'update'])->name('medicines.update');
        Route::delete('/medicines/{medicine}', [MedicineController::class, 'destroy'])->name('medicines.destroy');
    });

    // Rute Accounts
    Route::middleware('administrator')->group(function () {
        Route::get('/accounts', [UserController::class, 'index'])->name('accounts.index');
        Route::post('/accounts', [UserController::class, 'store'])->name('accounts.store');
        Route::get('/accounts/create', [UserController::class, 'create'])->name('accounts.create');
        Route::get('/accounts/{user}/edit', [UserController::class, 'edit'])->name('accounts.edit');
        Route::put('/accounts/{user}', [UserController::class, 'update'])->name('accounts.update');
        Route::delete('/accounts/{user}', [UserController::class, 'destroy'])->name('accounts.destroy');
    });

    // Rute Accounts
    Route::middleware('cashier')->group(function () {
        Route::get('/sales', function () {
            return view('sales.index');
        })->name('sales.index');
    });

});


// Rute sementara
Route::get('/dashboard', function () {
    return redirect()->route('medicines.index');
})->name('dashboard');

Route::get('/logout', function () {
    return redirect()->route('medicines.index');
})->name('logout');
