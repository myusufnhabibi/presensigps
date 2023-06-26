<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboradController extends Controller
{
    public function index()
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $hari_ini = date('Y-m-d');
        $month = date('m') * 1;
        $year = date('Y');
        $presensi = DB::table('presensi')->where('nik', $nik)->where('tgl_presensi', $hari_ini)->first();
        $presensi_bln_ini = DB::table('presensi')->where('nik', $nik)
            ->whereMonth('tgl_presensi', '=', $month)
            ->whereYear('tgl_presensi', '=', $year)
            ->orderBy('tgl_presensi')
            ->get();

        $bulan = ["", 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'July', 'Agustus', 'September', 'Oktober', 'November', 'Desemver'];
        $bulan_ini = $bulan[$month];
        return view('dashboard.dashboard', compact('presensi', 'presensi_bln_ini', 'bulan_ini'));
    }
}
