<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class PresensiController extends Controller
{
    public function create()
    {
        $lokasi = DB::table('lokasi_kantor')->where('id', 1)->first();
        $nik = Auth::guard('karyawan')->user()->nik;
        $hari_ini = date('Y-m-d');
        $cek = DB::table('presensi')->where('nik', $nik)->where('tgl_presensi', $hari_ini)->count();
        return view('presensi.create', compact('cek', 'lokasi'));
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
        $pos = DB::table('lokasi_kantor')->where('id', 1)->first();
        if ($radius > $pos->radius) {
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

    public function updateProfile()
    {
        return view('presensi.update-profile');
    }

    public function prosesupdateprofile(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $nama_lengkap = $request->nama_lengkap;
        $no_hp = $request->no_hp;
        $password = $request->password;
        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();

        $data = [
            'nama_lengkap' => $nama_lengkap,
            'no_hp' => $no_hp,
            'password' => empty($password) ? $karyawan->password : Hash::make($password),
            'foto' => $request->hasFile('foto') ? $nik . '.' . $request->file('foto')->getClientOriginalExtension() : $karyawan->foto
        ];

        $update = DB::table('karyawan')->where('nik', $nik)->update($data);
        if ($update) {
            if ($request->hasFile('foto')) {
                //bug
                $path = '/public/uploads/karyawan/' . $karyawan->foto;
                if (Storage::exists($path)) {
                    Storage::delete($path);
                }

                $path2 = '/public/uploads/karyawan/';
                $request->file('foto')->storeAs($path2, $nik . '.' . $request->file('foto')->getClientOriginalExtension());
            }
            return Redirect::back()->with('success', 'Data profile berhasil diupdate');
        } else {
            return Redirect::back()->with('danger', 'Data profile gagal diupdate');
        }
    }

    public function history()
    {
        $bulans = ["", 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'July', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        // dd($bulans);
        return view('presensi.history', compact('bulans'));
    }

    public function proseshistory(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $nik = Auth::guard('karyawan')->user()->nik;
        $historynya = DB::table('presensi')
            ->where('nik', $nik)
            ->whereMonth('tgl_presensi', '=', $bulan)
            ->whereYear('tgl_presensi', '=', $tahun)
            ->orderBy('tgl_presensi')
            ->get();

        return view('presensi.history-result', compact('historynya'));
    }

    public function izin()
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $listizin = DB::table('pengajuan_izin')->where('nik', $nik)->orderBy('tgl_izin')->get();
        return view('presensi.izin', compact('listizin'));
    }

    public function buatizin()
    {
        return view('presensi.buatizin');
    }

    public function prosesizin(Request $request)
    {
        $tgl = $request->tgl;
        $izin = $request->izin;
        $ket = $request->ket;
        $nik = Auth::guard('karyawan')->user()->nik;
        $cek = DB::table('pengajuan_izin')->where('nik', $nik)->where('tgl_izin', $tgl)->count();

        $data = [
            'nik' => $nik,
            'tgl_izin' => $tgl,
            'izin' => $izin,
            'keterangan' => $ket,
            'status' => '0'
        ];

        if ($cek > 0) {
            return Redirect::back()->with('danger', 'Anda sudah buat izin pada tanggal tersebut');
        } else {
            DB::table('pengajuan_izin')->insert($data);
            return redirect()->to('/presensi/izin')->with('success', 'Buat Izin berhasil');
        }
    }

    public function monitoring()
    {
        return view('admin.monitor-presensi');
    }

    public function getMonitor(Request $request)
    {
        $tgl = $request->tgl;

        $results = DB::table('presensi')
            ->select('presensi.*', 'departemen.nama_dep', 'karyawan.nama_lengkap')
            ->join('karyawan', 'presensi.nik', '=', 'karyawan.nik')
            ->join('departemen', 'karyawan.kode_dep', '=', 'departemen.kode_dep')
            ->where('tgl_presensi', $tgl)
            ->orderBy('karyawan.nama_lengkap')
            ->paginate(5);

        return view('admin.get-monitoring', compact('results'));
    }

    public function showmap(Request $request)
    {
        $id = $request->id;
        $lokasi = DB::table('lokasi_kantor')->where('id', 1)->first();
        $hasil = DB::table('presensi')->where('id', $id)->first();
        return view('admin.showmap', compact('hasil', 'lokasi'));
    }

    public function rekap()
    {

        $bulans = ["", 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'July', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        return view('admin.rekap-presensi', compact('bulans'));
    }

    public function getRekap(Request $request)
    {
        $month = $request->bulan;
        $year = $request->tahun;
        $calday = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $results = DB::table('presensi')
            ->select('presensi.nik', 'nama_lengkap')
            ->selectRaw("MAX(IF(DAY(tgl_presensi)=1, CONCAT(jam_in,'-',IFNULL(jam_out,'00:00:00')),'')) as tgl_1")
            ->selectRaw("MAX(IF(DAY(tgl_presensi)=2, CONCAT(jam_in,'-',IFNULL(jam_out,'00:00:00')),'')) as tgl_2")
            ->selectRaw("MAX(IF(DAY(tgl_presensi)=3, CONCAT(jam_in,'-',IFNULL(jam_out,'00:00:00')),'')) as tgl_3")
            ->selectRaw("MAX(IF(DAY(tgl_presensi)=4, CONCAT(jam_in,'-',IFNULL(jam_out,'00:00:00')),'')) as tgl_4")
            ->selectRaw("MAX(IF(DAY(tgl_presensi)=5, CONCAT(jam_in,'-',IFNULL(jam_out,'00:00:00')),'')) as tgl_5")
            ->selectRaw("MAX(IF(DAY(tgl_presensi)=6, CONCAT(jam_in,'-',IFNULL(jam_out,'00:00:00')),'')) as tgl_6")
            ->selectRaw("MAX(IF(DAY(tgl_presensi)=7, CONCAT(jam_in,'-',IFNULL(jam_out,'00:00:00')),'')) as tgl_7")
            ->selectRaw("MAX(IF(DAY(tgl_presensi)=8, CONCAT(jam_in,'-',IFNULL(jam_out,'00:00:00')),'')) as tgl_8")
            ->selectRaw("MAX(IF(DAY(tgl_presensi)=9, CONCAT(jam_in,'-',IFNULL(jam_out,'00:00:00')),'')) as tgl_9")
            ->selectRaw("MAX(IF(DAY(tgl_presensi)=10, CONCAT(jam_in,'-',IFNULL(jam_out,'00:00:00')),'')) as tgl_10")
            ->selectRaw("MAX(IF(DAY(tgl_presensi)=11, CONCAT(jam_in,'-',IFNULL(jam_out,'00:00:00')),'')) as tgl_11")
            ->selectRaw("MAX(IF(DAY(tgl_presensi)=12, CONCAT(jam_in,'-',IFNULL(jam_out,'00:00:00')),'')) as tgl_12")
            ->selectRaw("MAX(IF(DAY(tgl_presensi)=13, CONCAT(jam_in,'-',IFNULL(jam_out,'00:00:00')),'')) as tgl_13")
            ->selectRaw("MAX(IF(DAY(tgl_presensi)=14, CONCAT(jam_in,'-',IFNULL(jam_out,'00:00:00')),'')) as tgl_14")
            ->selectRaw("MAX(IF(DAY(tgl_presensi)=15, CONCAT(jam_in,'-',IFNULL(jam_out,'00:00:00')),'')) as tgl_15")
            ->selectRaw("MAX(IF(DAY(tgl_presensi)=16, CONCAT(jam_in,'-',IFNULL(jam_out,'00:00:00')),'')) as tgl_16")
            ->selectRaw("MAX(IF(DAY(tgl_presensi)=17, CONCAT(jam_in,'-',IFNULL(jam_out,'00:00:00')),'')) as tgl_17")
            ->selectRaw("MAX(IF(DAY(tgl_presensi)=18, CONCAT(jam_in,'-',IFNULL(jam_out,'00:00:00')),'')) as tgl_18")
            ->selectRaw("MAX(IF(DAY(tgl_presensi)=19, CONCAT(jam_in,'-',IFNULL(jam_out,'00:00:00')),'')) as tgl_19")
            ->selectRaw("MAX(IF(DAY(tgl_presensi)=20, CONCAT(jam_in,'-',IFNULL(jam_out,'00:00:00')),'')) as tgl_20")
            ->selectRaw("MAX(IF(DAY(tgl_presensi)=21, CONCAT(jam_in,'-',IFNULL(jam_out,'00:00:00')),'')) as tgl_21")
            ->selectRaw("MAX(IF(DAY(tgl_presensi)=22, CONCAT(jam_in,'-',IFNULL(jam_out,'00:00:00')),'')) as tgl_22")
            ->selectRaw("MAX(IF(DAY(tgl_presensi)=23, CONCAT(jam_in,'-',IFNULL(jam_out,'00:00:00')),'')) as tgl_23")
            ->selectRaw("MAX(IF(DAY(tgl_presensi)=24, CONCAT(jam_in,'-',IFNULL(jam_out,'00:00:00')),'')) as tgl_24")
            ->selectRaw("MAX(IF(DAY(tgl_presensi)=25, CONCAT(jam_in,'-',IFNULL(jam_out,'00:00:00')),'')) as tgl_25")
            ->selectRaw("MAX(IF(DAY(tgl_presensi)=26, CONCAT(jam_in,'-',IFNULL(jam_out,'00:00:00')),'')) as tgl_26")
            ->selectRaw("MAX(IF(DAY(tgl_presensi)=27, CONCAT(jam_in,'-',IFNULL(jam_out,'00:00:00')),'')) as tgl_27")
            ->selectRaw("MAX(IF(DAY(tgl_presensi)=28, CONCAT(jam_in,'-',IFNULL(jam_out,'00:00:00')),'')) as tgl_28")
            ->selectRaw("MAX(IF(DAY(tgl_presensi)=29, CONCAT(jam_in,'-',IFNULL(jam_out,'00:00:00')),'')) as tgl_29")
            ->selectRaw("MAX(IF(DAY(tgl_presensi)=30, CONCAT(jam_in,'-',IFNULL(jam_out,'00:00:00')),'')) as tgl_30")
            ->selectRaw("MAX(IF(DAY(tgl_presensi)=31, CONCAT(jam_in,'-',IFNULL(jam_out,'00:00:00')),'')) as tgl_31")
            ->whereMonth('tgl_presensi', '=', $month)
            ->whereYear('tgl_presensi', '=', $year)
            ->join('karyawan', 'presensi.nik', '=', 'karyawan.nik')
            ->join('departemen', 'karyawan.kode_dep', '=', 'departemen.kode_dep')
            ->groupBy('presensi.nik', 'karyawan.nama_lengkap')
            ->orderBy('karyawan.nama_lengkap')
            ->paginate(5);
        // dd($results);
        return view('admin.get-rekap', compact('results', 'calday'));
    }
}
