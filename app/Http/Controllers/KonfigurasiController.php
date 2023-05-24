<?php

namespace App\Http\Controllers;

use App\Models\Jamkerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class KonfigurasiController extends Controller
{
    public function lokasikantor()
    {
        $lok_kantor = DB::table('konfigurasi_lokasi')->where('id',1)->first();
        // $lok = explode(",", $lok_kantor->lokasi_kantor);
        // $latkantor = $lok[0];
        // $longkantor = $lok[1];
        // $radiuskantor = $lok_kantor->radius;

        return view('konfigurasi.lokasikantor', compact('lok_kantor'));
    }

    public function updatelokasikantor(Request $request)
    {

        $lokasi_kantor = $request->lokasi_kantor;
        $radius = $request->radius;

        $data =[
            'lokasi_kantor' => $lokasi_kantor,
            'radius' => $radius
        ];

        $update =  DB::table('konfigurasi_lokasi')->where('id', 1)->update($data);

        if ($update) {
            return Redirect::back()->with(['success'=>'Data berhasil di update']);
        }else {
             return Redirect::back()->with(['error'=>'Data gagal di update']);
        }
    }

    public function jamkerja(Request $request)
    {
        $nama_jamkerja = $request->nama_jamkerja;

        $query = Jamkerja::query();
        $query->select('*');
        if (!empty($nama_jamkerja)) {
            $query->where('nama_jamkerja', 'like', '%'.$nama_jamkerja.'%');
        }

        $jamkerja = $query->get();

        return view('konfigurasi.jamkerja', compact('jamkerja'));
    }

    public function jamkerjastore(Request $request)
    {
        $kode_jamkerja = $request->kode_jamkerja;
        $nama_jamkerja = $request->nama_jamkerja;
        $awal_jammasuk = $request->awal_jammasuk;
        $jam_masuk = $request->jam_masuk;
        $akhir_jammasuk = $request->akhir_jammasuk;
        $jam_pulang = $request->jam_pulang;

        try {
            $data =[
                'kode_jamkerja'=>$kode_jamkerja,
                'nama_jamkerja'=>$nama_jamkerja,
                'awal_jammasuk'=>$awal_jammasuk,
                'jam_masuk'=>$jam_masuk,
                'akhir_jammasuk'=>$akhir_jammasuk,
                'jam_pulang'=>$jam_pulang
            ];

            $simpan = DB::table('jam_kerja')->insert($data);

            if ($simpan) {
                return Redirect::back()->with(['success'=>'Data berhasil disimpan']);
            } else {
                return Redirect::back()->with(['warning'=>'data gagal disimpan, ']);
            }
        } catch (\Exception $e) {
            if ($e->getCode()==23000) {
                $message ="Data dengan nik " .$kode_jamkerja. " sudah ada";
            } else {
                $message =$e->getMessage();
            }
            return Redirect::back()->with(['warning'=>'data gagal disimpan, '.$message]);
        }

    }

    public function jamkerjaedit( Request $request)
    {
        $kode_jamkerja =$request->kode_jamkerja;
        $jamkerja = DB::table('jam_kerja')->where('kode_jamkerja',$kode_jamkerja)->first();
        return view('konfigurasi.jamkerjaeditview',  compact('jamkerja'));
    }

    public function jamkerjaupdate($kode_jamkerja, Request $request )
    {
        $nama_jamkerja = $request->nama_jamkerja;
        $awal_jammasuk = $request->awal_jammasuk;
        $jam_masuk = $request->jam_masuk;
        $akhir_jammasuk = $request->akhir_jammasuk;
        $jam_pulang = $request->jam_pulang;

        try {
            $data =[
                'kode_jamkerja'=>$kode_jamkerja,
                'nama_jamkerja'=>$nama_jamkerja,
                'awal_jammasuk'=>$awal_jammasuk,
                'jam_masuk'=>$jam_masuk,
                'akhir_jammasuk'=>$akhir_jammasuk,
                'jam_pulang'=>$jam_pulang
            ];


            $update = DB::table('jam_kerja')->where('kode_jamkerja',$kode_jamkerja)->update($data);

            if ($update) {
                return Redirect::back()->with(['success'=>'Data berhasil diupdate']);
            } else
            {
                return Redirect::back()->with(['warning'=>'data gagal diupdate']);
            }
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning'=>'data gagal diupdate']);
        }
    }

    public function jamkerjadelete($kode_jamkerja)
    {
        $delete = DB::table('jam_kerja')->where('kode_jamkerja',$kode_jamkerja)->delete();

        if ($delete) {
            return Redirect::back()->with(['success'=>'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning'=>'Data Gagal Dihapus']);
        }
    }

    public function setjamkerja($nik, Request $request)
    {
        $karyawan = DB::table('karyawan')
        ->where('karyawan.nik',$nik)
        ->leftJoin('jadwal_kerja','karyawan.nik','=','jadwal_kerja.nik')
        ->first();

        $jamkerja = DB::table('jam_kerja')->orderBy('nama_jamkerja')->get();

        return view('konfigurasi.setjamkerja', compact('karyawan','jamkerja', 'nik'));
    }

    public function jadwalkerja($nik, Request $request)
    {
        $senin = $request->kode_jamkerja1;
        $selasa = $request->kode_jamkerja2;
        $rabu = $request->kode_jamkerja3;
        $kamis = $request->kode_jamkerja4;
        $jumat = $request->kode_jamkerja5;
        $sabtu = $request->kode_jamkerja6;
        $minggu = $request->kode_jamkerja7;



        try {
            $dataisExist = DB::table('jadwal_kerja')->where('nik',$nik)->count();

            if ($dataisExist>0) {
                $data =[
                    'senin'=>$senin,
                    'selasa'=>$selasa,
                    'rabu'=>$rabu,
                    'kamis'=>$kamis,
                    'jumat'=>$jumat,
                    'sabtu'=>$sabtu,
                    'minggu'=>$minggu
                ];
                $simpan = DB::table('jadwal_kerja')->where('nik',$nik)->update($data);
            } else {

                $data =[
                    'nik'=>$nik,
                    'senin'=>$senin,
                    'selasa'=>$selasa,
                    'rabu'=>$rabu,
                    'kamis'=>$kamis,
                    'jumat'=>$jumat,
                    'sabtu'=>$sabtu,
                    'minggu'=>$minggu
                ];

                $simpan = DB::table('jadwal_kerja')->where('nik',$nik)->insert($data);
            }

            // dd($x);
                return Redirect::back()->with(['success'=>'Data berhasil diupdate']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning'=>'data gagal diupdate']);
        }
    }
}
