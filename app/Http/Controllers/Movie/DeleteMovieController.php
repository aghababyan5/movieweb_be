<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Services\MovieService;
use Illuminate\Http\JsonResponse;

class DeleteMovieController extends Controller
{
    protected $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function __invoke($id): JsonResponse
    {
        $this->movieService->destroy($id);

        return response()->json([
            'message' => 'Movie deleted successfully'
        ]);
    }
}
