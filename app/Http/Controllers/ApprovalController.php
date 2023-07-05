<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ApprovalController extends Controller
{
    public function index(Request $request)
    {
        $query = Approval::query();
        $query->select('pengajuan_izin.*', 'departemen.nama_dep', 'karyawan.nama_lengkap');
        if (!empty($request->tgl_selesai) || !empty($request->tgl_selesai)) {
            $query->whereBetween('tgl_izin', [$request->tgl_mulai, $request->tgl_selesai]);
        }
        if (!empty($request->key)) {
            $query->where('nama_lengkap', 'like', '%' . $request->key . '%');
        }
        if (!empty($request->dep != null)) {
            $query->where('karyawan.kode_dep', $request->dep);
        }
        $query->join('karyawan', 'karyawan.nik', '=', 'pengajuan_izin.nik');
        $query->join('departemen', 'karyawan.kode_dep', '=', 'departemen.kode_dep');
        $query->orderBy('tgl_izin');
        $izin = $query->paginate('5');
        $dep = DB::table('departemen')->get();
        return view('admin.approval', compact('izin', 'dep'));
    }

    public function edit(Request $request)
    {
        $id =  $request->id;
        return view('admin.edit-approval', compact('id'));
    }

    public function update(Request $request)
    {
        $update = DB::table('pengajuan_izin')->where('id', $request->id)->update([
            'status' => $request->status
        ]);

        if ($update) {
            return Redirect()->back()->with('success', 'Data Berhasil diupdate');
        } else {
            return Redirect()->back()->with('success', 'Data Gagal diupdate');
        }
    }

    public function destroy(Request $request, $id)
    {
        $hapus = DB::table('pengajuan_izin')->where('id', $id)->update([
            'status' => '0'
        ]);

        if ($hapus) {
            return Redirect()->back()->with('success', 'Data Berhasil diupdate');
        } else {
            return Redirect()->back()->with('success', 'Data Gagal diupdate');
        }
    }
}
