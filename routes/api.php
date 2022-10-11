<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Api\RegisterController;
use App\Http\Controllers\backend\admin\AnswerController;
use App\Http\Controllers\backend\admin\QuestionController;

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

    // users import export
    Route::get('/importExportView', [RegisterController::class, 'importExportView'])->name('importExportView');
    Route::get('/export', [RegisterController::class, 'export'])->name('export');
    Route::post('/import', [RegisterController::class, 'import'])->name('import');
    // users import export
    
    // Questions & Answers
    Route::get('/question', [QuestionController::class, 'index'])->name('questionGet');
    Route::post('/answer', [AnswerController::class, 'store'])->name('answerPost');
    // Questions & Answers
});