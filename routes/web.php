<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\backend\admin\AdminDashboardController;
use App\Http\Controllers\backend\superadmin\SuperAdminDashboardController;
use App\Http\Controllers\backend\superadmin\CategoryController;
use App\Http\Controllers\backend\superadmin\QuestionController;
use App\Http\Controllers\backend\superadmin\AnswerController;
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
    Route::post('/add-role',  [SuperAdminDashboardController::class,'addRole'])->name('addRole');
    Route::get('/view-role',  [SuperAdminDashboardController::class,'ViewRole'])->name('ViewRole');
    Route::get('/edit-role/{id}',  [SuperAdminDashboardController::class,'EditRoleForm'])->name('EditRole');
    Route::post('/update-role/{id}',  [SuperAdminDashboardController::class,'update'])->name('updateRole');
    Route::get('/delete-role/{id}',  [SuperAdminDashboardController::class,'delete'])->name('Delete');

    // category code start
    Route::get('/category', [CategoryController::class,'categoryForm'])->name('categoryForm');
    Route::post('/category', [CategoryController::class,'store'])->name('store');
    Route::get('/view-categories', [CategoryController::class,'viewCategories'])->name('viewCategories');
    Route::get('/edit-category/{id}',  [CategoryController::class,'EditCategoryForm'])->name('EditCategoryForm');
    Route::post('/update-category/{id}',  [CategoryController::class,'update'])->name('updateCategory');
    // sub category
    Route::get('/sub-category', [CategoryController::class,'subCategoryForm'])->name('subCategoryForm');
    Route::post('/sub-category', [CategoryController::class,'storeSubCategory'])->name('storeSubCategory');
    Route::get('/delete-categ/{id}',  [CategoryController::class,'deleteCateegory'])->name('deleteCateegory');


    // category code end


    // Questions code start
    Route::get('/question', [QuestionController::class,'questionForm'])->name('questionForm');
    Route::post('/add-question', [QuestionController::class,'storeQuestion'])->name('storeQuestion');
    Route::get('/view-questions', [QuestionController::class,'viewQuestions'])->name('viewQuestions');
    Route::get('/edit-question/{id}',  [QuestionController::class,'EditQuestionForm'])->name('EditQuestionForm');
    Route::post('/update-question/{id}',  [QuestionController::class,'update'])->name('updateQuestion');
    Route::get('/delete-question/{id}',  [QuestionController::class,'deleteQuestion'])->name('deleteQuestion');

    // Questions code end

    // answer code start

    Route::get('/answerForm', [AnswerController::class,'answerForm'])->name('answerForm');
    Route::post('/add-answer', [AnswerController::class,'storeAnswer'])->name('storeAnswer');
    Route::get('/view-answer', [AnswerController::class,'viewAnswer'])->name('viewAnswer');
    Route::get('/edit-answer/{id}',  [AnswerController::class,'editAnswerForm'])->name('editAnswer');
    Route::post('/update-answer/{id}',  [AnswerController::class,'updateAnswer'])->name('updateAnswer');
    Route::get('/delete-answer/{id}',  [AnswerController::class,'deleteAnswer'])->name('deleteAnswer');
   });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Route::controller(SuperAdminDashboardController::class)->group(function () {
//     Route::get('/dashboard', 'superadmin')->name('dashboard');
//     Route::get('/create-role', 'RoleForm');
//     Route::post('/store', 'store');
//     Route::get('/view-role', 'ViewRole');



// });
