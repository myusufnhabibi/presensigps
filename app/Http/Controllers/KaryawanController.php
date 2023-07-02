<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $query = Karyawan::query();
        $query->select('karyawan.*', 'departemen.nama_dep');
        if (!empty($request->key)) {
            $query->where('nama_lengkap', 'like', '%' . $request->key . '%');
        }
        if (!empty($request->dep != null)) {
            $query->where('karyawan.kode_dep', $request->dep);
        }
        $query->join('departemen', 'karyawan.kode_dep', '=', 'departemen.kode_dep');
        $query->orderBy('nama_lengkap');
        $karyawan = $query->paginate('5');

        // dd($query);
        $dep = DB::table('departemen')->get();
        return view('admin.karyawan', compact('karyawan', 'dep'));
    }

    public function store(Request $request)
    {
        $nik = $request->nik;
        $nama = $request->nama;
        $kode_dep = $request->kode_dep;
        $jabatan = $request->jabatan;
        $password = Hash::make($request->password);
        $nohp = $request->nohp;

        try {
            $data = [
                'nik' => $nik,
                'nama_lengkap' => $nama,
                'kode_dep' => $kode_dep,
                'jabatan' => $jabatan,
                'no_hp' => $nohp,
                'password' => $password,
                'foto' => $request->hasFile('foto') ? $nik . '.' . $request->file('foto')->getClientOriginalExtension() : 'default.jpg'
            ];

            $simpan = DB::table('karyawan')->insert($data);
            if ($simpan) {
                if ($request->hasFile('foto')) {
                    $path = '/public/uploads/karyawan/';
                    $request->file('foto')->storeAs($path, $nik . '.' . $request->file('foto')->getClientOriginalExtension());
                }
                return Redirect::back()->with('success', 'Data Berhasil disimpan');
            }
        } catch (\Throwable $th) {
            // dd($th);
            return Redirect::back()->with('danger', 'Data Gagal disimpan!');
            //throw $th;
        }
    }

    public function cek_nik(Request $request)
    {
        $cek = DB::table('karyawan')->where('nik', $request->nik)->count();
        if ($cek > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function edit(Request $request)
    {
        $nik = $request->nik;
        $dep = DB::table('departemen')->get();
        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();
        return view('admin.karyawanedit', compact('dep', 'karyawan'));
    }

    public function update(Request $request)
    {
        $nik = $request->nik;
        $nama = $request->nama;
        $kode_dep = $request->kode_dep;
        $jabatan = $request->jabatan;
        $password = Hash::make($request->password);
        $nohp = $request->nohp;
        $foto = $nik . '.' . $request->file('foto')->getClientOriginalExtension();

        // $path2 = '/public/uploads/karyawan/' . $request->old_foto;
        // dd(Storage::exists($path2));

        try {
            $data = [
                'nama_lengkap' => $nama,
                'kode_dep' => $kode_dep,
                'jabatan' => $jabatan,
                'no_hp' => $nohp,
                'password' => !empty($request->password) ? $password : $request->pw_lama,
                'foto' => $request->hasFile('foto') ? $foto : $request->old_foto
            ];

            $simpan = DB::table('karyawan')->where('nik', $nik)->update($data);
            if ($simpan) {
                if ($request->hasFile('foto')) {
                    $path = '/public/uploads/karyawan/';
                    $path2 = '/public/uploads/karyawan/' . $request->old_foto;
                    if (Storage::exists($path2)) {
                        Storage::delete($path2);
                    }
                    $request->file('foto')->storeAs($path, $foto);
                }
                return Redirect::back()->with('success', 'Data Berhasil diupdate');
            }
        } catch (\Throwable $th) {
            // dd($th);
            return Redirect::back()->with('danger', 'Data Gagal diupdate!');
            //throw $th;
        }
    }

    public function delete($nik)
    {
        $hapus = DB::table('karyawan')->where('nik', $nik)->delete();
        $foto = DB::table('karyawan')->where('nik', $nik)->get();
        if ($hapus) {
            $path2 = '/public/uploads/karyawan/' . $foto->foto;
            if (Storage::exists($path2)) {
                Storage::delete($path2);
            }
            return Redirect::back()->with('success', 'Data Berhasil dihapus');
        } else {
            return Redirect::back()->with('danger', 'Data Gagal dihapus!');
        }
    }
}
