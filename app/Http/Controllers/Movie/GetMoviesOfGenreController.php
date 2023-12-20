<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Services\MovieService;
use Illuminate\Http\JsonResponse;

class GetMoviesOfGenreController extends Controller
{

    protected $service;

    public function __construct(MovieService $movieService)
    {
        $this->service = $movieService;
    }

    public function __invoke($genreId): JsonResponse
    {
        $movies = $this->service->getMoviesOfGenre($genreId);

        return response()->json([
            'movies' => $movies,
        ]);
    }

}
