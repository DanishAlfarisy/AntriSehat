@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('content')
<h1 class="text-3xl font-bold mb-6">Dashboard Admin</h1>
<div class="grid md:grid-cols-4 gap-4 mb-8">
<div class="bg-white rounded-2xl shadow p-5"><div class="text-slate-500">Dokter</div><div class="text-3xl font-bold">{{ $doctorCount }}</div></div><div class="bg-white rounded-2xl shadow p-5"><div class="text-slate-500">Jadwal</div><div class="text-3xl font-bold">{{ $scheduleCount }}</div></div><div class="bg-white rounded-2xl shadow p-5"><div class="text-slate-500">Pasien</div><div class="text-3xl font-bold">{{ $patientCount }}</div></div><div class="bg-white rounded-2xl shadow p-5"><div class="text-slate-500">Pending</div><div class="text-3xl font-bold text-amber-600">{{ $pendingCount }}</div></div>
</div>
@include('admin.appointments._table', ['appointments' => $appointments])
@endsection
