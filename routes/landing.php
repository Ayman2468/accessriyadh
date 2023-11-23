<?php

use App\Http\Controllers\Landing\ApplicationRequestController;
use App\Http\Controllers\Landing\BuildingTypeController;
use App\Http\Controllers\Landing\ListController;
use App\Http\Controllers\Landing\QuestionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(['prefix' => 'audit', 'as' => 'audit.','middleware'=>'localization'], function () {
    Route::get('/building-types', [BuildingTypeController::class, 'index'])->name('index');
    Route::post('/register', [ApplicationRequestController::class, 'register'])->name('index');
    Route::get('/application', [ApplicationRequestController::class, 'show'])->name('show');
    Route::get('/userApplications', [ApplicationRequestController::class, 'get_user_applications'])->name('get_user_applications');
    Route::get('/questions', [QuestionController::class, 'index'])->name('index');
    Route::post('/answer', [QuestionController::class, 'answer'])->name('answer');
    Route::post('/finish', [QuestionController::class, 'finish'])->name('finish');
});
Route::get('/lists', [ListController::class, 'index'])->name('index');

