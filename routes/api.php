<?php

use App\Http\Controllers\postController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::get('/posts', [ postController::class, 'all']);
Route::get('/posts/{id}', [ postController::class, 'get']);
Route::post('/posts', [ postController::class, 'post']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
