@extends('layouts.app')

@section('content')

<div class="container">
        <h1>Edit Data Pembeli</h1>
        <form action="{{ route('data-pembeli.update', $pembeli->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ $pembeli->nama }}" required>
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{ $pembeli->tanggal_lahir }}" required>
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="{{ $pembeli->jenis_kelamin }}">{{ $pembeli->jenis_kelamin }}</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" rows="3" required>{{ $pembeli->alamat }}</textarea>
            </div>
            <div class="form-group">
                <label for="foto_ktp">Foto KTP</label>
                <input type="file" name="foto_ktp" id="foto_ktp" class="form-control-file">
            </div>
            <div class="form-group">
                <label for="user">User</label>
                <input type="text" name="user" id="user" class="form-control" value="{{ $pembeli->user }}" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Retype Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection