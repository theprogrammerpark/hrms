<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class DepartemenController extends Controller
{
    public function home(Request $request)
    {
        $nama_dept = $request->nama_dept;
        $query = Department::query();
        $query->select('*');
        if (!empty($nama_dept)) {
            $query->where('nama_dept', 'like', '%'.$nama_dept.'%');
        }

        $departemen = $query->get();

        return view('departemen.home', compact('departemen'));
    }

    public function store(Request $request)
    {
        $kode_dept = $request->kode_dept;
        $nama_dept = $request->nama_dept;

        try {
            $data =[
                'kode_dept'=>$kode_dept,
                'nama_dept'=>$nama_dept
            ];

            $simpan = DB::table('department')->insert($data);

            if ($simpan) {
                return Redirect::back()->with(['success'=>'Data berhasil disimpan']);
            }
        } catch (\Exception $e) {
            if ($e->getCode()==23000) {
                $message ="Data dengan nik " .$kode_dept. " sudah ada";
            }
            return Redirect::back()->with(['warning'=>'data gagal disimpan, '.$message]);
        }
    }

    public function edit(Request $request)
    {
        $kode_dept =$request->kode_dept;

        $departemen = DB::table('department')->where('kode_dept',$kode_dept)->first();
        return view('departemen.edit',  compact('departemen'));
    }

    public function update($kode_dept, Request $request)
    {
        $kode_dept = $request->kode_dept;
        $nama_dept = $request->nama_dept;

        try {
            $data =[
                'kode_dept'=>$kode_dept,
                'nama_dept'=>$nama_dept
            ];

            $update = DB::table('department')->where('kode_dept',$kode_dept)->update($data);

            if ($update) {
                return Redirect::back()->with(['success'=>'Data berhasil diupdate']);
            }
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning'=>'data gagal diupdate']);
        }
    }

    public function delete($kode_dept)
    {
        $delete = DB::table('department')->where('kode_dept',$kode_dept)->delete();
        if ($delete) {
            return Redirect::back()->with(['success'=>'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning'=>'Data Gagal Dihapus']);
        }
    }
}
