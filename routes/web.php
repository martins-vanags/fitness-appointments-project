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

Route::middleware('auth')->group(function () {
    Route::get('/{id}/profile', [UserController::class, 'profile'])->name('user.profile');

    Route::get('/my-appointments', [UserController::class, 'show'])->name('user.appointments');

    Route::post('/update-profile', [UserController::class, 'update'])->name('update.profile');
});

Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/edit/{id}', [AppointmentController::class, 'edit'])->name('edit');
    Route::post('/update', [AppointmentController::class, 'update'])->name('update');

    Route::get('/create', [AppointmentController::class, 'create'])->name('new.appointment');
    Route::post('/store', [AppointmentController::class, 'store'])->name('store');

    Route::delete('/delete', [AppointmentController::class, 'destroy'])->name('destroy');
});


