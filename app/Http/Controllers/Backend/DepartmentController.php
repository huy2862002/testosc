<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Api\DepartmentController as ApiDepartmentController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Controller;
use App\Repositories\DepartmentApiCtl\DepartmentApiRepositoryInterface;
use Illuminate\Http\Request;


class DepartmentController extends Controller
{
    protected $departmentApi;
    public function __construct(DepartmentApiRepositoryInterface $departmentApiRepositoryInterface)
    {
        $this->departmentApi = $departmentApiRepositoryInterface;
    }
    public function index()
    {
        return view('backend.department.list');
    }

    public function create()
    {
        $a = $this->departmentApi->test();
        dd($a);
        return view('backend.department.create', compact('departments', 'employees'));
    }

    public function delete($id)
    {
        $newDepartment = new ApiDepartmentController();
        $newDepartment->delete($id);
        return redirect()->back();
    }

    public function edit($id)
    {
        $newDepartment = new ApiDepartmentController();
        $department = $newDepartment->show($id);
        $dataSend = new Request();
        $departments = $newDepartment->list($dataSend);
        $newEmployee = new EmployeeController();
        $employees = $newEmployee->list();
        return view('backend.department.update', compact('department', 'departments', 'employees', 'id'));
    }
}
