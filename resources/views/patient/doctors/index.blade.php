@extends('layouts.app')
@section('title', 'Daftar Dokter')
@section('content')
<h1 class="text-3xl font-bold mb-6">Daftar Dokter Aktif</h1>
<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
@foreach($doctors as $doctor)
    <div class="bg-white rounded-2xl shadow p-5">
        <div class="mb-4 h-16 w-16 overflow-hidden rounded-full bg-emerald-100 flex items-center justify-center">
    @if ($doctor->photo)
        <img
            src="{{ asset('storage/' . $doctor->photo) }}"
            alt="{{ $doctor->name }}"
            class="h-full w-full object-cover"
        >
    @else
        <span class="text-2xl font-medium text-slate-900">?</span>
    @endif
</div>
        <h2 class="text-xl font-bold">{{ $doctor->name }}</h2><p class="text-emerald-600 font-medium">{{ $doctor->specialization }}</p>
        <p class="text-sm text-slate-500 mt-2">Biaya: Rp{{ number_format($doctor->consultation_fee, 0, ',', '.') }}</p>
        <p class="text-sm text-slate-500">{{ $doctor->schedules->count() }} jadwal tersedia</p>
        <a href="{{ route('doctors.schedules', $doctor) }}" class="mt-4 inline-block rounded-lg bg-emerald-600 px-4 py-2 text-white">Lihat Jadwal</a>
    </div>
@endforeach
</div>
@endsection
