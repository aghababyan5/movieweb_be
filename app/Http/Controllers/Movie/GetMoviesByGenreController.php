<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Services\MovieService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetMoviesByGenreController extends Controller
{
    protected $service;

    public function __construct(MovieService $movieService)
    {
        $this->service = $movieService;
    }

    public function __invoke($genreId): JsonResponse
    {
        $movies = $this->service->getMoviesByGenre($genreId);

        return response()->json([
            'movies' => $movies
        ]);
    }
}
