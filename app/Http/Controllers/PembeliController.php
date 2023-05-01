<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PembeliController extends Controller
{
    public function index()
    {
        $pembelis = Pembeli::all();
        return view("data-pembeli", ["pembelis" => $pembelis]);
    }

    public function create()
    {
        return view("data-pembeli.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            "nama" => "required",
            "tanggal_lahir" => "required|date",
            "jenis_kelamin" => "required|in:Laki-laki,Perempuan",
            "alamat" => "required",
            "foto_ktp" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "user" => "required",
            "password" => "required|confirmed",
        ]);

        // dd($request->all());

        $foto_ktp = null;
        if ($request->hasFile("foto_ktp")) {
            $foto_ktp = $request
                ->file("foto_ktp")
                ->store("public/foto_ktp");
            $foto_ktp = str_replace("public/", "", $foto_ktp);
        }

        try {
            $pembeli = new Pembeli();
            $pembeli->nama = $request->input('nama');
            $pembeli->tanggal_lahir = date('Y-m-d', strtotime($request->input('tanggal_lahir')));
            $pembeli->jenis_kelamin = $request->input('jenis_kelamin');
            $pembeli->alamat = $request->input('alamat');
            $pembeli->foto_ktp = $foto_ktp;
            $pembeli->user = $request->input('user');
            $pembeli->password = bcrypt($request->input('password'));
            $pembeli->save();
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with(
                    "error",
                    "Terjadi kesalahan. Pembeli tidak berhasil ditambahkan. $e"
                )
                ->withInput();
        }
        

        return redirect("/data-pembeli")->with(
            "success",
            "Pembeli berhasil ditambahkan."
        );
    }

    public function edit($id)
    {
        $pembeli = Pembeli::findOrFail($id);
        return view("data-pembeli.edit", compact("pembeli"));
    }

    public function update(Request $request, $id)
    {
        $pembeli = Pembeli::findOrFail($id);

        $request->validate([
            "nama" => "required",
            "tanggal_lahir" => "required|date",
            "jenis_kelamin" => "required|in:Laki-laki,Perempuan",
            "alamat" => "required",
            "foto_ktp" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "user" => "required",
            "password" => "required|confirmed",
        ]);

        $foto_ktp = $pembeli->foto_ktp;
        if ($request->hasFile("foto_ktp")) {
            $foto_ktp = $request
                ->file("foto_ktp")
                ->store("public/foto_ktp");
            $foto_ktp = str_replace("public/", "", $foto_ktp);
            if ($pembeli->foto_ktp) {
                Storage::delete($pembeli->foto_ktp);
            }
            }
            $pembeli->nama = $request->nama;
            $pembeli->tanggal_lahir = $request->tanggal_lahir;
            $pembeli->jenis_kelamin = $request->jenis_kelamin;
            $pembeli->alamat = $request->alamat;
            $pembeli->foto_ktp = $foto_ktp;
            $pembeli->user = $request->user;
            $pembeli->password = bcrypt($request->password);
            $pembeli->save();
        
            return redirect("/data-pembeli")->with(
                "success",
                "Data pembeli berhasil diperbarui."
            );
        }
        
        public function destroy(Pembeli $pembeli)
        {
            if ($pembeli->foto_ktp) {
                Storage::delete($pembeli->foto_ktp);
            }
        
            $pembeli->delete();
            return redirect("/data-pembeli")->with(
                "success",
                "Data pembeli berhasil dihapus."
            );
        }
    }        