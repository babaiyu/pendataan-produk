@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <div class="container">
        <a href="/data-pembeli/create" class="btn btn-primary mb-3">Tambah Data Pembeli</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>TTL</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Foto KTP</th>
                    <th>User</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach($pembelis as $pembeli)
                <tr>
                    <td>{{ $pembeli->nama }}</td>
                    <td>{{ $pembeli->TTL }}</td>
                    <td>{{ $pembeli->jenis_kelamin }}</td>
                    <td>{{ $pembeli->alamat }}</td>
                    <td><img src="{{ asset('storage/' . $pembeli->foto_ktp) }}" width="100" alt="{{ $pembeli->nama }}"></td>
                    <td>{{ $pembeli->user }}</td>
                    <td>
                        <a href="/data-pembeli/{{ $pembeli->id }}/edit" class="btn btn-warning">Edit</a>
                        <form action="/pembeli/{{ $pembeli->id }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
