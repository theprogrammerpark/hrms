<?php

namespace App\Repositories;

use App\Models\company;

interface CompanyRepositoryInterface
{
    public function all();
    public function find($id);
    public function create($data);
    public function update($data);
    public function delete($id);
}
