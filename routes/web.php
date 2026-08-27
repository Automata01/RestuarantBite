<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::post('/login', [AuthController::class, 'login'])
    ->middleware('guest')
    ->name('login');


Route::post('/register', [AuthController::class, 'register'])
    ->middleware('guest')
    ->name('register');


Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


Route::middleware('auth')->group(function () {

    Route::get(
        '/reservations/create',
        [ReservationController::class, 'create']
    )->name('reservations.create');

    Route::post(
        '/reservations',
        [ReservationController::class, 'store']
    )->name('reservations.store');

    Route::get(
        '/reservations',
        [ReservationController::class, 'index']
    )->name('reservations.index');

    Route::get(
        '/reservations/{id}/receipt',
        [ReservationController::class, 'receipt']
    )->name('reservations.receipt');

});

Route::middleware(['auth'])->group(function () {

    Route::get('/admin', [AdminController::class, 'index'])
        ->name('admin.dashboard');

});