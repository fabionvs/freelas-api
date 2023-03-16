<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CandyController;
use App\Http\Controllers\UserCandyController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChainController;
use App\Http\Controllers\NewsController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/signup', [AuthController::class, 'signup']);
    Route::post('/file/upload', [FileController::class, 'upload']);
    Route::post('/candy/create', [CandyController::class, 'create']);

});
Route::post('me', [AuthController::class, 'me']);
Route::post('logout', [AuthController::class, 'logout']);
Route::get('/news', [NewsController::class, 'search']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/chains', [ChainController::class, 'index']);
