<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoriesController;
use App\Http\Controllers\AuthorController;
// use App\Http\Controllers\BookController;
// use App\Http\Controllers\API\AuthorController;
use App\Http\Controllers\API\BookController;
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

Route::apiResource('books', BookController::class);

Route::apiResource('users','App\Http\Controllers\API\UsersController');
//register
Route::post('create', [App\Http\Controllers\API\AuthController::class, 'create']);
//login
Route::post('login', [App\Http\Controllers\API\AuthController::class, 'login']);
//update
// Route::PUT(`/user/update/{$id}`,[App\Http\Controllers\API\UsersController::class,'update']);
Route::get('/authors', [AuthorController::class, 'index']);
Route::post('/authors', [AuthorController::class, 'store']);
Route::get('/authors/{id}', [AuthorController::class, 'show']);
Route::put('/authors/{id}', [AuthorController::class, 'update']);
Route::delete('/authors/{id}', [AuthorController::class, 'destroy']);


//----------------------------------Route group of the book---------------------------------
Route::prefix('book')->controller(BookController::class)->group(function () {
    Route::get('/', 'index')->name('book.index');

    // Route::show('/{id}', 'show')->name('book.show');

    Route::post('/', 'create')->name('book.create');

    Route::put('/{id}', 'edit')->name('book.edit');

    Route::delete('/{id}', 'delete')->name('book.delete');
});
