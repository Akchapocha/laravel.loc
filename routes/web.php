<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\DocumentController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\WelcomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::middleware('guest')->group( function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::middleware('auth')->group( function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/create', [DocumentController::class, 'index'])->name('create');
});

Route::middleware(['auth', 'can:editing'])->group( function () {
    Route::post('/dashboard/create', [DocumentController::class, 'save'])->name('save');
    Route::post('/dashboard/delete', [DocumentController::class, 'delete'])->name('delete');
    Route::get('/dashboard/edit/{id?}', [DocumentController::class, 'edit'])->name('edit');
    Route::post('/dashboard/edit/update', [DocumentController::class, 'update'])->name('update');
    Route::post('/dashboard/document/get', [DocumentController::class, 'get'])->name('getDocument');
});

