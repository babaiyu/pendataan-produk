<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return view('data-barang', ['barangs' => $barangs]);
    }

    public function create()
    {
        return view('data-barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'deskripsi' => 'required',
            'jenis_barang' => 'required',
            'stock_barang' => 'required|integer',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'gambar_barang' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $gambar = null;
        if ($request->hasFile('gambar_barang')) {
            $gambar = $request->file('gambar_barang')->store('public/gambar_barang');
        }

        try {
            Barang::create([
                'nama_barang' => $request->nama_barang,
                'deskripsi' => $request->deskripsi,
                'jenis_barang' => $request->jenis_barang,
                'stock_barang' => $request->stock_barang,
                'harga_beli' => $request->harga_beli,
                'harga_jual' => $request->harga_jual,
                'gambar_barang' => $gambar,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Barang tidak berhasil ditambahkan.')->withInput();
        }
    
        return redirect('/data-barang')->with('success', 'Barang berhasil ditambahkan.');

    }

    public function show(Barang $barang)
    {
        return view('barang.show', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required',
            'deskripsi' => 'required',
            'jenis_barang' => 'required',
            'stock_barang' => 'required|integer',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'gambar_barang' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $gambar = $barang->gambar_barang;
        if ($request->hasFile('gambar_barang')) {
            if ($gambar) {
                Storage::delete($gambar);
            }
            $gambar = $request->file('gambar_barang')->store('public/gambar_barang');
        }

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'deskripsi' => $request->deskripsi,
            'jenis_barang' => $request->jenis_barang,
            'stock_barang' => $request->stock_barang,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'gambar_barang' => $gambar,
        ]);

        return redirect('/barang')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        if ($barang->gambar_barang) {
            Storage::delete($barang->gambar_barang);
        }

        $barang->delete();
        return redirect('/barang')->with('success', 'Barang berhasil dihapus.');
    }
}
