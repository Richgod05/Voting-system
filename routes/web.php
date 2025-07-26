<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ResultsController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'vote'], function (){
  Route::group(['middleware' => 'guest'], function(){
    Route::get('register', [LoginController::class, 'index'])->name('register');
    Route::post('process_register', [LoginController::class, 'ProcessRegister'])->name('process_register');
    Route::get('cast', [VoteController::class, 'cast'])->name('vote.cast');
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');




  });

  Route::group(['middleware' => 'auth'], function() {
    Route::get('show', [VoteController::class, 'show'])->name('vote.show');
    Route::get('results', [ResultsController::class, 'results'])->name('vote.results');
    Route::get('reset_password', [ResetPasswordController::class, 'resetPassword'])->name('password.resetpassword');
    Route::post('send_reset', [ResetPasswordController::class, 'sendResetLink'])->name('password.sendreset');
    Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::get('reset', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::get('/resetting', [ResetPasswordController::class, 'reset'])->name('password.update');
  });

});

Route::group(['prefix' => 'admin'], function(){
  Route::group(['middleware' => 'guest'], function(){

  });

  Route::group(['middleware' => 'auth'], function(){
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
  });
});

