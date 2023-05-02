<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Pembeli;
use App\Models\Barang;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualans = Penjualan::all();
        return view("data-penjualan", ["penjualans" => $penjualans]);
    }

    public function create()
    {
        $pembelis = Pembeli::all();
        $barangs = Barang::all();
        return view("data-penjualan.create", compact('pembelis', 'barangs'));
    }

    public function store(Request $request)
{
    $request->validate([
        "pembeli_id" => "required|exists:pembeli,id",
        "barang_id" => "required|exists:barang,id",
        "jumlah_barang" => "required|integer|min:1",
    ]);

    $barang = Barang::find($request->barang_id);

    if ($barang->stock_barang < $request->jumlah_barang) {
        return redirect()
            ->back()
            ->with("error", "Stock barang tidak mencukupi.")
            ->withInput();
    }

    $total_harga = $barang->harga_jual * $request->jumlah_barang;
    $harga_barang = $barang->harga_jual;

    try {
        Penjualan::create([
            "pembeli_id" => $request->pembeli_id,
            "barang_id" => $request->barang_id,
            "jumlah_barang" => $request->jumlah_barang,
            "total_harga" => $total_harga,
            "harga_barang" => $harga_barang, // tambahkan harga_barang
        ]);

        $barang->stock_barang -= $request->jumlah_barang;
        $barang->save();
    } catch (\Exception $e) {
        return redirect()
            ->back()
            ->with(
                "error",
                "Terjadi kesalahan: " . $e->getMessage() . ". Penjualan tidak berhasil ditambahkan."
            )
            ->withInput();
    }

    return redirect("/data-penjualan")->with(
        "success",
        "Penjualan berhasil ditambahkan."
    );
}


    public function edit($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $pembelis = Pembeli::all();
        $barangs = Barang::all();
        return view('data-penjualan.edit', compact('penjualan', 'pembelis', 'barangs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pembeli_id' => 'required',
            'barang_id' => 'required',
            'jumlah_barang' => 'required'
        ]);

        $penjualan = Penjualan::findOrFail($id);
        $penjualan->pembeli_id = $request->pembeli_id;
        $penjualan->barang_id = $request->barang_id;
        $penjualan->jumlah_barang = $request->jumlah_barang;
        $penjualan->total_harga = Barang::find($request->barang_id)->harga * $request->jumlah_barang;
        $penjualan->save();

        return redirect()->route('data-penjualan.index')->with('success', 'Data penjualan berhasil diperbarui');
    }

}
