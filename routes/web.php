<?php

use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\users\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('admin.login.show');
});

Route::middleware('guest')->group(function () {
    Route::prefix('admin')->as('admin.')->group(function () {
        Route::get('login', [LoginController::class, 'showLogin'])->name('login.show');
        Route::post('login', [LoginController::class, 'login'])->name('login');
    });

    Route::get('register', [RegisterController::class, 'showRegister'])->name('user.registerForm');
    Route::post('register', [RegisterController::class, 'storeRegister'])->name('user.registerStore');
});

Route::middleware('auth')->group(function () {
    Route::prefix('admin')->as('admin.')->group(function () {
        Route::get('home', [HomeController::class, 'home'])->name('home');
        Route::post('approval-rejection', [HomeController::class, 'userApproval'])->name('userPass');

        Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    });
});
