@extends('layouts.app')
@section('title', 'Register Pasien - AntriSehat')
@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow p-6">
    <h1 class="text-2xl font-bold mb-2">Registrasi Pasien</h1><p class="text-slate-500 mb-6">Buat akun pasien untuk booking jadwal dokter.</p>
    <form method="POST" action="{{ route('register.store') }}" class="grid md:grid-cols-2 gap-4">@csrf
        <div class="md:col-span-2"><label class="font-medium">Nama</label><input name="name" value="{{ old('name') }}" class="mt-1 w-full rounded-lg border-slate-300" required></div>
        <div><label class="font-medium">Email</label><input name="email" type="email" value="{{ old('email') }}" class="mt-1 w-full rounded-lg border-slate-300" required></div>
        <div><label class="font-medium">No. HP</label><input name="phone" value="{{ old('phone') }}" class="mt-1 w-full rounded-lg border-slate-300"></div>
        <div><label class="font-medium">Tanggal Lahir</label><input name="birth_date" type="date" value="{{ old('birth_date') }}" class="mt-1 w-full rounded-lg border-slate-300"></div>
        <div><label class="font-medium">Gender</label><select name="gender" class="mt-1 w-full rounded-lg border-slate-300"><option value="">Pilih</option><option>Laki-laki</option><option>Perempuan</option></select></div>
        <div><label class="font-medium">Password</label><input name="password" type="password" class="mt-1 w-full rounded-lg border-slate-300" required></div>
        <div><label class="font-medium">Konfirmasi Password</label><input name="password_confirmation" type="password" class="mt-1 w-full rounded-lg border-slate-300" required></div>
        <div class="md:col-span-2"><button class="w-full rounded-lg bg-emerald-600 px-4 py-2 text-white hover:bg-emerald-700">Register</button></div>
    </form>
</div>
@endsection
