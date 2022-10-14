<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Api\RegisterController;
use App\Http\Controllers\backend\admin\AnswerController;
use App\Http\Controllers\backend\admin\QuestionController;
use App\Http\Controllers\backend\admin\AdminDashboardController;
use App\Http\Controllers\backend\admin\SurveyStrategyController;

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
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/details/update', [RegisterController::class, 'update']);
Route::post('/login', [RegisterController::class, 'login']);

Route::middleware('auth:sanctum')->group( function () {
    
    // business and employee details
    
    Route::post('/business/details', [RegisterController::class, 'BusinessDetails']);

    // business and employee details

    // users import export

    Route::get('/importExportView', [RegisterController::class, 'importExportView']);
    Route::get('/export', [RegisterController::class, 'export']);
    Route::post('/users/import', [RegisterController::class, 'import']);
    Route::post('/users/add', [RegisterController::class, 'registerUsers']);
    Route::get('/users', [AdminDashboardController::class, 'getUsers']);

    // users import export

    // categories & sub categories

    Route::get('/categories', [AdminDashboardController::class, 'categories']);

    // categories & sub categories
    
    // Questions & Answers

    Route::get('/questions', [QuestionController::class, 'index']);
    Route::post('/answers', [AnswerController::class, 'store']);
    
    // Questions & Answers
    
    // Survey Strategy

    Route::post('/survey/add', [SurveyStrategyController::class, 'create']);

    // Survey Strategy

});
