<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Traits\DepartmentTrait;
use App\Traits\EmployeeTrait;
use Illuminate\Http\Request;


class DepartmentController extends Controller
{
    use DepartmentTrait, EmployeeTrait;
    public function index()
    {
        return view('backend.department.list');
    }

    public function create(Request $request)
    {
        $departments = $this->listDepartment($request);
        $employees = $this->listEmployee();
        return view('backend.department.create', compact('departments', 'employees'));
    }

    public function delete($id)
    {
        $this->deleteDepartment($id);
        return redirect()->back();
    }

    public function edit($id, Request $request)
    {
        $department = $this->showDepartment($id);
        $departments = $this->listDepartment($request);
        $employees = $this->listEmployee();
        return view('backend.department.update', compact('department', 'departments', 'employees', 'id'));
    }
}
