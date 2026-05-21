@extends('layouts.app')
@section('title', 'Booking Appointment')
@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow p-6">
<h1 class="text-2xl font-bold mb-1">Booking Appointment</h1><p class="text-slate-500 mb-6">{{ $schedule->doctor->name }} - {{ $schedule->day }} {{ substr($schedule->start_time,0,5) }} sampai {{ substr($schedule->end_time,0,5) }}</p>
<form method="POST" action="{{ route('appointments.store', $schedule) }}" class="space-y-4">@csrf
<div><label class="font-medium">Tanggal Appointment</label><input name="appointment_date" type="date" value="{{ old('appointment_date') }}" class="mt-1 w-full rounded-lg border-slate-300" required></div>
<div><label class="font-medium">Keluhan</label><textarea name="complaint" rows="4" class="mt-1 w-full rounded-lg border-slate-300">{{ old('complaint') }}</textarea></div>
<button class="rounded-lg bg-emerald-600 px-4 py-2 text-white">Buat Booking</button>
</form></div>
@endsection
