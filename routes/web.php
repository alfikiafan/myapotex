<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineController;

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

// Rute Medicine

Route::redirect('/', '/medicines');

Route::get('/medicines', function () {
    return view('index');
});

Route::get('/medicines', [MedicineController::class, 'index'])->name('medicines.index');
Route::post('/medicines', [MedicineController::class, 'store'])->name('medicines.store');
Route::get('/medicines/create', [MedicineController::class, 'create'])->name('medicines.create');
Route::get('/medicines/{medicine}/edit', [MedicineController::class, 'edit'])->name('medicines.edit');
Route::put('/medicines/{medicine}', [MedicineController::class, 'update'])->name('medicines.update');
Route::delete('/medicines/{medicine}', [MedicineController::class, 'destroy'])->name('medicines.destroy');

// Rute Sementara
Route::get('/dashboard', function () {
    return redirect()->route('medicines.index');
})->name('dashboard');

Route::get('/sales', function () {
    return redirect()->route('medicines.index');
})->name('sales.index');

Route::get('/account', function () {
    return redirect()->route('medicines.index');
})->name('account.index');

Route::get('/logout', function () {
    return redirect()->route('medicines.index');
})->name('logout');