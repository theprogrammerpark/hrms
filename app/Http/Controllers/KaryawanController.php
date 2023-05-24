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
        $query->select('karyawan.*','nama_dept', 'nama_cabang');
        $query->join('department', 'karyawan.kode_dept','=','department.kode_dept');
        $query->leftjoin('cabang', 'karyawan.kode_cabang','=','cabang.kode_cabang');
        $query->orderBy('nama_lengkap');

        if (!empty($request->nama_karyawan)) {
            $query->where('nama_lengkap', 'like', '%'.$request->nama_karyawan.'%');
        }

        if (!empty($request->kode_dept)) {
            $query->where('department.kode_dept', '=', $request->kode_dept);
        }

        if (!empty($request->kode_cabang)) {
            $query->where('karyawan.kode_cabang', '=', $request->kode_cabang);
        }

        $karyawan = $query->paginate(10);
        $karyawan->appends($request->all());

        $department = DB::table('department')->get();
        $cabang = DB::table('cabang')->get();

        return view('karyawan.index', compact('karyawan', 'department', 'cabang'));
    }

    public function store(Request $request)
    {
        $nik = $request->nik;
        $nama_langkap = $request->nama_langkap;
        $jabatan = $request->jabatan;
        $no_hp = $request->nohp;
        $kode_dept = $request->kode_dept;
        $kode_cabang = $request->kode_cabang;
        $password = Hash::make('12345');


         //ambil photo
         if ($request->hasFile('foto')) {
            $foto = $nik.".".$request->file('foto')->getClientOriginalExtension();
        }else{
            $foto =null;
        }

        try {
            $data =[
                'nik'=>$nik,
                'nama_lengkap'=>$nama_langkap,
                'jabatan'=>$jabatan,
                'no_hp'=>$no_hp,
                'kode_dept'=>$kode_dept,
                'foto'=>$foto,
                'password'=>$password,
                'kode_cabang'=>$kode_cabang
            ];

            $simpan = DB::table('karyawan')->insert($data);

            if ($simpan) {
                if ($request->hasFile('foto')) {
                    $folderPath ="public/uploads/profile";
                    $request->file('foto')->storeAs($folderPath, $foto);
                }

                return Redirect::back()->with(['success'=>'Data berhasil disimpan']);
            }
        } catch (\Exception $e) {
            if ($e->getCode()==23000) {
                $message ="Data dengan nik " .$nik. " sudah ada";
            }
            return Redirect::back()->with(['warning'=>'data gagal disimpan, '.$message]);
        }
    }

    public function edit(Request $request)
    {
        $nik =$request->nik;
        $department = DB::table('department')->get();
        $karyawan = DB::table('karyawan')->where('nik',$nik)->first();
        $cabang = DB::table('cabang')->get();
        return view('karyawan.edit',  compact('department', 'karyawan', 'cabang'));
    }

    public function update($nik, Request $request)
    {
        $nik = $request->nik;
        $nama_lengkap = $request->nama_langkap;
        $jabatan = $request->jabatan;
        $no_hp = $request->nohp;
        $kode_dept = $request->kode_dept;
        $password = Hash::make('12345');
        $kode_cabang = $request->kode_cabang;

        $old_foto = $request->old_foto;

        if ($request->hasFile('foto')) {
            $foto = $nik.".".$request->file('foto')->getClientOriginalExtension();
        }else{
            $foto =$old_foto;
        }

        try {
            $data =[
                'nama_lengkap'=>$nama_lengkap,
                'jabatan'=>$jabatan,
                'no_hp'=>$no_hp,
                'kode_dept'=>$kode_dept,
                'foto'=>$foto,
                'password'=>$password,
                'kode_cabang'=>$kode_cabang
            ];

            $update = DB::table('karyawan')->where('nik',$nik)->update($data);

            if ($update) {
                if ($request->hasFile('foto')) {
                    $folderPath ="public/uploads/profile";
                    $folderPathOld ="public/uploads/profile".$old_foto;
                    Storage::delete($folderPathOld);
                    $request->file('foto')->storeAs($folderPath, $foto);
                }

                return Redirect::back()->with(['success'=>'Data berhasil diupdate']);
            }
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning'=>'data gagal diupdate']);
        }
    }

    public function delete($nik)
    {
        $delete = DB::table('karyawan')->where('nik',$nik)->delete();
        if ($delete) {
            return Redirect::back()->with(['success'=>'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning'=>'Data Gagal Dihapus']);
        }
    }
}
