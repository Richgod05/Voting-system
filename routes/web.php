<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResultsController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

Route::get('/vote', [VoteController::class, 'show'])->name('vote.show');
Route::post('/vote', [VoteController::class, 'cast'])->name('vote.cast');
Route::get('/results', [ResultsController::class, 'results'])->name('vote.results');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/register', [LoginController::class, 'index'])->name('register');
Route::post('/process_register', [LoginController::class, 'ProcessRegister'])->name('process_register');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('/', [LoginController::class, 'login'])->name('login');