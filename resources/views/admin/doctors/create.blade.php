@extends('layouts.app')
@section('title', 'Tambah Dokter')
@section('content')
<div class="bg-white rounded-2xl shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Tambah Dokter</h1>

    <form method="POST" action="{{ route('admin.doctors.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.doctors._form')
    </form>
</div>
@endsection
