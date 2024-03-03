<?php

use App\Http\Controllers\ImageController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

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

Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken($request->device_name)->plainTextToken;
});

//Route::group(['middleware'=>['auth:sanctum']], function (){
Route::post('/image-gallery/get', [ImageController::class, 'get_gallery']);

Route::get('/banner', [\App\Http\Controllers\BannerController::class, 'index']);
Route::post('/banner', [\App\Http\Controllers\BannerController::class, 'store']);
Route::post('/banner/update_order', [\App\Http\Controllers\BannerController::class, 'update_order']);

Route::delete('/banner/{id}', [\App\Http\Controllers\BannerController::class, 'destroy']);

Route::get('/content', [\App\Http\Controllers\ContentController::class, 'index']);
Route::post('/content', [\App\Http\Controllers\ContentController::class, 'store']);
Route::post('/content/update_order', [\App\Http\Controllers\ContentController::class, 'update_order']);


Route::delete('/content/{id}', [\App\Http\Controllers\ContentController::class, 'destroy']);

Route::get('/bio-container', [\App\Http\Controllers\BioContainerController::class, 'index']);
Route::post('/bio-container', [\App\Http\Controllers\BioContainerController::class, 'store']);
Route::post('/bio-container/{id}', [\App\Http\Controllers\BioContainerController::class, 'update']);
//});

Route::post('/sanctum/token', [\App\Http\Controllers\BannerController::class, 'token']);
Route::get('/web/banner', [\App\Http\Controllers\BannerController::class, 'index']);
Route::get('/web/content', [\App\Http\Controllers\ContentController::class, 'index']);
Route::get('/web/bio-container', [\App\Http\Controllers\BioContainerController::class, 'index']);
