<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\DepartmentController;
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

Route::get('Login', [LoginController::class, 'viewLogin'])->name('login.view');
Route::post('Login', [LoginController::class, 'storeLogin'])->name('login.store');
Route::middleware('auth')->get('', function () {
    return view('layoutAdmin.main');
})->name('home');


Route::prefix('Admin')->name('admin.')->group(function(){
    Route::get('Dashboard', function () {
        return view('layoutAdmin.main');
    })->name('dashboard');
    
    Route::prefix('Department')->name('department.')->group(function(){
        Route::get('', [DepartmentController::class, 'index'])->name('index');
    });
});
