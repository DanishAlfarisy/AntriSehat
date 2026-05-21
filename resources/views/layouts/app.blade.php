<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AntriSehat')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-800">
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            <a href="{{ url('/') }}" class="text-2xl font-bold text-emerald-600">AntriSehat</a>
            <div class="flex flex-wrap items-center gap-3 text-sm">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a class="hover:text-emerald-600" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <a class="hover:text-emerald-600" href="{{ route('admin.doctors.index') }}">Dokter</a>
                        <a class="hover:text-emerald-600" href="{{ route('admin.schedules.index') }}">Jadwal</a>
                        <a class="hover:text-emerald-600" href="{{ route('admin.appointments.index') }}">Appointment</a>
                    @else
                        <a class="hover:text-emerald-600" href="{{ route('dashboard') }}">Dashboard</a>
                        <a class="hover:text-emerald-600" href="{{ route('doctors.index') }}">Dokter</a>
                        <a class="hover:text-emerald-600" href="{{ route('appointments.index') }}">Riwayat</a>
                    @endif
                    <span class="text-slate-500">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">@csrf<button class="px-3 py-2 rounded-lg bg-red-500 text-white hover:bg-red-600">Logout</button></form>
                @else
                    <a class="hover:text-emerald-600" href="{{ route('login') }}">Login</a>
                    <a class="px-3 py-2 rounded-lg bg-emerald-600 text-white hover:bg-emerald-700" href="{{ route('register') }}">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))<div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-700">{{ session('success') }}</div>@endif
        @if(session('error'))<div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-red-700">{{ session('error') }}</div>@endif
        @if($errors->any())
            <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-red-700"><ul class="list-disc pl-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
        @endif
        @yield('content')
    </main>
</body>
</html>
