<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Services\MovieService;

class GetMoviesController extends Controller
{
    protected $service;

    public function __construct(MovieService $movieService)
    {
        $this->service = $movieService;
    }

    public function __invoke()
    {
        $movies = $this->service->getAll();

        return response()->json([
            'movies' => $movies
        ]);
    }
}
