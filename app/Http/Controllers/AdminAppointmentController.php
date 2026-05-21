<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminAppointmentController extends Controller
{
    public function index(): View
    {
        $appointments = Appointment::with('patient', 'doctorSchedule.doctor')
            ->latest()
            ->get();

        return view('admin.appointments.index', compact('appointments'));
    }

    public function confirm(Appointment $appointment): RedirectResponse
    {
        if ($appointment->status !== 'pending') {
            return back()->with('error', 'Hanya appointment pending yang dapat dikonfirmasi.');
        }

        $appointment->update(['status' => 'confirmed']);

        return back()->with('success', 'Appointment berhasil dikonfirmasi.');
    }

    public function cancel(Appointment $appointment): RedirectResponse
    {
        if (! in_array($appointment->status, ['pending', 'confirmed'], true)) {
            return back()->with('error', 'Hanya appointment pending/confirmed yang dapat dibatalkan.');
        }

        $appointment->update(['status' => 'cancelled']);

        return back()->with('success', 'Appointment berhasil dibatalkan.');
    }

    public function complete(Appointment $appointment): RedirectResponse
    {
        if ($appointment->status !== 'confirmed') {
            return back()->with('error', 'Hanya appointment confirmed yang dapat diselesaikan.');
        }

        $appointment->update(['status' => 'completed']);

        return back()->with('success', 'Appointment berhasil diselesaikan.');
    }
}
