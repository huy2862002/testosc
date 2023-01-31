<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\EmployeeTrait;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    use EmployeeTrait;

    public function index()
    {
        return $this->listEmployee();
    }
}
