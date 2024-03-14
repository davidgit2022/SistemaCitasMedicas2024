<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ChartController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\SpecialtyController;

use App\Http\Controllers\Doctor\ScheduleController;
use App\Http\Controllers\Api\ScheduleController as ApiScheduleController;
use App\Http\Controllers\Api\SpecialtyController as ApiSpecialtyController;

Route::get('/', function () {
    return view('auth.login');
});

/* Google */

Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/google-auth/callback', function () {
    $user_google = Socialite::driver('google')->stateless()->user();

    $user = User::updateOrCreate([
        'google_id' => $user_google->id,
    ],[
        'name' => $user_google->name,
        'email' => $user_google->email,
    ]);

    Auth::login($user);

    return redirect('/dashboard');
});

/* GitHub */
/* Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
});

Route::get('/auth/callback', function () {
    $user = Socialite::driver('github')->user();

    
}); */

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {

    /* Specialties */

    Route::resource('/specialties', SpecialtyController::class);

    Route::controller(SpecialtyController::class)->group(function () {

        Route::get('/specialties-import', 'formImport')->name('specialties.import');

        Route::post('/specialties-import', 'import')->name('specialties.import');

        Route::get('specialties-export/', 'export')->name('specialties.export-excel');
    });


    /* Doctors */
    Route::resource('/doctors', DoctorController::class);
    Route::get('doctors-export/', [DoctorController::class, 'exportListDoctor'])->name('doctors.export-excel');


    /* Patients */
    Route::resource('/patients', PatientController::class);
    Route::get('patients-export/', [PatientController::class, 'exportListPatients'])->name('patients.export-excel');

    /* Reports */

    Route::controller(ChartController::class)->group(function () {

        Route::get('/reports/appointment/line', 'appointments')->name('reports.appointments');

        Route::get('/reports/doctors/column', 'doctors')->name('reports.doctors');

        Route::get('/reports/doctors/column/data', 'doctorsJson')->name('reports.doctors-json');
    });
});

Route::middleware(['auth', 'doctor'])->group(function () {

    /* schedule */
    Route::get('/schedule', [ScheduleController::class, 'edit'])->name('schedule.edit');

    /* schedule-store */
    Route::post('/schedule-store', [ScheduleController::class, 'store'])->name('schedule.store');
});

Route::middleware('auth')->group(function () {

    /* Appointments */
    Route::controller(AppointmentController::class)->group(function () {
        Route::get('/booking-appointments/create',  'create')->name('appointments.create');

        Route::post('/book-appointment',  'store')->name('appointments.store');

        Route::get('/my-appointments',  'index')->name('appointments.index');

        Route::get('/my-appointments/{appointment}', 'show')->name('appointments.show');

        Route::post('/my-appointments/{appointment}/cancel', 'cancel')->name('appointments.cancel');

        Route::post('/my-appointments/{appointment}/confirm', 'confirm')->name('appointments.confirm');

        Route::get('/my-appointments/{appointment}/cancel', 'formCancel')->name('appointments.form-cancel');
    });

    //JSON
    Route::get('/specialties/{specialty}/doctors', [ApiSpecialtyController::class, 'doctors'])->name('appointments.doctors');

    Route::get('/schedule/hours', [ApiScheduleController::class, 'hours'])->name('schedule.hours');
});

require __DIR__ . '/auth.php';
