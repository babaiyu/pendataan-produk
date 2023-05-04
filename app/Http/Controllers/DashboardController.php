<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function show()
    {
        // Count Barang & Penjualan
        $totalBarang = Barang::count();
        $totalPenjualan = Penjualan::count();

        $chart = DB::table('penjualan')
            ->join('barang', 'barang.id', '=', 'penjualan.barang_id')
            ->select('barang.nama_barang', 'penjualan.jumlah_barang', 'penjualan.total_harga')
            ->get();

        $totalRevenue = 0;
        foreach ($chart as $key => $value) {
            $totalRevenue += $value->total_harga;
        }

        return view(
            'dashboard',
            [
                'totalBarang' => $totalBarang,
                'totalPenjualan' => $totalPenjualan,
                'chart' => $chart,
                'totalRevenue' => $totalRevenue,
            ]
        );
    }
}
