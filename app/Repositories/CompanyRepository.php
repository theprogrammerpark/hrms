<?php

namespace App\Repositories;

use App\Models\company;
use Illuminate\Support\Facades\DB;


class CompanyRepository implements CompanyRepositoryInterface
{
    public function all(){
        $param1 ='';
        $data = DB::select('CALL sp_company_showbyparam(?)', [$param1]);
        return $data;
    }

    public function find($id){
        $data = DB::select('CALL sp_company_showbyid(?)', [$id]);
        return $data;
    }

    public function create($data){
        try {
            $data = DB::select('CALL sp_company_insert(:pcode, :pname, :paddress, :pcontact,:pemail)',
            [
                'pcode'=> $data['comCode'],
                'pname'=> $data['comName'],
                'paddress'=> $data['comAddress'],
                'pcontact'=> $data['comContact'],
                'pemail'=> $data['comEmail'],
            ]);
        } catch (\Throwable $th) {

        }

        return $data;
    }

    public function update($data){
        $update = DB::select('CALL sp_company_update(:pid, :pcode, :pname, :paddress, :pcontact,:pemail)',
        [
            'pid'=> $data['ID'],
            'pcode'=> $data['comCode'],
            'pname'=> $data['comName'],
            'paddress'=> $data['comAddress'],
            'pcontact'=> $data['comContact'],
            'pemail'=> $data['comEmail'],
        ]);

        return $update;
    }

    public function delete($id){
        $Result = false;
        try {
            $data = DB::select('CALL sp_company_delete(?)', [$id]);
            $Result = true;
        } catch (\Throwable $th) {
        }

        return $Result;
    }
}
