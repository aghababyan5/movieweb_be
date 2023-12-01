<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Services\MovieService;
use Illuminate\Http\JsonResponse;

class GetMovieController extends Controller
{
    protected $service;

    public function __construct(MovieService $movieService)
    {
        $this->service = $movieService;
    }

    public function __invoke($id): JsonResponse
    {
        $movie = $this->service->getOne($id);

        return response()->json([
            'movie' => $movie
        ]);
    }
}
