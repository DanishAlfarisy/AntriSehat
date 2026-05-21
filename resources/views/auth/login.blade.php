@extends('layouts.app')
@section('title', 'Login - AntriSehat')
@section('content')
<div class="max-w-md mx-auto bg-white rounded-2xl shadow p-6">
    <h1 class="text-2xl font-bold mb-2">Login</h1><p class="text-slate-500 mb-6">Masuk sebagai pasien atau admin klinik.</p>
    <form method="POST" action="{{ route('login.store') }}" class="space-y-4">@csrf
        <div><label class="font-medium">Email</label><input name="email" type="email" value="{{ old('email') }}" class="mt-1 w-full rounded-lg border-slate-300" required></div>
        <div><label class="font-medium">Password</label><input name="password" type="password" class="mt-1 w-full rounded-lg border-slate-300" required></div>
        <button class="w-full rounded-lg bg-emerald-600 px-4 py-2 text-white hover:bg-emerald-700">Login</button>
    </form>
    <div class="mt-4 text-sm text-slate-600">Belum punya akun? <a class="text-emerald-600" href="{{ route('register') }}">Register pasien</a></div>
    <div class="mt-4 rounded-lg bg-slate-50 p-3 text-sm"><b>Dummy:</b><br>Admin: admin@antrisehat.com / admin123<br>Pasien: pasien@antrisehat.com / pasien123</div>
</div>
@endsection
