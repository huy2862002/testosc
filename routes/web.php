<?php

use App\Http\Controllers\Api\DepartmentController as ApiDepartmentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Backend\DepartmentController;
use App\Http\Controllers\Backend\DesignationController;
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

Route::middleware('guest')->get('Login', [LoginController::class, 'viewLogin'])->name('login.view');
Route::middleware('guest')->post('Login', [LoginController::class, 'storeLogin'])->name('login.store');
Route::middleware('auth')->get('Logout', [LogoutController::class, 'logout'])->name('logout');
Route::middleware('auth')->get('', function () {
    return view('layoutAdmin.main');
})->name('home');

Route::middleware('auth')->prefix('Admin')->name('admin.')->group(function(){
    Route::get('Dashboard', function () {
        return view('layoutAdmin.main');
    })->name('dashboard');
    
    Route::prefix('Department')->name('department.')->group(function(){
        Route::get('', [DepartmentController::class, 'index'])->name('index');
        Route::get('Create', [DepartmentController::class, 'create'])->name('create');
        Route::get('Delete/{id}', [DepartmentController::class, 'delete'])->name('delete');
        Route::get('Update/{id}', [DepartmentController::class, 'edit'])->name('edit');
    });
});
