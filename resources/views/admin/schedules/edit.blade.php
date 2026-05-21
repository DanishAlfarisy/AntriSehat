@extends('layouts.app')
@section('title', 'Edit Jadwal')
@section('content')
<div class="bg-white rounded-2xl shadow p-6"><h1 class="text-2xl font-bold mb-6">Edit Jadwal Praktik</h1><form method="POST" action="{{ route('admin.schedules.update',$schedule) }}">@csrf @method('PUT') @include('admin.schedules._form')</form></div>
@endsection
