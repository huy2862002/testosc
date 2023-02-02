<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ViewDepartmentService
{
    public function __construct()
    {
        //
    }

    public function listDepartment()
    {
        $urlD = config('constants.linkLocal') . '/api/list-department';

        $responseD = Http::get($urlD)->body();

        $departments = json_decode($responseD);

        return $departments;
    }

    public function showDepartment($id)
    {
        $urlD = config('constants.linkLocal') . '/api/show-department/' . $id;

        $responseD = Http::get($urlD)->body();

        $department = json_decode($responseD);

        return $department;
    }

    public function deleteDepartment($id)
    {
        $urlD = config('constants.linkLocal') . '/api/delete-department/'.$id;

        $responseD = Http::asForm()->delete($urlD, ['id'=>$id])->body();

        $department = json_decode($responseD);

        return $department;
    }
}
