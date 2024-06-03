<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TransactionController;
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
    Route::get('/reservations/{id}', [BookingController::class, 'show'])->name('bookings.show');

    Route::post('/transactions/create-checkout-session', [TransactionController::class, 'createCheckoutSession'])->name('transactions.create-checkout-session');
    Route::get('/transactions/success', [TransactionController::class, 'success'])->name('transactions.success');
    Route::get('/transactions/cancel', [TransactionController::class, 'cancel'])->name('transactions.cancel');
    Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

// Other routes


    Route::get('/cars/{car}/reviews', [ReviewController::class, 'index'])->name('cars.reviews.index');
    Route::get('/cars/{car}/reviews/create', [ReviewController::class, 'create'])->name('cars.reviews.create');
    Route::post('/cars/{car}/reviews', [ReviewController::class, 'store'])->name('cars.reviews.store');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');






});



require __DIR__.'/auth.php';
