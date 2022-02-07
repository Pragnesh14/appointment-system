<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [App\Http\Controllers\FrontEndController::class, 'index']);
Route::get('/new-appointment/{doctorId}/{date}', [App\Http\Controllers\FrontEndController::class, 'show'])->name('create.appointment');
Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

// Patient Routes
Route::group(['middleware' => ['auth', 'patient']], function () {
    // Profile Routes
    Route::get('/user-profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::post('/user-profile', [App\Http\Controllers\ProfileController::class, 'store'])->name('profile.store');
    Route::post('/profile-pic', [App\Http\Controllers\ProfileController::class, 'profilePic'])->name('profile.pic');

    Route::post('/book/appointment', [App\Http\Controllers\FrontEndController::class, 'store'])->name('book.appointment');
    Route::get('/my-booking', [App\Http\Controllers\FrontEndController::class, 'myBookings'])->name('my.booking');
});

// Admin Routes
Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::resource('doctor', App\Http\Controllers\DoctorController::class);
    Route::get('/patients', [App\Http\Controllers\PatientController::class, 'index'])->name('patients');
    Route::get('/status/update/{id}', [App\Http\Controllers\PatientController::class, 'toggleStatus'])->name('update.status');
    Route::get('/all-patients', [App\Http\Controllers\PatientController::class, 'allTimeAppointment'])->name('all.appointments');
    Route::resource('/department', App\Http\Controllers\DepartmentController::class);
});

// Doctor Routes
Route::group(['middleware' => ['auth', 'doctor']], function () {
    Route::resource('appointment', App\Http\Controllers\AppointmentController::class);
    Route::post('/appointment/check', [App\Http\Controllers\AppointmentController::class, 'check'])->name('appointment.check');
    Route::post('/appointment/update', [App\Http\Controllers\AppointmentController::class, 'updateTime'])->name('update');
});
