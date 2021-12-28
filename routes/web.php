<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\HomeController;


//Route::any('dash/{any?}', 'HomeController@dash')->where(['any' => '.*']);

//Route::get('/' , [HomeController::class,'index']);


Route::get('/', [HomeController::class, 'index']);
//Route::get('/category/create', [HomeController::class, 'index']);
Route::any('/category/{any?}', [HomeController::class, 'index'])->where(['any' => '.*']);
Route::get('/category', [HomeController::class, 'index']);
//Route::any('/category/{any}', [HomeController::class, 'index'])->where(['any' => '.*']);
//các route khác


