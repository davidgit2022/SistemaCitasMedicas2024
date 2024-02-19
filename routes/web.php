<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Doctor\ScheduleController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpecialtyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('/specialties', SpecialtyController::class);
    Route::resource('/doctors', DoctorController::class);
    Route::resource('/patients', PatientController::class);
});

Route::middleware(['auth', 'doctor'])->group(function () {
    Route::get('/schedule', [ScheduleController::class, 'edit'])->name('schedule.edit');
    Route::post('/schedule-store', [ScheduleController::class, 'store'])->name('schedule.store');
});

Route::middleware(['auth', 'patient'])->group(function () {
    Route::get('/booking-appointments', [AppointmentController::class, 'create'])->name('appointments.create');

    Route::post('/my-appointments', [AppointmentController::class, 'store'])->name('appointments.store');

    Route::get('/specialties/{specialty}/doctors', [AppointmentController::class, 'create'])->name('appointments.create');
});

require __DIR__.'/auth.php';
