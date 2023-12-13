<?php

use App\Http\Controllers\Auth\GetUserController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\UserRegisterController;
use App\Http\Controllers\Movie\DeleteMovieController;
use App\Http\Controllers\Movie\GetCountriesController;
use App\Http\Controllers\Movie\GetGenresController;
use App\Http\Controllers\Movie\GetMovieController;
use App\Http\Controllers\Movie\GetMoviesController;
use App\Http\Controllers\Movie\GetReleaseDatesController;
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
    Route::post('/register', UserRegisterController::class); // tested
    Route::post('/movie', StoreMovieController::class); // tested
    Route::get('/movies', GetMoviesController::class); // tested
    Route::get('/movies/{id}', GetMovieController::class); // tested
    Route::delete('/movies/{id}', DeleteMovieController::class); // tested
    Route::put('/movies/{id}', UpdateMovieController::class); // tested
    Route::get('/genres', GetGenresController::class); // tested
    Route::get('/countries', GetCountriesController::class); // tested
    Route::get('/release_dates', GetReleaseDatesController::class); // tested
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post(
            '/logout',
            LogoutController::class
        ); // tested (with access_token)
        Route::get(
            '/user',
            GetUserController::class
        ); // tested (with access token)
    });
});
