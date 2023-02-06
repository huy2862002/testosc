<?php

use App\Http\Controllers\Api\DepartmentController as ApiDepartmentController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Backend\DepartmentController;
use App\Http\Controllers\Backend\DesignationController;
use App\Http\Controllers\Backend\EmployeeController as BackendEmployeeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('checkGuest')->get('login', [LoginController::class, 'viewLogin'])->name('login.view');
Route::middleware('checkGuest')->post('login', [LoginController::class, 'storeLogin'])->name('login.store');
Route::middleware('checkAuth')->get('logout', [LogoutController::class, 'logout'])->name('logout');
Route::middleware('checkAuth')->get('account', [LoginController::class, 'account'])->name('account');
Route::middleware('checkAuth')->get('dashboard', function () {
    return view('layoutAdmin.main');
})->name('home');
Route::middleware('checkAuth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', function () {
        return view('layoutAdmin.main');
    })->name('dashboard');

    Route::prefix('department')->name('department.')->group(function () {
        Route::get('', [DepartmentController::class, 'index'])->name('index');
        Route::get('create', [DepartmentController::class, 'create'])->name('create');
        Route::delete('delete/{id}', [DepartmentController::class, 'delete'])->name('delete');
        Route::get('edit/{id}', [DepartmentController::class, 'edit'])->name('edit');
    });

    Route::prefix('employee')->name('employee.')->group(function () {
        Route::get('', [BackendEmployeeController::class, 'index'])->name('index');
      
    });
});
