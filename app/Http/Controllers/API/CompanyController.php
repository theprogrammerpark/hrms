<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\company;
use App\Repositories\CompanyRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{

    protected $companyRepo;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepo=$companyRepository;
    }

    public function index()
    {
        $data = $this->companyRepo->all();

        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        }else{
            return ApiFormatter::createApi(400, 'Failed');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();
        $rules = [
            'comCode' => 'required|string',
            'comName' => 'required|string'
        ];

        try {
            $validator = Validator::make($data, $rules);
            if ($validator->passes()) {
                $data = $request->json()->all();

                $company = new company();
                $company->validate($data);

                try {
                    $inserdata = $this->companyRepo->create($data);
                    return ApiFormatter::createApi(200, 'Success', $inserdata);
                } catch (Exception $error) {
                    return ApiFormatter::createApi(400, 'Failed',  $error);
                }
            } else {
                //xx =  $validator->errors()->all()
                return ApiFormatter::createApi(400, 'Failed', 'Invalid model');
            }
        } catch (\Throwable $th) {
            return ApiFormatter::createApi(400, 'Failed', 'Invalid model');
        }
    }


    public function show(company $company)
    {
        $company->comcode;
    }

    public function update(Request $request)
    {
        $data = $request->json()->all();
        $company = new company();

        $company->validate($data);

        $updatedata = $this->companyRepo->update($data);
        if ($updatedata) {
            return ApiFormatter::createApi(200, 'Success', $updatedata);
        }else{
            return ApiFormatter::createApi(400, 'Failed');
        }
    }

    public function destroy($id)
    {
        $data = $this->companyRepo->delete($id);

        if ($data) {
            return ApiFormatter::createApi(200, 'Success');
        }else{
            return ApiFormatter::createApi(400, 'Failed');
        }
    }
}
