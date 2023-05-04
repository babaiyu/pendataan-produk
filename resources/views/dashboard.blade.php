@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0"><span id="greeting"></span>, {{ Auth::user()->name }}</h1>
            <a href="/data-barang" class="btn btn-primary">Tambah Data</a>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Barang Tersedia</h5>
                        <p class="card-text display-4 text-center">{{ $totalBarang }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Penjualan</h5>
                        <p class="card-text display-4 text-center">{{ $totalPenjualan }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Revenue yang Didapat</h5>
                        <p class="card-text display-6 text-center">Rp. {{ $totalRevenue }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Semua Barang</h5>
                        <div id="chart_barang"></div>
                    </div>
                </div>
            </div>
            <div class="col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Revenue Penjualan</h5>
                        <div id="chart_penjualan"></div>
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

    {{-- For Chart --}}
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback(drawChartBarang);
        google.charts.setOnLoadCallback(drawChartPenjualan);

        function drawChartBarang() {
            let dataBarang = {{ Js::from($chart) }};
            dataBarang = dataBarang.map(item => {
                return [item?.nama_barang, item?.jumlah_barang];
            });

            let data = new google.visualization.DataTable();
            data.addColumn('string', 'Barang');
            data.addColumn('number', 'Jumlah Barang');
            data.addRows(dataBarang)

            let options = {
                'title': 'Barang yang tersedia',
                'width': 400,
                'height': 300
            };

            let chart = new google.visualization.PieChart(document.getElementById('chart_barang'));
            chart.draw(data, options);
        }

        function drawChartPenjualan() {
            let dataPenjualan = {{ Js::from($chart) }};
            dataPenjualan = dataPenjualan.map(item => {
                return [item?.nama_barang, item?.total_harga];
            });

            let data = new google.visualization.arrayToDataTable([
                ['Barang', 'Penjualan'],
                ...dataPenjualan,
            ]);

            let options = {
                chart: {
                    title: 'Population of Largest U.S. Cities',
                    subtitle: 'Based on most recent and previous census data'
                },
                hAxis: {
                    title: 'Total Population'
                },
                vAxis: {
                    title: 'City'
                },
                bars: 'horizontal',
                series: {
                    0: {
                        axis: '2010'
                    },
                    1: {
                        axis: '2000'
                    }
                },
                axes: {
                    x: {
                        2010: {
                            label: '2010 Population (in millions)',
                            side: 'top'
                        },
                        2000: {
                            label: '2000 Population'
                        }
                    }
                }
            };

            let chart = new google.charts.Bar(document.getElementById('chart_penjualan'));
            chart.draw(data);
        }
    </script>
@endsection
