<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\UserController;
use App\Models\Appointment;
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

Route::get('/', function () {
    return view('appointments', [
        'appointments' => Appointment::orderBy('start_time', 'desc')->paginate(4)
    ]);
})->name('appointments');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/users/{user}', [UserController::class, 'show'])->name('user.profile');

    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/users/{user}/update', [UserController::class, 'update'])->name('user.update');

    Route::get('/appointments/booked', [AppointmentController::class, 'booked'])->name('appointments.booked');

    Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointment.show')->where('appointment', '^[0-9]+$');

    Route::post('/appointments/{appointment}/book', [AppointmentController::class, 'book'])->name('appointment.book')->middleware('can:book,appointment');
});

Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/appointments/my', [AppointmentController::class, 'userAppointments'])->name('appointments.my');

    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointment.create');
    Route::post('/appointments/store', [AppointmentController::class, 'store'])->name('appointment.store');

    Route::get('/appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('appointment.edit');
    Route::post('/appointments/{appointment}/update', [AppointmentController::class, 'update'])->name('appointment.update');

    Route::delete('/appointments/{appointment}/delete', [AppointmentController::class, 'destroy'])->name('appointment.destroy');
});


