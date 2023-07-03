<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class DepartemenController extends Controller
{
    public function index(Request $request)
    {
        $query = Departemen::query();
        $query->select('departemen.*');
        if (!empty($request->key)) {
            $query->where('nama_dep', 'like', '%' . $request->key . '%');
        }
        $query->orderBy('kode_dep');
        $departemen = $query->paginate('5');
        return view('admin.departemen', compact('departemen'));
    }

    public function store(Request $request)
    {
        $dep = $request->dep;
        $nama = $request->nama;

        try {
            $data = [
                'kode_dep' => $dep,
                'nama_dep' => $nama
            ];

            $simpan = DB::table('departemen')->insert($data);
            if ($simpan) {
                return Redirect::back()->with('success', 'Data Berhasil disimpan');
            }
        } catch (\Throwable $th) {
            // dd($th);
            return Redirect::back()->with('danger', 'Data Gagal disimpan!');
            //throw $th;
        }
    }

    public function cek_dep(Request $request)
    {
        $cek = DB::table('departemen')->where('kode_dep', $request->dep)->count();
        if ($cek > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function edit(Request $request)
    {
        $dep = $request->dep;
        $departemen = DB::table('departemen')->where('kode_dep', $dep)->first();
        return view('admin.departemenedit', compact('departemen'));
    }

    public function update(Request $request)
    {
        $dep = $request->dep;
        $nama = $request->nama;

        try {
            $data = [
                'nama_dep' => $nama,
            ];

            $simpan = DB::table('departemen')->where('kode_dep', $dep)->update($data);
            if ($simpan) {
                return Redirect::back()->with('success', 'Data Berhasil diupdate');
            }
        } catch (\Throwable $th) {
            // dd($th);
            return Redirect::back()->with('danger', 'Data Gagal diupdate!');
            //throw $th;
        }
    }

    public function delete($dep)
    {
        $hapus = DB::table('departemen')->where('kode_dep', $dep)->delete();
        if ($hapus) {
            return Redirect::back()->with('success', 'Data Berhasil dihapus');
        } else {
            return Redirect::back()->with('danger', 'Data Gagal dihapus!');
        }
    }
}
