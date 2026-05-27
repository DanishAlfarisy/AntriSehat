@extends('layouts.app')
@section('title', 'Booking Appointment')
@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow p-6">
<h1 class="text-2xl font-bold mb-1">Booking Appointment</h1><p class="text-slate-500 mb-6">{{ $schedule->doctor->name }} - {{ $schedule->day }} {{ substr($schedule->start_time,0,5) }} sampai {{ substr($schedule->end_time,0,5) }}</p>
<form method="POST" action="{{ route('appointments.store', $schedule) }}" class="space-y-4">@csrf
@php
    use Carbon\Carbon;

    $dayMap = [
        'minggu' => 0,
        'senin' => 1,
        'selasa' => 2,
        'rabu' => 3,
        'kamis' => 4,
        'jumat' => 5,
        "jum'at" => 5,
        'sabtu' => 6,
    ];

    $scheduleDay = strtolower($schedule->day);
    $targetDay = $dayMap[$scheduleDay] ?? null;

    $availableDates = [];
    $date = Carbon::today();

    while (count($availableDates) < 8) {
        if ($date->dayOfWeek === $targetDay) {
            $availableDates[] = $date->copy();
        }

        $date->addDay();
    }
@endphp

<div>
    <label class="font-medium">Tanggal Appointment</label>

    <select
        name="appointment_date"
        class="mt-1 w-full rounded-lg border border-slate-400 bg-white px-3 py-2"
        required
    >
        <option value="">Pilih tanggal appointment</option>

        @foreach ($availableDates as $availableDate)
            <option
                value="{{ $availableDate->format('Y-m-d') }}"
                @selected(old('appointment_date') == $availableDate->format('Y-m-d'))
            >
                {{ $availableDate->translatedFormat('l, d F Y') }}
            </option>
        @endforeach
    </select>

    @error('appointment_date')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
<div><label class="font-medium">Keluhan</label><textarea name="complaint" rows="4" class="mt-1 w-full rounded-lg border-slate-300">{{ old('complaint') }}</textarea></div>
<button class="rounded-lg bg-emerald-600 px-4 py-2 text-white">Buat Booking</button>
</form></div>
@endsection
