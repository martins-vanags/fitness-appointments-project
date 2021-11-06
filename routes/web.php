<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\FrontPageController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
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
    Route::post('/create', [UserController::class, 'create'])->name('create');
    Route::post('/update', [UserController::class, 'update'])->name('update');
    Route::delete('/delete', [UserController::class, 'delete'])->name('delete');

    Route::post('/new-appointment', fn() => view('user.create-appointment'))->name('new.appointment');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/my-appointments', [UserController::class, 'show'])->name('my.appointments');
});


