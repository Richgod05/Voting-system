<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DasboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ResultsController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::group(['prefix' => 'vote'], function () {

    // Guest routes for students
    Route::group(['middleware' => 'guest'], function () {
        Route::get('register', [LoginController::class, 'index'])->name('register');
        Route::post('process_register', [LoginController::class, 'processRegister'])->name('process_register');
        Route::get('login', [LoginController::class, 'login'])->name('login');
        Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

        // Password reset routes accessible to guests

                Route::get('reset', [ResetPasswordController::class, 'resetPassword']);
                Route::post('send_reset', [ResetPasswordController::class, 'sendResetLink'])
                    ->name('password.sendreset');

                Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
                    ->name('password.reset');

                Route::post('reset-password', [ResetPasswordController::class, 'reset'])
                    ->name('password.update');
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
        Route::get('candidates', [DasboardController::class, 'index'])->name('admin.candidate');
        Route::get('qualified', [DasboardController::class, 'showQualified'])->name('admin.qualifiedcandidates');
        Route::get('admins', [DasboardController::class, 'user'])->name('admin.user');     
        Route::get('create_candidate', [DasboardController::class, 'create'])->name('Admin.addcandidate');
        Route::post('store_candidate', [DasboardController::class, 'store'])->name('admin.store_candidate');
        Route::get('results', [AdminController::class, 'adminResults'])->name('admin.results');
        Route::get('president_candidate',[DasboardController::class, 'showPresident'])->name('Admin.president');
        Route::get('parliament_candidate',[DasboardController::class, 'showParliament'])->name('Admin.parliament');
        Route::get('chairperson_candidate',[DasboardController::class, 'showChairperson'])->name('Admin.chairperson');



        // Logout route for admins
        Route::post('logout', [AdminController::class, 'logoutAdmin'])->name('admin.logout');
    });
});