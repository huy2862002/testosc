<?php
namespace App\Repositories\DepartmentApiCtl;

use App\Http\Controllers\Api\DepartmentController;
use Illuminate\Http\Request;

class DepartmentApiRepository implements DepartmentApiRepositoryInterface
{

    public function list(Request $request)
    {
      $newDepartment = new DepartmentController();
    }
}
