@extends('layouts.app')
@section('title', 'Dashboard Pasien')
@section('content')
<div class="mb-6"><h1 class="text-3xl font-bold">Dashboard Pasien</h1><p class="text-slate-500">Selamat datang, {{ auth()->user()->name }}. Kelola booking konsultasi Anda.</p></div>
<div class="grid md:grid-cols-3 gap-4 mb-8">
    <div class="bg-white rounded-2xl shadow p-5"><div class="text-slate-500">Appointment Aktif</div><div class="text-3xl font-bold text-emerald-600">{{ $activeAppointments }}</div></div>
    <div class="bg-white rounded-2xl shadow p-5"><div class="text-slate-500">Selesai</div><div class="text-3xl font-bold text-blue-600">{{ $completedAppointments }}</div></div>
    <div class="bg-white rounded-2xl shadow p-5"><div class="text-slate-500">Dokter Aktif</div><div class="text-3xl font-bold text-purple-600">{{ $doctorCount }}</div></div>
</div>
<div class="flex gap-3 mb-6"><a href="{{ route('doctors.index') }}" class="rounded-lg bg-emerald-600 px-4 py-2 text-white">Lihat Dokter</a><a href="{{ route('appointments.index') }}" class="rounded-lg bg-white px-4 py-2 shadow">Riwayat Appointment</a></div>
@include('patient.appointments._table', ['appointments' => $appointments])
@endsection
