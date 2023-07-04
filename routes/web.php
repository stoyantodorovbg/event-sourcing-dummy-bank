<?php

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\AvailabilitiesController;
use App\Http\Controllers\CreditsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DepositController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'home'])->name('home.home');
Route::get('/credits', [CreditsController::class, 'index'])->name('credits.index');
Route::get('/accounts', [AccountsController::class, 'index'])->name('accounts.index');
Route::get('/availabilities', [AvailabilitiesController::class, 'index'])->name('availabilities.index');

