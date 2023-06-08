<?php

use App\Http\Controllers\CreditsController;
use App\Http\Controllers\PaymentController;
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

// These routes should require authentication
Route::get('/', [CreditsController::class, 'index'])->name('credits.index');
Route::get('/create-credit', [CreditsController::class, 'create'])->name('credits.create');
Route::get('/create-payment', [PaymentController::class, 'create'])->name('payments.create');

