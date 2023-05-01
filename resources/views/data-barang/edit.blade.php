@extends('layouts.app')

@section('content')

<div class="container">
        <h1>Edit Barang</h1>
        <!-- <p>{{  $barang }}</p> -->
        <form action="{{ route('data-barang.update', collect(explode('/', url(Request::path())))->nth(-2, 0)[2]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="{{ $barang->nama_barang }}" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" required>{{ $barang->deskripsi }}</textarea>
            </div>
           <div class="form-group">
<label for="jenis_barang">Jenis Barang</label>
<select class="form-control" id="jenis_barang" name="jenis_barang" required>
<option value="{{ $barang->jenis_barang }}">{{ $barang->jenis_barang }}</option>
<option value="Elektronik">Elektronik</option>
<option value="Pakaian">Pakaian</option>
<option value="Makanan">Makanan</option>
<option value="Minuman">Minuman</option>
<option value="Alat Tulis">Alat Tulis</option>
<option value="Kosmetik">Kosmetik</option>
</select>
</div>
            <div class="form-group">
                <label for="stock_barang">Stock Barang</label>
                <input type="number" name="stock_barang" id="stock_barang" class="form-control" value="{{ $barang->stock_barang }}" required>
            </div>
            <div class="form-group">
                <label for="harga_beli">Harga Beli</label>
                <input type="number" name="harga_beli" id="harga_beli" class="form-control" value="{{ $barang->harga_beli }}" required>
            </div>
            <div class="form-group">
                <label for="harga_jual">Harga Jual</label>
                <input type="number" name="harga_jual" id="harga_jual" class="form-control" value="{{ $barang->harga_jual }}" required>
            </div>
            <div class="form-group">
                <label for="gambar_barang">Gambar Barang</label>
                <input type="file" name="gambar_barang" id="gambar_barang" class="form-control-file">
            </div>
            <div class="form-group">
                <img src="{{ asset('storage/' . $barang->gambar_barang) }}" width="100" alt="{{ $barang->nama_barang }}">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
