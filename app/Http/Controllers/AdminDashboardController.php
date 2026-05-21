<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\DoctorSchedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'doctorCount' => Doctor::count(),
            'scheduleCount' => DoctorSchedule::count(),
            'patientCount' => User::where('role', 'pasien')->count(),
            'pendingCount' => Appointment::where('status', 'pending')->count(),
            'appointments' => Appointment::with('patient', 'doctorSchedule.doctor')->latest()->take(5)->get(),
        ]);
    }
}
