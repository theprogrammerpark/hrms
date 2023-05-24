<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Pengajuanizin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class PresensiController extends Controller
{
    public function create()
    {
        $hariini = date("Y-m-d");
        $nik = Auth::guard('karyawan')->user()->nik;
        $kode_cabang = Auth::guard('karyawan')->user()->kode_cabang;
        $cek = DB::table('presensi')->where('tgl_presensi', $hariini)->where('nik', $nik)->count();

        // $lokasi_kantor= DB::table('konfigurasi_lokasi')->where('id',1)->first();
        $lokasi_kantor= DB::table('cabang')->where('kode_cabang',$kode_cabang)->first();

        return view('presensi.create', compact('cek', 'lokasi_kantor'));
    }

    //menghitung jarak antara dua titik koordinat
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

    public function store(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_presensi = date("Y-m-d");
        $jam =date("H:i:s");
        $filejam = date("H-i-s");

        $kode_cabang = Auth::guard('karyawan')->user()->kode_cabang;
        // $lok_kantor = DB::table('konfigurasi_lokasi')->where('id',1)->first();
        $lok_kantor = DB::table('cabang')->where('kode_cabang',$kode_cabang)->first();
        $lok = explode(",", $lok_kantor->lokasi_kantor);
        $latkantor = $lok[0];
        $longkantor = $lok[1];
        $radiuskantor = $lok_kantor->radius;

        $lokasi = $request->lokasi;
        $lokasiuser= explode(",", $lokasi);
        $latitudeuser=$lokasiuser[0];
        $longitudeuser=$lokasiuser[1];

        $jarak = $this->distance($latkantor,$longkantor,$latitudeuser,$longitudeuser);

        $radius = round($jarak["meters"]);

        $cek = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nik', $nik)->count();
        if ($cek>0) {
            $ket = "out";
        } else {
            $ket = "in";
        }

        $image = $request->image;
        // echo $image;
        // die;


        $folderPath = "public/uploads/absensi/";
        $formatName = $nik."-".$tgl_presensi."-".$ket;
        $image_parts = explode(";base64", $image);
        $image_base64 = base64_decode($image_parts[1]);
        $filename = $formatName. ".png";
        $file = $folderPath.$filename;

        $data = [
            'nik'=> $nik,
            'tgl_presensi' => $tgl_presensi,
            'jam_in' => $jam,
            'foto_in' => $filename,
            'location_in'=>$lokasi
        ];

        $hariini = date("Y-m-d");
        $nik = Auth::guard('karyawan')->user()->nik;

        //cek jarak

        if ($radius>$radiuskantor) {
            echo "error|Maaf anda berada di luar radius, anda berada ".$radius." meter dari kantor |radius";
        } else {

            if ($cek > 0) {
                $data_pulang = [
                    'jam_out' => $jam,
                    'foto_out' => $filename,
                    'location_out'=>$lokasi
                ];

                $update = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nik', $nik)->update($data_pulang);
                if ($update) {
                    Storage::put($file,$image_base64);
                    echo "success|Terimakasih, hati hati di jalan|out";
                } else {
                    echo "error|Gagal absen, hubungi tim IT|out";
                }
            } else {
                $data = [
                    'nik'=> $nik,
                    'tgl_presensi' => $tgl_presensi,
                    'jam_in' => $jam,
                    'foto_in' => $filename,
                    'location_in'=>$lokasi
                ];

                $simpan = DB::table('presensi')->insert($data);
                if ($simpan) {
                    Storage::put($file,$image_base64);
                    echo "success|Terimakasih, Selamat bekerja|in";
                } else {
                    echo "error|Gagal absen, hubungi tim IT|in";
                }
            }
        }
    }

    public function editprofile()
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $datakaryawan = DB::table('karyawan')->where('nik', $nik)->first();
        return view('presensi.editprofile', compact('datakaryawan'));
    }

    public function updateprofile(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $namalengkap = $request->nama_lengkap;
        $no_hp = $request->no_hp;
        $password= Hash::make($request->password);

        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();
        //ambil photo
        if ($request->hasFile('foto')) {
            $foto = $nik.".".$request->file('foto')->getClientOriginalExtension();
        }else{
            $foto =$karyawan->foto;
        }


        if (empty($request->password)) {
            $data =[
                'nama_lengkap' => $namalengkap,
                'no_hp' => $no_hp,
                'foto'=> $foto
            ];
        } else {
            $data =[
                'nama_lengkap' => $namalengkap,
                'no_hp' => $no_hp,
                'password' => $password,
                'foto'=> $foto
            ];
        }

        $update =  DB::table('karyawan')->where('nik', $nik)->update($data);

        if ($update) {
            if ($request->hasFile('foto')) {
                $folderPath ="public/uploads/profile";
                $request->file('foto')->storeAs($folderPath, $foto);
            }

            return Redirect::back()->with(['success'=>'Data berhasil di update']);
        }else {
             return Redirect::back()->with(['error'=>'Data gagal di update']);
        }
    }


    public function histori()
    {
        $bulan =["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

        return view('presensi.histori', compact('bulan'));
    }

    public function gethistori(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $nik = Auth::guard('karyawan')->user()->nik;
        $histori = DB::table('presensi')
        ->where('nik', $nik)
        ->whereRaw('MONTH(tgl_presensi)="'.$bulan.'"')
        ->whereRaw('YEAR(tgl_presensi)="'.$tahun.'"')
        ->orderBy('tgl_presensi')
        ->get();

        return view('presensi.gethistori', compact('histori'));
    }

    public function izin()
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $dataizin = DB::table('pengajuan_izin')->where('nik', $nik)->get();
        return view('presensi.izin', compact('dataizin'));
    }

    public function buatizin()
    {

        return view('presensi.buatizin');
    }

    public function storeizin(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_izin = $request->tgl_izin;
        $status = $request->status;
        $keterangan = $request->keterangan;

        $data = [
            'nik'=>$nik,
            'tgl_izin'=>$tgl_izin,
            'status'=>$status,
            'keterangan'=>$keterangan
        ];

        $simpan= DB::table('pengajuan_izin')->insert($data);
        if ($simpan) {
            return redirect('/presensi/izin')->with(['success'=>'Data Berhasil Disimpan']);
        } else {
            return redirect('/presensi/izin')->with(['error'=>'Terjadi kesalahan']);
        }
    }

    public function monitoring()
    {
        return view('presensi.monitoring');
    }

    public function getpresensi(Request $request)
    {
        $tanggal = $request->tanggal;
        $presensi = DB::table('presensi')
            ->select('presensi.*', 'karyawan.nama_lengkap', 'department.nama_dept')
            ->join('karyawan', 'presensi.nik','=','karyawan.nik')
            ->join('department','karyawan.kode_dept','=','department.kode_dept')
            ->where('tgl_presensi', $tanggal)
            ->get();

        return view('presensi.getpresensi', compact('presensi'));
    }

    public function tampilkanpeta(Request $request)
    {
        $id = $request->id;
        $presensi = DB::table('presensi')->where('id',$id)
        ->join('karyawan','presensi.nik','=','karyawan.nik')
        ->first();
        return view('presensi.showmap', compact('presensi'));
    }

    public function laporanpresensi()
    {
        $bulan =["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

        $karyawan = DB::table('karyawan')->orderBy('nama_lengkap')->get();
        return view('presensi.laporan', compact('bulan','karyawan'));
    }

    public function cetaklaporan(Request $request)
    {
        $nik = $request->nik;
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $namabulan =["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        $karyawan = DB::table('karyawan')->where('nik',$nik)
        ->join('department','karyawan.kode_dept','=','department.kode_dept')
        ->first();

        $presensi = DB::table('presensi')
        ->where('nik', $nik)
        ->whereRaw('MONTH(tgl_presensi)="'.$bulan.'"')
        ->whereRaw('YEAR(tgl_presensi)="'.$tahun.'"')
        ->orderBy('tgl_presensi')
        ->get();

        if (isset($_POST['exportexcel'])) {
            $time=date("d-M-Y H:i:s");
            // fungsi header dengan mengirimkan raw data excel
            header("Content-type: application/vnd-ms-excel");
            // mendefiniskan nama file export "hasil-export.xls"
            header("Content-Disposition:attachment; filename=Laporan Presensi Karyawan $time.xls");

            return view('presensi.cetaklaporanexcel', compact('bulan','tahun','namabulan','karyawan','presensi'));
        }

        return view('presensi.cetaklaporan', compact('bulan','tahun','namabulan','karyawan','presensi'));
    }

    public function rekappresensi()
    {
        $bulan =["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        return view('presensi.rekappresensi', compact('bulan'));
    }

    public function cetakrekap(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $namabulan =["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

        $presensi = DB::table('presensi')
        ->selectRaw('presensi.nik, karyawan.nama_lengkap, MAX(IF(DAY(tgl_presensi)=1,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_1,
        MAX(IF(DAY(tgl_presensi)=2,CONCAT(jam_in," - ",IFNULL(jam_out,"00:00:00")),"")) as tgl_2,
        MAX(IF(DAY(tgl_presensi)=3,CONCAT(jam_in," - ",IFNULL(jam_out,"00:00:00")),"")) as tgl_3,
        MAX(IF(DAY(tgl_presensi)=4,CONCAT(jam_in," - ",IFNULL(jam_out,"00:00:00")),"")) as tgl_4,
        MAX(IF(DAY(tgl_presensi)=5,CONCAT(jam_in," - ",IFNULL(jam_out,"00:00:00")),"")) as tgl_5,
        MAX(IF(DAY(tgl_presensi)=6,CONCAT(jam_in," - ",IFNULL(jam_out,"00:00:00")),"")) as tgl_6,
        MAX(IF(DAY(tgl_presensi)=7,CONCAT(jam_in," - ",IFNULL(jam_out,"00:00:00")),"")) as tgl_7,
        MAX(IF(DAY(tgl_presensi)=8,CONCAT(jam_in," - ",IFNULL(jam_out,"00:00:00")),"")) as tgl_8,
        MAX(IF(DAY(tgl_presensi)=9,CONCAT(jam_in," - ",IFNULL(jam_out,"00:00:00")),"")) as tgl_9,
        MAX(IF(DAY(tgl_presensi)=10,CONCAT(jam_in," - ",IFNULL(jam_out,"00:00:00")),"")) as tgl_10,
        MAX(IF(DAY(tgl_presensi)=11,CONCAT(jam_in," - ",IFNULL(jam_out,"00:00:00")),"")) as tgl_11,
        MAX(IF(DAY(tgl_presensi)=12,CONCAT(jam_in," - ",IFNULL(jam_out,"00:00:00")),"")) as tgl_12,
        MAX(IF(DAY(tgl_presensi)=13,CONCAT(jam_in," - ",IFNULL(jam_out,"00:00:00")),"")) as tgl_13,
        MAX(IF(DAY(tgl_presensi)=14,CONCAT(jam_in," - ",IFNULL(jam_out,"00:00:00")),"")) as tgl_14,
        MAX(IF(DAY(tgl_presensi)=15,CONCAT(jam_in," - ",IFNULL(jam_out,"00:00:00")),"")) as tgl_15,
        MAX(IF(DAY(tgl_presensi)=16,CONCAT(jam_in," - ",IFNULL(jam_out,"00:00:00")),"")) as tgl_16,
        MAX(IF(DAY(tgl_presensi)=17,CONCAT(jam_in," - ",IFNULL(jam_out,"00:00:00")),"")) as tgl_17,
        MAX(IF(DAY(tgl_presensi)=18,CONCAT(jam_in," - ",IFNULL(jam_out,"00:00:00")),"")) as tgl_18,
        MAX(IF(DAY(tgl_presensi)=19,CONCAT(jam_in," - ",IFNULL(jam_out,"00:00:00")),"")) as tgl_19,
        MAX(IF(DAY(tgl_presensi)=20,CONCAT(jam_in," - ",IFNULL(jam_out,"00:00:00")),"")) as tgl_20,
        MAX(IF(DAY(tgl_presensi)=21,CONCAT(jam_in," - ",IFNULL(jam_out,"00:00:00")),"")) as tgl_21,
        MAX(IF(DAY(tgl_presensi)=22,CONCAT(jam_in," - ",IFNULL(jam_out,"00:00:00")),"")) as tgl_22,
        MAX(IF(DAY(tgl_presensi)=23,CONCAT(jam_in," - ",IFNULL(jam_out,"00:00:00")),"")) as tgl_23,
        MAX(IF(DAY(tgl_presensi)=24,CONCAT(jam_in," - ",IFNULL(jam_out,"00:00:00")),"")) as tgl_24,
        MAX(IF(DAY(tgl_presensi)=25,CONCAT(jam_in," - ",IFNULL(jam_out,"00:00:00")),"")) as tgl_25,
        MAX(IF(DAY(tgl_presensi)=26,CONCAT(jam_in," - ",IFNULL(jam_out,"00:00:00")),"")) as tgl_26,
        MAX(IF(DAY(tgl_presensi)=27,CONCAT(jam_in," - ",IFNULL(jam_out,"00:00:00")),"")) as tgl_27,
        MAX(IF(DAY(tgl_presensi)=28,CONCAT(jam_in," - ",IFNULL(jam_out,"00:00:00")),"")) as tgl_28,
        MAX(IF(DAY(tgl_presensi)=29,CONCAT(jam_in," - ",IFNULL(jam_out,"00:00:00")),"")) as tgl_29,
        MAX(IF(DAY(tgl_presensi)=30,CONCAT(jam_in," - ",IFNULL(jam_out,"00:00:00")),"")) as tgl_30,
        MAX(IF(DAY(tgl_presensi)=31,CONCAT(jam_in," - ",IFNULL(jam_out,"00:00:00")),"")) as tgl_31')
        ->join('karyawan', 'presensi.nik','=','karyawan.nik')
        ->whereRaw('MONTH(tgl_presensi)="'.$bulan.'"')
        ->whereRaw('YEAR(tgl_presensi)="'.$tahun.'"')
        ->groupBy('presensi.nik','karyawan.nama_lengkap')
        ->get();

        if (isset($_POST['exportexcel'])) {
            $time=date("d-M-Y H:i:s");
            // fungsi header dengan mengirimkan raw data excel
            header("Content-type: application/vnd-ms-excel");
            // mendefiniskan nama file export "hasil-export.xls"
            header("Content-Disposition:attachment; filename=Rekap Presensi Karyawan $time.xls");
        }

        return view('presensi.cetakrekap', compact('bulan','tahun','namabulan','presensi'));
    }

    public function approvalizin(Request $request)
    {
        // $izinsakit = DB::table('pengajuan_izin')
        // ->join('karyawan','pengajuan_izin.nik','=','karyawan.nik')
        // ->orderBy('tgl_izin', 'desc')
        // ->get();
        $dariTanggal = $request->tanggal;
        $toTanggal =  $request->totanggal;
        $nik = $request->nik;
        $nama_lengkap = $request->nama;
        $status_approved = $request->status_approved;

        $query = Pengajuanizin::query();
        $query->select('id','tgl_izin', 'pengajuan_izin.nik', 'nama_lengkap', 'jabatan', 'status_approved', 'keterangan');
        $query->join('karyawan','pengajuan_izin.nik','=','karyawan.nik');
        if (!empty($dariTanggal) && !empty($toTanggal))  {
            $query->whereBetween('tgl_izin', [$dariTanggal, $toTanggal]);
        }

        if (!empty($nik))  {
            $query->where('pengajuan_izin.nik', $nik);
        }

        if (!empty($nama_lengkap))  {
            $query->where('karyawan.nama_lengkap','like','%'.$nama_lengkap.'%');
        }

        if ($status_approved === '0' || $status_approved === '1' || $status_approved === '2')  {
            $query->where('status_approved', $status_approved);
        }

        $query->orderBy('tgl_izin', 'desc');

        $izinsakit = $query->paginate(2);
        $izinsakit->appends($request->all());

        return view('presensi.approvalizin', compact('izinsakit'));
    }

    public function approveizinsakit(Request $request)
    {
        $status_approved = $request->status_approved;
        $id = $request->id_izinsakit;


        $update =  DB::table('pengajuan_izin')
        ->where('id', $id)
        ->update([
            'status_approved' => $status_approved
            ]);

        if ($update) {
            return Redirect::back()->with(['success'=>'Data berhasil di update']);
        }else {
             return Redirect::back()->with(['error'=>'Data gagal di update']);
        }
    }

    public function batalkanizinsakit($id)
    {
        $update = DB::table('pengajuan_izin')
        ->where('id', $id)
        ->update([
            'status_approved'=>0
        ]);

        if ($update) {
            return Redirect::back()->with(['success'=>'Data berhasil di update']);
        }else {
             return Redirect::back()->with(['error'=>'Data gagal di update']);
        }
    }

    public function checkpengajuanizin(Request $request)
    {
        $tgl_izin = $request->tgl_input;
        $nik = Auth::guard('karyawan')->user()->nik;

        $cek = DB::table('pengajuan_izin')
        ->where('nik',$nik)
        ->where('tgl_izin', $tgl_izin)
        ->count();
        return $cek;
    }
}
