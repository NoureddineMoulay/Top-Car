<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;

Route::get('/', [CarController::class, 'home'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('users', UserController::class);
    Route::resource('cars', CarController::class);
    Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
    Route::delete('/cars/{car}', [CarController::class, 'destroy'])->name('cars.destroy');
    Route::put('/cars/{car}', [CarController::class, 'update'])->name('cars.update');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/show/{car}', [CarController::class, 'show'])->name('cars.show');
    Route::get('/reserve', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/reserve/{car}', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/reserve', [BookingController::class, 'store'])->name('bookings.store');





});



require __DIR__.'/auth.php';
