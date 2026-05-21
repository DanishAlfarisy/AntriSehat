<?php

use App\Http\Controllers\AdminAppointmentController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminDoctorController;
use App\Http\Controllers\AdminScheduleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientAppointmentController;
use App\Http\Controllers\PatientDashboardController;
use App\Http\Controllers\PatientDoctorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (! Auth::check()) {
        return redirect()->route('login');
    }

    return Auth::user()->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('dashboard');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware(['auth', 'role:pasien'])->group(function () {
    Route::get('/dashboard', [PatientDashboardController::class, 'index'])->name('dashboard');
    Route::get('/doctors', [PatientDoctorController::class, 'index'])->name('doctors.index');
    Route::get('/doctors/{doctor}/schedules', [PatientDoctorController::class, 'schedules'])->name('doctors.schedules');
    Route::get('/appointments', [PatientAppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/create/{schedule}', [PatientAppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments/create/{schedule}', [PatientAppointmentController::class, 'store'])->name('appointments.store');
    Route::post('/appointments/{appointment}/cancel', [PatientAppointmentController::class, 'cancel'])->name('appointments.cancel');
    Route::get('/appointments/{appointment}/cancel', [PatientAppointmentController::class, 'cancel']);
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('doctors', AdminDoctorController::class)->except(['show']);
    Route::resource('schedules', AdminScheduleController::class)->except(['show']);
    Route::get('/appointments', [AdminAppointmentController::class, 'index'])->name('appointments.index');
    Route::post('/appointments/{appointment}/confirm', [AdminAppointmentController::class, 'confirm'])->name('appointments.confirm');
    Route::post('/appointments/{appointment}/cancel', [AdminAppointmentController::class, 'cancel'])->name('appointments.cancel');
    Route::post('/appointments/{appointment}/complete', [AdminAppointmentController::class, 'complete'])->name('appointments.complete');
});
