<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ViewEmployeeService
{
    public function listEmployee()
    {
        $urlE = config('constants.linkLocal').'/api/list-employee';
       
        $responseE = Http::get($urlE)->body();

        $employees = json_decode($responseE);

        return $employees;
    }
}
