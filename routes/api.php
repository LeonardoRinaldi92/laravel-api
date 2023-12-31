<?php

use App\Http\Controllers\Api\ProjectCrontroller;
use App\Http\Controllers\Api\TypeController;
use App\Http\Controllers\Api\TagController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/projects',[ProjectCrontroller::class, 'index']);
Route::get('/projects/{slug}',[ProjectCrontroller::class, 'show']);
Route::get('types',[TypeController::class, 'index']);
Route::get('tags',[TagController::class, 'index']);