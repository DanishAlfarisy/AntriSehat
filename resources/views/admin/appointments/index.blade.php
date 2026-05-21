@extends('layouts.app')
@section('title', 'Kelola Appointment')
@section('content')
<h1 class="text-3xl font-bold mb-6">Kelola Appointment Pasien</h1>
@include('admin.appointments._table', ['appointments' => $appointments])
@endsection
