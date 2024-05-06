<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Auth\LoginRegisterController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api'],function(){
    Route::apiResource('/test',ApiController::class);
    Route::post('login',[LoginRegisterController::class,'login']);
    Route::post('register',[LoginRegisterController::class,'register']);
});





Route::group(['middleware' => 'sanctumMiddleware'],
 function(){
    Route::post('logout',[LoginRegisterController::class,'logout']);
    Route::apiResource('/test', ApiController::class)->only(['store', 'update', 'destroy']);
    Route::get('user-profile',[LoginRegisterController::class,'userProfile']);
 });