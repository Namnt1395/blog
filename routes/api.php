<?php

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

Route::get('version', function () {
    return response()->json(['version' => config('app.version')]);
});

//Route::middleware('auth:api')->get('/user', function (Requests $request) {
//    Log::debug('User:' . serialize($request->user()));
//    return $request->user();
//});

Route::namespace('App\\Http\\Controllers\\API\V1')->group(function () {

    Route::get('tag/list', 'TagController@list');
    Route::get('category/list', 'CategoryController@list');
    Route::put('category/{category}', 'CategoryController@updateData');

//    Route::apiResources([
//        'category' => 'CategoryController',
//    ]);

});
