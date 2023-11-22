<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Services\MovieService;

class GetMovieController extends Controller
{
    protected $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function __invoke($id)
    {
        $movie = $this->movieService->getOne($id);

        return response()->json([
            'movie' => $movie
        ]);
    }
}
