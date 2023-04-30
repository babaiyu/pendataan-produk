@extends('layouts.app')

@section('content')
<div class="container">
<h2>Tambah Barang</h2>
<form action="{{ route('data-barang.store') }}" method="POST" enctype="multipart/form-data">



@csrf
<div class="form-group">
<label for="nama_barang">Nama Barang</label>
<input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
</div>
<div class="form-group">
<label for="deskripsi">Deskripsi</label>
<textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
</div>
<div class="form-group">
<label for="jenis_barang">Jenis Barang</label>
<select class="form-control" id="jenis_barang" name="jenis_barang" required>
<option value="">Pilih jenis barang</option>
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
<input type="number" class="form-control" id="stock_barang" name="stock_barang" min="1" required>
</div>
<div class="form-group">
<label for="harga_beli">Harga Beli</label>
<input type="number" class="form-control" id="harga_beli" name="harga_beli" min="1" required>
</div>
<div class="form-group">
<label for="harga_jual">Harga Jual</label>
<input type="number" class="form-control" id="harga_jual" name="harga_jual" min="1" required>
</div>
<div class="form-group">
<label for="gambar_barang">Gambar Barang</label>
<input type="file" class="form-control-file" id="gambar_barang" name="gambar_barang" required>
</div>
<button type="submit" class="btn btn-primary">Tambah Barang</button>
</form>
</div>
@endsection