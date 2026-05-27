@extends('layouts.app')
@section('title', 'Edit Dokter')
@section('content')
<div class="bg-white rounded-2xl shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Edit Dokter</h1>

    <form method="POST" action="{{ route('admin.doctors.update', $doctor) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.doctors._form')
    </form>
</div>
@endsection
