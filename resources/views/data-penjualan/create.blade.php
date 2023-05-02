@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Tambah Data Penjualan</h2>
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

<form action="{{ route('data-penjualan.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">

    @csrf
    <div class="form-group">
        <label for="pembeli_id">Pembeli</label>
        <select class="form-control" id="pembeli_id" name="pembeli_id" required>
            <option value="">Pilih Pembeli</option>
            @foreach($pembelis as $pembeli)
                <option value="{{ $pembeli->id }}">{{ $pembeli->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="barang_id">Barang</label>
        <select class="form-control" id="barang_id" name="barang_id" required>
            <option value="">Pilih Barang</option>
            @foreach($barangs as $barang)
                <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
    <label for="jumlah_barang">Jumlah Barang</label>
    <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" min="1" max="{{ $barang->stock_barang }}" required>
    @error('jumlah_barang')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
    <button type="submit" class="btn btn-primary">Tambah Penjualan</button>
</form></div>
@endsection