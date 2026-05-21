<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PatientDoctorController extends Controller
{
    public function index(): View
    {
        $doctors = Doctor::with('schedules')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('patient.doctors.index', compact('doctors'));
    }

    public function schedules(Doctor $doctor): View
    {
        abort_if(! $doctor->is_active, 404);

        $doctor->load('schedules');

        return view('patient.doctors.schedules', compact('doctor'));
    }
}
