<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminDoctorController extends Controller
{
    public function index(): View
    {
        $doctors = Doctor::withCount('schedules')->latest()->get();

        return view('admin.doctors.index', compact('doctors'));
    }

    public function create(): View
    {
        return view('admin.doctors.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Doctor::create($this->validated($request));

        return redirect()->route('admin.doctors.index')->with('success', 'Data dokter berhasil ditambahkan.');
    }

    public function edit(Doctor $doctor): View
    {
        return view('admin.doctors.edit', compact('doctor'));
    }

    public function update(Request $request, Doctor $doctor): RedirectResponse
    {
        $doctor->update($this->validated($request));

        return redirect()->route('admin.doctors.index')->with('success', 'Data dokter berhasil diperbarui.');
    }

    public function destroy(Doctor $doctor): RedirectResponse
    {
        $doctor->delete();

        return redirect()->route('admin.doctors.index')->with('success', 'Data dokter berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'specialization' => ['required', 'string', 'max:255'],
            'str_number' => ['nullable', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:30'],
            'consultation_fee' => ['required', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        return $validated;
    }
}
