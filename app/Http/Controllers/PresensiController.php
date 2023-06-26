<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PresensiController extends Controller
{
    public function create()
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $hari_ini = date('Y-m-d');
        $cek = DB::table('presensi')->where('nik', $nik)->where('tgl_presensi', $hari_ini)->count();
        return view('presensi.create', compact('cek'));
    }

    public function store(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_presensi = date('Y-m-d');
        $jam = date('H:i:s');
        $lokasi = $request->tkp;
        $lat_kantor = '-6.807998796939659';
        $long_kantor = '110.84244817055384';
        $lokasi_user = explode(',', $lokasi);
        $lat_user = $lokasi_user[0];
        $long_user = $lokasi_user[1];
        // dd($lat_user, $long_user);
        $image = $request->image;
        $folderPath = '/public/uploads/absensi/';
        $cek = DB::table('presensi')->where('nik', $nik)->where('tgl_presensi', $tgl_presensi)->count();
        $format_name = $cek > 0 ? $nik . "-" . $tgl_presensi . '-out' : $nik . "-" . $tgl_presensi . '-in';
        $image_part = explode(';base64', $image);
        $image_base64 = base64_decode($image_part[1]);
        $filename = $format_name . '.png';
        $file = $folderPath . $filename;
        $jarak = $this->distance($lat_kantor, $long_kantor, $lat_user, $long_user);
        $radius = round($jarak['meters']);
        if ($radius > 150) {
            echo "failed|Maaf Radius anda " . $radius . " Meter dari Kantor";
        } else {
            if ($cek > 0) {
                $data = [
                    'jam_out' => $jam,
                    'foto_out' => $filename,
                    'lok_out' => $lokasi
                ];
                $simpan = DB::table('presensi')->where('nik', $nik)->where('tgl_presensi', $tgl_presensi)->update($data);
                if ($simpan) {
                    echo "success|Hati - hati di Jalan|out";
                } else {
                    echo "failed|Absensi Gagal!|out";
                }
            } else {
                $data = [
                    'nik' => $nik,
                    'tgl_presensi' => $tgl_presensi,
                    'jam_in' => $jam,
                    'foto_in' => $filename,
                    'lok_in' => $lokasi
                ];
                $simpan = DB::table('presensi')->insert($data);
                if ($simpan) {
                    echo "success|Selamat Bekerja Kakak|in";
                } else {
                    echo "failed|Absensi Gagal!|in";
                }
            }
            Storage::put($file, $image_base64);
        }
    }

    //Menghitung Jarak
    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }
}
