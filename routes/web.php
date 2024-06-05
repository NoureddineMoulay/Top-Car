<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TransactionController;
use App\Models\Booking;
use App\Models\Car;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;

Route::get('/', [CarController::class, 'home'])->name('home');
Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
Route::get('/ourcars', [CarController::class, 'allCars'])->name('cars.allcars');
Route::get('/cars/search', [CarController::class, 'search'])->name('cars.search');

Route::get('/dashboard', function () {
    $carCount = Car::count();
    $userCount = User::count();
    $bookingCount = Booking::count();
    $transactionCount = Transaction::count();

    // Get monthly data for bookings and transactions
    $monthlyBookings = Booking::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as count'))
        ->groupBy('month')
        ->orderBy('month')
        ->get()
        ->pluck('count', 'month');

    $monthlyTransactions = Transaction::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as count'))
        ->groupBy('month')
        ->orderBy('month')
        ->get()
        ->pluck('count', 'month');

    return view('dashboard', compact('carCount', 'userCount', 'bookingCount', 'transactionCount', 'monthlyBookings', 'monthlyTransactions'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('users', UserController::class);
    Route::resource('cars', CarController::class);
    Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/bookings', [BookingController::class, 'list'])->name('bookings.list');




    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    //Route::get('/show/{car}', [CarController::class, 'show'])->name('cars.show');
    Route::get('/reserve', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/reserve/{car}', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/reserve', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/reservations/{id}', [BookingController::class, 'show'])->name('bookings.show');
    Route::post('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');

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
