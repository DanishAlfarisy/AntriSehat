<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\DoctorSchedule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminScheduleController extends Controller
{
    public function index(): View
    {
        $schedules = DoctorSchedule::with('doctor')->latest()->get();

        return view('admin.schedules.index', compact('schedules'));
    }

    public function create(): View
    {
        return view('admin.schedules.create', ['doctors' => Doctor::where('is_active', true)->orderBy('name')->get()]);
    }

    public function store(Request $request): RedirectResponse
    {
        DoctorSchedule::create($this->validated($request));

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal praktik berhasil ditambahkan.');
    }

    public function edit(DoctorSchedule $schedule): View
    {
        return view('admin.schedules.edit', [
            'schedule' => $schedule,
            'doctors' => Doctor::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, DoctorSchedule $schedule): RedirectResponse
    {
        $schedule->update($this->validated($request));

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal praktik berhasil diperbarui.');
    }

    public function destroy(DoctorSchedule $schedule): RedirectResponse
    {
        $schedule->delete();

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal praktik berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'doctor_id' => ['required', 'exists:doctors,id'],
            'day' => ['required', 'string', 'max:30'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'quota' => ['required', 'integer', 'min:1'],
        ]);
    }
}
