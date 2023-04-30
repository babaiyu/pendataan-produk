@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <div class="container">
        <a href="/data-barang/create" class="btn btn-primary mb-3">Tambah Barang</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Deskripsi</th>
                    <th>Jenis Barang</th>
                    <th>Stock Barang</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Gambar Barang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach($barangs as $barang)
                <tr>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>{{ $barang->deskripsi }}</td>
                    <td>{{ $barang->jenis_barang }}</td>
                    <td>{{ $barang->stock_barang }}</td>
                    <td>{{ $barang->harga_beli }}</td>
                    <td>{{ $barang->harga_jual }}</td>
                    <td><img src="{{ asset('storage/' . $barang->gambar_barang) }}" width="100" alt="{{ $barang->nama_barang }}"></td>
                    <td>
                        <a href="/barang/{{ $barang->id }}/edit" class="btn btn-warning">Edit</a>
                        <form action="/barang/{{ $barang->id }}" method="POST" class="d-inline">
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