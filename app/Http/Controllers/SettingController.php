<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SettingController extends Controller
{
    public function setLokasi()
    {
        $lokasi = DB::table('lokasi_kantor')->where('id', 1)->first();
        // dd($lokasi);
        return view('admin.set-lokasikantor', compact('lokasi'));
    }

    public function update(Request $request)
    {
        $update = DB::table('lokasi_kantor')->where('id', 1)->update([
            'lokasi' => $request->lokasi,
            'radius' => $request->radius
        ]);

        if ($update) {
            return Redirect::back()->with('success', 'Data Berhasil diupdate!');
        } else {
            return Redirect::back()->with('danger', 'Data Gagal diupdate!');
        }
    }
}
