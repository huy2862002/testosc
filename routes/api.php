<?php

use App\Http\Controllers\Api\AnnouncementController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\DesignationController;
use App\Http\Controllers\Api\EmployeeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('List-department', [DepartmentController::class, 'list'])->name('department.index');
Route::post('Create-department', [DepartmentController::class, 'create'])->name('department.create');
Route::post('Update-department/{id}', [DepartmentController::class, 'update'])->name('department.update');
Route::get('List-employee', [EmployeeController::class, 'list'])->name('employee.index');
