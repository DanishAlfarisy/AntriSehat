<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\DoctorSchedule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PatientAppointmentController extends Controller
{
    public function index(): View
    {
        $appointments = Appointment::with('doctorSchedule.doctor')
            ->where('patient_id', Auth::id())
            ->latest()
            ->get();

        return view('patient.appointments.index', compact('appointments'));
    }

    public function create(DoctorSchedule $schedule): View
    {
        $schedule->load('doctor');

        return view('patient.appointments.create', compact('schedule'));
    }

    public function store(Request $request, DoctorSchedule $schedule): RedirectResponse
    {
        $validated = $request->validate([
            'appointment_date' => ['required', 'date', 'after_or_equal:today'],
            'complaint' => ['nullable', 'string'],
        ]);

        $activeCount = Appointment::where('doctor_schedule_id', $schedule->id)
            ->whereDate('appointment_date', $validated['appointment_date'])
            ->where('status', '!=', 'cancelled')
            ->count();

        if ($activeCount >= $schedule->quota) {
            return back()->withInput()->with('error', 'Kuota jadwal sudah penuh.');
        }

        Appointment::create([
            'patient_id' => Auth::id(),
            'doctor_schedule_id' => $schedule->id,
            'appointment_date' => $validated['appointment_date'],
            'status' => 'pending',
            'complaint' => $validated['complaint'] ?? null,
            'queue_number' => $activeCount + 1,
        ]);

        return redirect()->route('appointments.index')->with('success', 'Booking berhasil dibuat. Nomor antrean Anda: '.($activeCount + 1));
    }

    public function cancel(Appointment $appointment): RedirectResponse
    {
        if ($appointment->patient_id !== Auth::id()) {
            abort(403);
        }

        if ($appointment->status !== 'pending') {
            return back()->with('error', 'Appointment yang sudah cancelled/completed/confirmed tidak bisa dibatalkan pasien.');
        }

        $appointment->update(['status' => 'cancelled']);

        return back()->with('success', 'Appointment berhasil dibatalkan.');
    }
}
