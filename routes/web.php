<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
//use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
//use App\Http\Controllers\PostController; 

Route::get('/home', [HomeController::class, 'homepage']);

// Jetstream Dashboard Route 
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
});

// HomeController route
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');
Route::get('/admin/login', [HomeController::class, 'showAdminLoginForm'])->name('admin.login.form');
Route::post('/admin/login', [HomeController::class, 'adminLogin'])->name('admin.login');

// Protected Routes (non-admin)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/settings', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //Route::put('/settings', [ProfileController::class, 'updateSettings'])->name('settings.update');
    //Route::get('/account', [ProfileController::class, 'account'])->name('account');
    //Route::put('/account', [ProfileController::class, 'updateAccount'])->name('account.update');

    // Place Post Resource here if it is for general users, or leave in admin group if only for admins.
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminUserController::class, 'index'])->name('admin.index');
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
    Route::resource('posts', PostController::class); // Post Resource for admins
});



//require __DIR__.'/auth.php';

Route::get('/post_page', [AdminController::class, 'post_page']);