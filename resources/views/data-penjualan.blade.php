@extends('layouts.app')

@section('content')
   
    <div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
        <a href="/data-penjualan/create" class="btn btn-primary mb-3">Tambah Data Penjualan</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Pembeli</th>
                    <th>Barang</th>
                    <th>Harga Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach($penjualans as $penjualan)
                <tr>
                    <td>{{ $penjualan->pembeli->nama }}</td>
                    <td>{{ $penjualan->barang->nama_barang }}</td>
                    <td>Rp {{ number_format($penjualan->barang->harga_jual, 0, ',', '.') }}</td>
                    <td>{{ $penjualan->jumlah_barang }}</td>
                    <td>Rp {{ number_format($penjualan->barang->harga_jual * $penjualan->jumlah_barang, 0, ',', '.') }}</td>
                    <td>
                        <a href="/data-penjualan/{{ $penjualan->id }}/edit" class="btn btn-warning">Edit</a>
                        <form action="/data-penjualan/{{ $penjualan->id }}" method="POST" class="d-inline">
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
