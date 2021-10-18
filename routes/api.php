<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::get('/item/search/{name}',[ItemController::class,'searchName']);
Route::get('/item/image',[ItemController::class,'downloadImage']);
Route::post('/item/upload-image',[ItemController::class,'uploadImage']);

Route::group(['middleware' => ['auth:sanctum']],function(){
    Route::post('/logout',[AuthController::class,'logout']);
    Route::apiResource('items',ItemController::class);
    Route::apiResource('orders',OrderController::class);
    Route::apiResource('users',UserController::class);
});
