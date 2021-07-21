<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Post;

use App\Http\Controllers\PostsApiController;
use App\Http\Controllers\UsersApiController;

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


//Posts - from the tutorial
Route::get('/posts', [PostsApiController::class, 'index']);

Route::post('/posts', [PostsApiController::class, 'store']);

Route::put('/posts/{post}', [PostsApiController::class, 'update']);

Route::delete('/posts/{post}', [PostsApiController::class, 'delete']);

//Users
Route::get('/users', [UsersApiController::class, 'index']);

Route::post('/users',[UsersApiController::class, 'store']);

Route::put('/users/{user}', [UsersApiController::class, 'update']);

Route::delete('/users/{user}', [UsersApiController::class, 'delete']);