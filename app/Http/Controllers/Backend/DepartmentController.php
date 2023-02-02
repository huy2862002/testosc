<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\ViewDepartmentService;
use App\Services\ViewEmployeeService;
use App\Traits\OAthTokenTrait;
use Illuminate\Http\Request;



class DepartmentController extends Controller
{
    use OAthTokenTrait;

    protected $viewDepartmentService, $viewEmployeeService;
    public function __construct(ViewDepartmentService $viewDepartmentService, ViewEmployeeService $viewEmployeeService)
    {
        $this->viewDepartmentService = $viewDepartmentService;
        $this->viewEmployeeService = $viewEmployeeService;
    }
    public function index()
    {
        return view('backend.department.list');
    }

    public function create(Request $request)
    {
        $urlD = config('constants.linkApiLocal').'/list-department';
        $urlE = config('constants.linkApiLocal').'/list-employee';

        $departments = (array) $this->viewDepartmentService->listDepartment();
        $employees = (array) $this->viewEmployeeService->listEmployee();

        return view('backend.department.create', compact('departments', 'employees'));
    }

    public function delete($id)
    {
        $this->viewDepartmentService->deleteDepartment($id);
        return redirect()->back();
    }

    public function edit($id, Request $request)
    {
        $department = (array) $this->viewDepartmentService->showDepartment($id);
        $departments = (array) $this->viewDepartmentService->listDepartment();
        $employees = (array) $this->viewEmployeeService->listEmployee();
        return view('backend.department.update', compact('department', 'departments', 'employees', 'id'));
    }
}
