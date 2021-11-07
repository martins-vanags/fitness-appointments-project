<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\FrontPageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FrontPageController::class, 'index'])->name('all.appointments');

Auth::routes();

Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::post('/create', [AppointmentController::class, 'create'])->name('create');
    Route::post('/update', [AppointmentController::class, 'update'])->name('update');
    Route::delete('/delete', [AppointmentController::class, 'delete'])->name('delete');

    Route::post('/new-appointment', fn() => view('user.create-appointment'))->name('new.appointment');
});

Route::middleware('auth')->group(function () {
    Route::get('/{id}/appointments', [UserController::class, 'show'])->name('user.appointments');
    Route::get('/{id}/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('/update/profile', [UserController::class, 'update'])->name('update.profile');
});


