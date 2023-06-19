<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\API\CategoriesController;
=======
// use App\Models\User;

>>>>>>> 8330a41225a92d6b5faa102a46b12f24f35c710e
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
<<<<<<< HEAD
Route::get('/categories', [CategoriesController::class, 'index']);
Route::get('/categories/{id}', [CategoriesController::class, 'show']);
Route::post('/categories', [CategoriesController::class, 'store']);
Route::put('/categories/{id}', [CategoriesController::class, 'update']);
Route::delete('/categories/{id}', [CategoriesController::class, 'destroy']);

=======
Route::apiResource('users','App\Http\Controllers\API\UsersController');
//register
Route::post('create',[App\Http\Controllers\API\AuthController::class,'create']);
//login
Route::post('login',[App\Http\Controllers\API\AuthController::class,'login']);
//update
// Route::PUT(`/user/update/{$id}`,[App\Http\Controllers\API\UsersController::class,'update']);
>>>>>>> 8330a41225a92d6b5faa102a46b12f24f35c710e
