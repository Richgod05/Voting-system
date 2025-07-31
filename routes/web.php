<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ResultsController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'vote'], function () {

    // Guest routes for students
    Route::group(['middleware' => 'guest'], function () {
        Route::get('register', [LoginController::class, 'index'])->name('register');
        Route::post('process_register', [LoginController::class, 'processRegister'])->name('process_register');
        Route::get('login', [LoginController::class, 'login'])->name('login');
        Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

        // Password reset routes accessible to guests
        Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
             ->name('password.reset.token');
        Route::get('reset', [ResetPasswordController::class, 'showResetForm'])
             ->name('password.reset.form');
        Route::post('send_reset', [ResetPasswordController::class, 'sendResetLink'])
             ->name('password.sendreset');
    });

    // Authenticated student routes
    Route::group(['middleware' => 'auth'], function () {
        Route::get('show', [VoteController::class, 'show'])->name('vote.show');
        Route::post('cast', [VoteController::class, 'cast'])->name('vote.cast');
        Route::get('results', [ResultsController::class, 'results'])->name('vote.results');

        // Optional reset actions after login (e.g. change password)
        Route::get('reset_password', [ResetPasswordController::class, 'resetPassword'])
             ->name('password.resetpassword');
        Route::get('resetting', [ResetPasswordController::class, 'reset'])
             ->name('password.update');

        // Logout route for students
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    });
});

Route::group(['prefix' => 'admin'], function () {

    // Guest routes for admins
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('adminlogin', [AdminController::class, 'login'])->name('admin.adminlogin');
        Route::post('authenticate', [AdminController::class, 'authenticate'])
             ->name('admin.authenticate');
    });

    // Authenticated admin routes
    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // Logout route for admins
        Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');
    });
});