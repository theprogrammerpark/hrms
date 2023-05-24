<?php

namespace App\Http\Controllers;

use App\Models\KantorCabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CabangController extends Controller
{
   public function index(Request $request)
   {
        $nama_cabang = $request->nama_cabang;
        $query = KantorCabang::query();
        $query->select('*');
        if (!empty($nama_cabang)) {
            $query->where('nama_cabang', 'like', '%'.$nama_cabang.'%');
        }

        $cabang = $query->get();

        return view('kantorcabang.index', compact('cabang'));
   }

   public function store(Request $request)
   {
    $kode_cabang = $request->kode_cabang;
    $nama_cabang = $request->nama_cabang;
    $alamat_cabang = $request->alamat_cabang;
    $lokasi_kantor = $request->lokasi_kantor;
    $radius = $request->radius;

    try {
        $data =[
            'kode_cabang'=>$kode_cabang,
            'nama_cabang'=>$nama_cabang,
            'alamat_cabang'=>$alamat_cabang,
            'lokasi_kantor'=>$lokasi_kantor,
            'radius'=>$radius
        ];

        $simpan = DB::table('cabang')->insert($data);

        if ($simpan) {
            return Redirect::back()->with(['success'=>'Data berhasil disimpan']);
        }
    } catch (\Exception $e) {
        if ($e->getCode()==23000) {
            $message ="Data dengan nik " .$kode_cabang. " sudah ada";
        } else {
            $message =$e->getMessage();
        }
        return Redirect::back()->with(['warning'=>'data gagal disimpan, '.$message]);
    }
   }

   public function edit(Request $request)
   {
    $kode_cabang =$request->kode_cabang;

    $kantorcabang = DB::table('cabang')->where('kode_cabang',$kode_cabang)->first();
    return view('kantorcabang.edit',  compact('kantorcabang'));
   }

   public function update($kode_cabang, Request $request)
    {
        $kode_cabang = $request->kode_cabang;
        $nama_cabang = $request->nama_cabang;
        $alamat_cabang = $request->alamat_cabang;
        $lokasi_kantor = $request->lokasi_kantor;
        $radius = $request->radius;

        try {
            $data =[
                'kode_cabang'=>$kode_cabang,
                'nama_cabang'=>$nama_cabang,
                'alamat_cabang'=>$alamat_cabang,
                'lokasi_kantor'=>$lokasi_kantor,
                'radius'=>$radius
            ];

            $update = DB::table('cabang')->where('kode_cabang',$kode_cabang)->update($data);

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

    public function delete($kode_cabang)
    {
        $delete = DB::table('cabang')->where('kode_cabang',$kode_cabang)->delete();

        if ($delete) {
            return Redirect::back()->with(['success'=>'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning'=>'Data Gagal Dihapus']);
        }
    }
}
