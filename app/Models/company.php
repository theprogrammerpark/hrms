<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;

class company extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'company';

    protected $fillable = [
        'comCode',
        'comName',
        'comAddress',
        'comContact',
        'comEmail'
    ];

    protected $hidden = [];

    protected $rules =[
        'comCode' => 'required|string',
        'comName' => 'required|string',
    ];

    public function validate($data)
    {
        $validator = Validator::make($data, $this->rules);
        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }
    }
}
