<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\TodoController;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
Route::get('/',[ImageController::class,'index'] );
Route::post('/',[ImageController::class,'upload'] );
Route::get('snatch/{id}', [ImageController::class,'snatch'] );
Route::get('all', [ImageController::class,'all']);
Route::get('delete/{id}', [ImageController::class,'delete']);
