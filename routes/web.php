<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\backend\admin\AdminDashboardController;
use App\Http\Controllers\backend\superadmin\SuperAdminDashboardController;
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

Route::get('/', function () {
    return view('auth.login');
 });
 //Route::get('/', [AdminDashboardController::class,'index'])->name('index');
// Route::get('/admin',[AdminDashboardController::class,'admin'])->name('admin')->middleware('admin');
// Route::get('/superadmin', [AdminDashboardController::class,'superadmin'])->name('superadmin')->middleware('superadmin');

Route::name('admin')->prefix('admin')->middleware('admin')->group(function () {

    Route::controller(AdminDashboardController::class)->group(function () {
        Route::get('/dashboard', 'admin');
        //Route::post('/orders', 'store');
    });
});
Route::group(['prefix' => 'superadmin','middleware'=>['auth','superadmin']], function () {
//Route::name('superadmin')->prefix('superadmin')->middleware('superadmin')->group(function () {

    Route::get('/superadmin', [SuperAdminDashboardController::class,'superadmin'])->name('superadmin');
    Route::get('/dashboard', [SuperAdminDashboardController::class,'superadmin'])->name('dashboard');
    Route::get('/create-role', [SuperAdminDashboardController::class,'RoleForm'])->name('RoleForm');
    Route::post('/store',  [SuperAdminDashboardController::class,'store'])->name('store');
    Route::get('/view-role',  [SuperAdminDashboardController::class,'ViewRole'])->name('ViewRole');
    Route::get('/edit/{id}',  [SuperAdminDashboardController::class,'EditRoleForm'])->name('EditRoleForm');
    Route::post('/update/{id}',  [SuperAdminDashboardController::class,'update'])->name('update');
    Route::get('/delete/{id}',  [SuperAdminDashboardController::class,'delete'])->name('Delete');


});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Route::controller(SuperAdminDashboardController::class)->group(function () {
//     Route::get('/dashboard', 'superadmin')->name('dashboard');
//     Route::get('/create-role', 'RoleForm');
//     Route::post('/store', 'store');
//     Route::get('/view-role', 'ViewRole');
//     Route::get('/edit', 'EditRoleForm');


// });
