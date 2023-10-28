<?php

use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BuildingTypeController;
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
Route::group(['middleware'=>['auth','admin']],function(){

        Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
            Route::get('/auth', [UserController::class, 'auth'])->name('auth');
        });
        Route::group(['prefix' => 'building-type', 'as' => 'building-type.'], function () {
            Route::get('/', [BuildingTypeController::class, 'index'])->name('index');
        Route::get('/{id}/questions', [BuildingTypeController::class, 'questions'])->name('questions');
        Route::post('/{id}/questions/store', [BuildingTypeController::class, 'store'])->name('store');
        Route::post('/{id}/questions/{questionId}/update', [BuildingTypeController::class, 'updateQuestion'])->name('updateQuestion');
        Route::post('/{id}/update', [BuildingTypeController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [BuildingTypeController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/questions/order', [BuildingTypeController::class, 'updateOrder'])->name('updateOrder');
        Route::post('/{id}/questions/phase', [BuildingTypeController::class, 'updatePhase'])->name('updatePhase');
        Route::post('/{id}/questions/title', [BuildingTypeController::class, 'updateTitle'])->name('updateTitle');
    });
    Route::group(['prefix' => 'application', 'as' => 'application.'], function () {
        Route::get('/', [ApplicationController::class, 'index'])->name('index');
        Route::get('/{id}/show', [ApplicationController::class, 'show'])->name('show');
        Route::get('/delete/{id}', [ApplicationController::class, 'destroy'])->name('delete');
    });
    Route::group(['prefix' => 'question', 'as' => 'question.'], function () {
        Route::get('/', [QuestionController::class, 'index'])->name('index');
        Route::post('/store', [QuestionController::class, 'store'])->name('store');
        Route::post('/{questionId}/update', [QuestionController::class, 'update'])->name('update');
        Route::post('/order', [QuestionController::class, 'updateOrder'])->name('updateOrder');
        Route::post('/phase', [QuestionController::class, 'updatePhase'])->name('updatePhase');
        Route::get('/delete/{id}', [QuestionController::class, 'destroy'])->name('destroy');
    });
});
