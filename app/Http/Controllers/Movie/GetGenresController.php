<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Services\MovieService;

class GetGenresController extends Controller
{
    protected $service;

    public function __construct(MovieService $movieService)
    {
        $this->service = $movieService;
    }

    public function __invoke()
    {
        $genres = $this->service->getAllGenres();

        return response()->json([
            'genres' => $genres
        ]);
    }
}
