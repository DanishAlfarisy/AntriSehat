<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $data = $this->validated($request);

        if (!empty($data['cropped_photo'])) {
            $data['photo'] = $this->saveCroppedPhoto($data['cropped_photo']);
        }

        unset($data['cropped_photo']);

        Doctor::create($data);

        return redirect()->route('admin.doctors.index')->with('success', 'Data dokter berhasil ditambahkan.');
    }

    public function edit(Doctor $doctor): View
    {
        return view('admin.doctors.edit', compact('doctor'));
    }

    public function update(Request $request, Doctor $doctor): RedirectResponse
    {
        $data = $this->validated($request);

        if (!empty($data['cropped_photo'])) {
            if ($doctor->photo) {
                Storage::disk('public')->delete($doctor->photo);
            }

            $data['photo'] = $this->saveCroppedPhoto($data['cropped_photo']);
        }

        unset($data['cropped_photo']);

        $doctor->update($data);

        return redirect()->route('admin.doctors.index')->with('success', 'Data dokter berhasil diperbarui.');
    }

    public function destroy(Doctor $doctor): RedirectResponse
    {
        if ($doctor->photo) {
            Storage::disk('public')->delete($doctor->photo);
        }

        $doctor->delete();

        return redirect()->route('admin.doctors.index')->with('success', 'Data dokter berhasil dihapus.');
    }

    private function saveCroppedPhoto(string $base64Image): string
    {
        $image = preg_replace('/^data:image\/\w+;base64,/', '', $base64Image);
        $image = str_replace(' ', '+', $image);

        $fileName = 'doctor_' . time() . '_' . uniqid() . '.jpg';
        $path = 'doctors/' . $fileName;

        Storage::disk('public')->put($path, base64_decode($image));

        return $path;
    }

    private function validated(Request $request): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'specialization' => ['required', 'string', 'max:255'],
            'str_number' => ['nullable', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:30'],
            'cropped_photo' => ['nullable', 'string'],
            'consultation_fee' => ['required', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        return $validated;
    }
}