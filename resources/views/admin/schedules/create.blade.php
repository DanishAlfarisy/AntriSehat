@extends('layouts.app')
@section('title', 'Tambah Jadwal')
@section('content')
<div class="bg-white rounded-2xl shadow p-6"><h1 class="text-2xl font-bold mb-6">Tambah Jadwal Praktik</h1><form method="POST" action="{{ route('admin.schedules.store') }}">@csrf @include('admin.schedules._form')</form></div>
@endsection
