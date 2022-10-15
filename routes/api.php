<?php
use App\Http\Controllers\Api\bookController;
use App\Http\Controllers\Api\categoryController;
use App\Http\Controllers\Api\CommentController ;
use App\Http\Controllers\Api\FavoriteConteoller;
use App\Http\Controllers\Api\orderbyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


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

Route::resource('/books', bookController::class);
Route::resource('/categorys', categoryController::class);
Route::resource('/comments', CommentController::class);
Route::resource('/favorites', FavoriteConteoller::class);
Route::get('/orderby/{type}', [orderbyController::class,'order']);
Route::get('/filterby/{catogry}', [orderbyController::class,'filterby']);

Route::apiResource('ratebook', 'App\Http\Controllers\Api\RateBookController');

// Route::post('register','');
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);


