<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Api\DesignationController as ApiDesignationController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function index()
   {
    return view('backend.designation.list');
   }

   public function create(){
    return view('backend.designation.create');
   }

   public function delete($id){
    $newDepartment = new ApiDepartmentController();
    $newDepartment->delete($id);
    return redirect()->back();
   }

   public function edit($id){
    $newDepartment = new ApiDepartmentController();
    $department = $newDepartment->show($id);
    $departments = $newDepartment->list();
    $newEmployee = new EmployeeController();
    $employees = $newEmployee->list();
    return view('backend.department.update', compact('department','departments', 'employees', 'id'));
   }
}
