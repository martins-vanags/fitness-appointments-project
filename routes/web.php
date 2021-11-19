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
    Route::get('/{id}/profile', [UserController::class, 'edit'])->name('user.profile');
    Route::post('/update-profile', [UserController::class, 'update'])->name('update.profile');

    Route::get('/booked-appointments', [UserController::class, 'booked'])->name('user.booked.appointments');

    Route::get('/{id}/appointment', [AppointmentController::class, 'show'])->name('show');

    Route::post('/book', [AppointmentController::class, 'book'])->name('book');
});

Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/my-appointments', [UserController::class, 'show'])->name('user.appointments');

    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointment.create');
    Route::post('/appointments/store', [AppointmentController::class, 'store'])->name('appointment.store');

    Route::get('/appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('appointment.edit');
    Route::post('/appointments/{appointment}/update', [AppointmentController::class, 'update'])->name('appointment.update');

    Route::delete('/appointments/{appointment}/delete', [AppointmentController::class, 'destroy'])->name('appointment.destroy');
});


