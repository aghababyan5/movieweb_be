<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Services\MovieService;

class GetMovieController extends Controller
{
    protected $service;

    public function __construct(MovieService $movieService)
    {
        $this->service = $movieService;
    }

    public function __invoke($id)
    {
        $movie = $this->service->getOne($id);

        return response()->json([
            'movie' => $movie
        ]);
    }
}
