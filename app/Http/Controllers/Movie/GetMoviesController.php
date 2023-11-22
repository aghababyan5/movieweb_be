<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Services\MovieService;

class GetMoviesController extends Controller
{
    protected $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function __invoke()
    {
        $movies = $this->movieService->getAll();

        return response()->json([
            'movies' => $movies
        ]);
    }
}
