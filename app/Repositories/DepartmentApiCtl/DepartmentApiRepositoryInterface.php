<?php
namespace App\Repositories\DepartmentApiCtl;
use Illuminate\Http\Request;

interface DepartmentApiRepositoryInterface
{
    public function list(Request $request);
}
