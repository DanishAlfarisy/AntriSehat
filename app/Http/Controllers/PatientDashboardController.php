<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PatientDashboardController extends Controller
{
    public function index(): View
    {
        $appointments = Appointment::with('doctorSchedule.doctor')
            ->where('patient_id', Auth::id())
            ->latest()
            ->take(5)
            ->get();

        return view('patient.dashboard', [
            'activeAppointments' => Appointment::where('patient_id', Auth::id())->whereIn('status', ['pending', 'confirmed'])->count(),
            'completedAppointments' => Appointment::where('patient_id', Auth::id())->where('status', 'completed')->count(),
            'doctorCount' => Doctor::where('is_active', true)->count(),
            'appointments' => $appointments,
        ]);
    }
}
