@extends('layouts.app')
@section('title', 'Riwayat Appointment')
@section('content')
<div class="flex items-center justify-between mb-6"><h1 class="text-3xl font-bold">Riwayat Appointment</h1><a href="{{ route('doctors.index') }}" class="rounded-lg bg-emerald-600 px-4 py-2 text-white">Booking Baru</a></div>
@include('patient.appointments._table', ['appointments' => $appointments])
@endsection
