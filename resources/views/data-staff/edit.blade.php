@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Edit Data Staff</h2>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('data-staff.update', $staff->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">

    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" value="{{ $staff->nama }}" required>
    </div>
    <div class="form-group">
        <label for="jenis_kelamin">Jenis Kelamin</label>
        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
            <option value="">Pilih jenis kelamin</option>
            <option value="Laki-laki" {{ $staff->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
            <option value="Perempuan" {{ $staff->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>
    </div>
    <div class="form-group">
        <label for="user">User</label>
        <input type="text" class="form-control" id="user" name="user" value="{{ $staff->user }}" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="form-group">
        <label for="password_confirmation">Retype Password</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
    </div>
    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
</form>
</div>
@endsection