<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
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

Route::get('/', [AppointmentController::class, 'show'])->name('all.appointments');

Auth::routes();

Route::middleware(['auth', 'role:teacher'])->group(function () {
    // Show create form
    Route::post('/create-appointment', [AppointmentController::class, 'create'])->name('create.appointment');
    // Show table with edit / delete options
    Route::post('/edit-appointments', [TeacherController::class, 'show'])->name('edit.appointments');
    // Create new appointment
    Route::post('/create', [TeacherController::class, 'create'])->name('create');
});


// TODO: Probably doesnt work will fix it later
Route::middleware(['auth', 'role:student'])->group(function () {
    // Show student booked appointments
    Route::post('/my-appointments', [StudentController::class, 'show'])->name('student.appointments');
});


