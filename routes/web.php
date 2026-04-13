<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LendingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;

// Halaman Landing Page
Route::get('/', function () {
    return view('welcome');
})->name('landing');

// Proses Login & Logout
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk Admin
Route::middleware(['auth', CheckRole::class . ':admin'])->prefix('admin')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // CRUD
    Route::get('/items', [ItemController::class, 'index'])->name('items.index');
    Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');
    Route::get('/items/{id}/edit', [ItemController::class, 'edit'])->name('items.edit');
    Route::put('/items/{id}', [ItemController::class, 'update'])->name('items.update');
    Route::delete('/items/{id}', [ItemController::class, 'destroy'])->name('items.destroy');

    //Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    // Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    // Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    // Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});

// Route untuk Staff
Route::middleware(['auth', CheckRole::class . ':staff'])->prefix('staff')->group(function () {

    // Dashboard Staff
    Route::get('/dashboard', function () {
        return view('staff.dashboard');
    })->name('staff.dashboard');

    // Fitur Peminjaman
    Route::get('/lendings', [LendingController::class, 'index'])->name('lendings.index');
    Route::post('/lendings', [LendingController::class, 'store'])->name('lendings.store');
    Route::put('/lendings/{id}/return', [LendingController::class, 'returnItem'])->name('lendings.return');
});
