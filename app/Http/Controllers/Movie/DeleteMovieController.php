<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Services\MovieService;
use Illuminate\Http\JsonResponse;

class DeleteMovieController extends Controller
{
    protected $service;

    public function __construct(MovieService $movieService)
    {
        $this->service = $movieService;
    }

    public function __invoke($id): JsonResponse
    {
        $this->service->destroy($id);

        return response()->json([
            'message' => 'Movie deleted successfully'
        ]);
    }
}
