<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = Staff::all();
        return view("data-staff", ["staffs" => $staffs]);
    }

    public function create()
    {
        return view("data-staff.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            "nama" => "required",
            "jenis_kelamin" => "required",
            "user" => "required|unique:staff",
            "password" => "required|confirmed|min:8",
        ]);

        try {
            $staff = new Staff();
            $staff->nama = $request->nama;
            $staff->jenis_kelamin = $request->jenis_kelamin;
            $staff->user = $request->user;
            $staff->password = Hash::make($request->password);
            $staff->save();
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with(
                    "error",
                    "Terjadi kesalahan. Staff tidak berhasil ditambahkan. $e"
                )
                ->withInput();
        }

        return redirect("/data-staff")->with(
            "success",
            "Staff berhasil ditambahkan."
        );
    }

    public function edit($id)
    {
        $staff = Staff::findOrFail($id);
        return view("data-staff.edit", compact("staff"));
    }

    public function update(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);

        $request->validate([
            "nama" => "required",
            "jenis_kelamin" => "required",
            "user" => "required|unique:staff,user,".$id,
            "password" => "nullable|confirmed|min:8",
        ]);

        $staff->nama = $request->nama;
        $staff->jenis_kelamin = $request->jenis_kelamin;
        $staff->user = $request->user;
        if ($request->password) {
            $staff->password = Hash::make($request->password);
        }
        $staff->save();

        return redirect("/data-staff")->with(
            "success",
            "Data staff berhasil diperbarui."
        );
    }

    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);

        $staff->delete();
        return redirect("/data-staff")->with(
            "success",
            "Data staff berhasil dihapus."
        );
    }
}
