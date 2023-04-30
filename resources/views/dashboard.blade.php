@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0"><span id="greeting"></span>,  {{ Auth::user()->name }}</h1>
            <a href="#" class="btn btn-primary">Tambah Data</a>
        </div>
        
        <div class="row">
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Barang Tersedia</h5>
                        <p class="card-text display-4 text-center">500</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Penjualan Hari Ini</h5>
                        <p class="card-text display-4 text-center">15</p>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <script>
        // Mendapatkan waktu saat ini pada browser pengguna
        const time = new Date().getHours();

        // Menyesuaikan pesan sapaan berdasarkan waktu
        let greeting = "";
        if (time < 12) {
            greeting = "Selamat pagi";
        } else if (time < 18) {
            greeting = "Selamat siang";
        } else {
            greeting = "Selamat sore";
        }

        // Menampilkan pesan sapaan pada halaman
        document.getElementById("greeting").innerText = greeting;
    </script>
@endsection
