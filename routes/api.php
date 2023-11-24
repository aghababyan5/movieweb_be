<?php

use App\Http\Controllers\Auth\GetUserController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\UserRegisterController;
use App\Http\Controllers\Movie\DeleteMovieController;
use App\Http\Controllers\Movie\GetGenresController;
use App\Http\Controllers\Movie\GetMovieController;
use App\Http\Controllers\Movie\GetMoviesController;
use App\Http\Controllers\Movie\StoreMovieController;
use App\Http\Controllers\Movie\UpdateMovieController;
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

Route::group(['middleware' => 'api'], function () {
    Route::post('/register', UserRegisterController::class);
    Route::post('/movies', StoreMovieController::class);
    Route::get('/movies', GetMoviesController::class);
    Route::get('/movies/{id}', GetMovieController::class);
    Route::delete('/movies/{id}', DeleteMovieController::class);
    Route::put('/movies/{id}', UpdateMovieController::class);
    Route::get('/genres', GetGenresController::class);
    Route::get('/release_dates', GetGenresController``::class);
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('/logout', LogoutController::class);
        Route::get('/user', GetUserController::class);
    });
});


