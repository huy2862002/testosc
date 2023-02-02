<?php

use App\Http\Controllers\Api\AnnouncementController;
use App\Http\Controllers\Api\AuthController;
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

Route::get('list-department', [DepartmentController::class, 'index'])->name('department.index');
Route::post('create-department', [DepartmentController::class, 'create'])->name('department.create');
Route::get('show-department/{id}', [DepartmentController::class, 'show'])->name('department.show');
Route::post('update-department/{id}', [DepartmentController::class, 'update'])->name('department.update');
Route::delete('delete-department/{id}', [DepartmentController::class, 'delete'])->name('department.delete');
Route::get('list-employee', [EmployeeController::class, 'index'])->name('employee.index');

Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});
