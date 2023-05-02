@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Edit Data Penjualan</h1>
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
    <form action="{{ route('data-penjualan.update', $penjualan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="pembeli_id">Pembeli</label>
            <select class="form-control" id="pembeli_id" name="pembeli_id" required>
                <option value="{{ $penjualan->pembeli_id }}">{{ $penjualan->pembeli->nama }}</option>
                @foreach ($pembelis as $pembeli)
                    <option value="{{ $pembeli->id }}">{{ $pembeli->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="barang_id">Barang</label>
            <select class="form-control" id="barang_id" name="barang_id" required>
                <option value="{{ $penjualan->barang_id }}">{{ $penjualan->barang->nama_barang }}</option>
                @foreach ($barangs as $barang)
                    <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label for="jumlah_barang">Jumlah_barang</label>
            <input type="number" name="jumlah_barang" id="jumlah_barang" class="form-control" value="{{ $penjualan->jumlah }}" required>
        </div>

        <div class="form-group">
            <label for="total_harga">Total Harga</label>
            <input type="number" name="total_harga" id="total_harga" class="form-control" value="{{ $penjualan->barang->harga_jual * $penjualan->jumlah_barang }}" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
