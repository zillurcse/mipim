<?php

use App\Http\Controllers\ImageController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/image-gallery/get',[ImageController::class,'get_gallery']);
Route::get('/banner',[\App\Http\Controllers\BannerController::class,'index']);
Route::post('/banner',[\App\Http\Controllers\BannerController::class,'store']);
Route::get('/content',[\App\Http\Controllers\ContentController::class,'index']);
Route::post('/content',[\App\Http\Controllers\ContentController::class,'store']);
