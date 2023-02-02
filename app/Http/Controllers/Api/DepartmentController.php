<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\DepartmentService;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    protected $departmentService;
    public function __construct(DepartmentService $departmentService){
        $this->departmentService = $departmentService;
    }
    public function index(Request $request)
    {
        return $this->departmentService->listDepartment($request);
    }

    public function create(Request $request)
    {
        return $this->departmentService->createDepartment($request);
    }
    
    public function update($id,Request $request)
    {
        return $this->departmentService->updateDepartment($id,$request);
    }

    public function delete($id)
    {
        return $this->departmentService->deleteDepartment($id);
    }

    public function show($id)
    {
        return $this->departmentService->showDepartment($id);
    }
}
