<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
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

Route::get('/books', [BookController::class, 'showBooks']);
Route::get('/book/{id}', [BookController::class, 'showBook']);
Route::post('/book', [BookController::class, 'createBook']);
Route::patch('/book/{id}', [BookController::class, 'updateBook']);
Route::delete('/book/{id}', [BookController::class, 'deleteBook']);

Route::get('/genres', [GenreController::class, 'showGenres']);
Route::get('/genre/{id}', [GenreController::class, 'showGenre']);
Route::post('/genre', [GenreController::class, 'createGenre']);
Route::patch('/genre/{id}', [GenreController::class, 'updateGenre']);
