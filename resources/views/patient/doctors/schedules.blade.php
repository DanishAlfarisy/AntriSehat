@extends('layouts.app')
@section('title', 'Jadwal Dokter')
@section('content')
<div class="mb-6"><h1 class="text-3xl font-bold">Jadwal {{ $doctor->name }}</h1><p class="text-emerald-600">{{ $doctor->specialization }}</p></div>
<div class="bg-white rounded-2xl shadow overflow-x-auto"><table class="w-full text-sm"><thead class="bg-slate-100"><tr><th class="p-3 text-left">Hari</th><th class="p-3 text-left">Jam</th><th class="p-3 text-left">Kuota</th><th class="p-3"></th></tr></thead><tbody>
@forelse($doctor->schedules as $schedule)<tr class="border-t"><td class="p-3">{{ $schedule->day }}</td><td class="p-3">{{ substr($schedule->start_time,0,5) }} - {{ substr($schedule->end_time,0,5) }}</td><td class="p-3">{{ $schedule->quota }}</td><td class="p-3 text-right"><a class="rounded-lg bg-emerald-600 px-3 py-2 text-white" href="{{ route('appointments.create', $schedule) }}">Booking</a></td></tr>@empty<tr><td colspan="4" class="p-4 text-center text-slate-500">Belum ada jadwal.</td></tr>@endforelse
</tbody></table></div>
@endsection
