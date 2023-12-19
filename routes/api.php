<?php

use App\Http\Controllers\Auth\GetUserController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\UserRegisterController;
use App\Http\Controllers\Movie\DeleteMovieController;
use App\Http\Controllers\Movie\GetCountriesController;
use App\Http\Controllers\Movie\GetGenresController;
use App\Http\Controllers\Movie\GetMoviesByGenreController;
use App\Http\Controllers\Movie\GetMoviesController;
use App\Http\Controllers\Movie\GetReleaseDatesController;
use App\Http\Controllers\Movie\ShowMovieController;
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
    Route::post('/movie', StoreMovieController::class); // tested (new)
    Route::get('/movies', GetMoviesController::class); // tested (new)
    Route::get('/movies/{id}', ShowMovieController::class); // tested (new)
    Route::delete('/movies/{id}', DeleteMovieController::class); // tested (new)
    Route::post('/movies/{id}', UpdateMovieController::class); // tested (new)
    Route::get('/genres', GetGenresController::class); // tested (new)
    Route::get('/movies-of-genre/{genreId}', GetMoviesByGenreController::class);
    Route::get('/countries', GetCountriesController::class); // tested (new)
    Route::get(
        '/release-dates',
        GetReleaseDatesController::class
    ); // tested (new)
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
