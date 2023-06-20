<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoriesController;
use App\Http\Controllers\API\UsersController;
// use App\Models\User;

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
Route::get('/categories', [CategoriesController::class, 'index']);
Route::get('/categories/{id}', [CategoriesController::class, 'show']);
Route::post('/categories', [CategoriesController::class, 'store']);
Route::put('/categories/{id}', [CategoriesController::class, 'update']);
Route::delete('/categories/{id}', [CategoriesController::class, 'destroy']);

Route::middleware(['admin-access'])->group(function () {
    Route::put('/users/{id}', [UsersController::class, 'update']);


});



Route::apiResource('users','App\Http\Controllers\API\UsersController')->middleware('superAdmin-access');
//register
Route::post('create',[App\Http\Controllers\API\AuthController::class,'create'])->middleware('superAdmin-access');
//login
Route::post('login',[App\Http\Controllers\API\AuthController::class,'login']);
//update
// Route::PUT(`/user/update/{$id}`,[App\Http\Controllers\API\UsersController::class,'update']);
