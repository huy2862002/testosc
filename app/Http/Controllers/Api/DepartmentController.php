<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\DepartmentTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DepartmentController extends Controller
{
    use DepartmentTrait;
    public function index(Request $request)
    {
        return $this->listDepartment($request);
    }

    public function create(Request $request)
    {
        return $this->createDepartment($request);
    }

    public function update($id,Request $request)
    {
        return $this->updateDepartment($id,$request);
    }

    public function delete($id)
    {
        return $this->deleteDepartment($id);
    }

    public function show($id)
    {
        return $this->showDepartment($id);
    }
}
