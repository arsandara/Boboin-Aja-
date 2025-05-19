<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminReservationController;
use App\Http\Controllers\AdminRoomController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;

// Home Routes
Route::get('/', [UserController::class, 'home'])->name('home');
Route::get('/rooms', [UserController::class, 'rooms'])->name('rooms');
Route::get('/booking', [UserController::class, 'booking'])->name('booking');
Route::get('/facilities', [UserController::class, 'facilities'])->name('facilities');
Route::get('/contact', [UserController::class, 'contact'])->name('contact');

// Admin Routes (Gabungan, lebih rapi)
Route::prefix('admin')->middleware(\App\Http\Middleware\AdminMiddleware::class)->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('/reservations', AdminReservationController::class);
    Route::resource('/rooms', AdminRoomController::class);

    Route::get('/reservation/{id}', [ReservationController::class, 'show']);
    Route::post('/reservation/{id}/checkin', [ReservationController::class, 'checkin'])->name('reservation.checkin');
    Route::delete('/reservation/{id}/cancel', [ReservationController::class, 'cancel'])->name('reservation.cancel');
});

Route::redirect('/dashboard', '/admin/dashboard');

// Auth Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Auth::routes();

// Redirect /dashboard ke /admin/dashboard
Route::redirect('/dashboard', '/admin/dashboard');



// Optional: Route admin management jika punya fitur superadmin
Route::prefix('admins')->group(function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::post('/', [AdminController::class, 'store']);
    Route::get('/{id}', [AdminController::class, 'show']);
    Route::put('/{id}', [AdminController::class, 'update']);
    Route::delete('/{id}', [AdminController::class, 'destroy']);
});

// Laravel's default home route
Route::get('/home', [HomeController::class, 'index'])->name('home');
