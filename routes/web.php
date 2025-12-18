<?php

use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\users\LoginController as UsersLoginController;
use App\Http\Controllers\users\ProfileController;
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

    Route::get('login', [UsersLoginController::class, 'showLogin'])->name('UserLogin.show');
    Route::post('login', [UsersLoginController::class, 'login'])->name('UserLogin');
});

Route::middleware('auth:web')->group(function () {
    Route::prefix('admin')->as('admin.')->group(function () {
        Route::get('home', [HomeController::class, 'home'])->name('home');
        Route::post('approval-rejection', [HomeController::class, 'userApproval'])->name('userApprove');

        Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    });
});
Route::middleware('auth:web_tenant')->group(function () {
    Route::prefix('user')->as('user.')->group(function () {
        Route::get('profile', [ProfileController::class, 'show'])->name('profile');
        Route::post('update-profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('change-password', [ProfileController::class, 'UpdateChangePassword'])->name('changePassword.update');

        Route::get('logout', [UsersLoginController::class, 'logout'])->name('logout');
    });
});
