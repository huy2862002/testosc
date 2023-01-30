<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Api\DepartmentController as ApiDepartmentController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
   {
    return view('backend.department.list');
   }

   public function create(){
    $newDepartment = new ApiDepartmentController();
    $dataSend = new Request();
    $departments = $newDepartment->list($dataSend);
    $newEmployee = new EmployeeController();
    $employees = $newEmployee->list();
    return view('backend.department.create', compact('departments', 'employees'));
   }

   public function delete($id){
    $newDepartment = new ApiDepartmentController();
    $newDepartment->delete($id);
    return redirect()->back();
   }

   public function edit($id){
    $newDepartment = new ApiDepartmentController();
    $department = $newDepartment->show($id);
    $departments = $newDepartment->fetch_form();
    $newEmployee = new EmployeeController();
    $employees = $newEmployee->list();
    return view('backend.department.update', compact('department','departments', 'employees', 'id'));
   }
}
