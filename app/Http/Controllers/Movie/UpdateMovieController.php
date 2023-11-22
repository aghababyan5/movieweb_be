<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovieUpdateRequest;
use App\Models\Movie;
use App\Services\MovieService;
use Illuminate\Http\JsonResponse;

class UpdateMovieController extends Controller
{
    protected $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function __invoke(MovieUpdateRequest $request, $id): JsonResponse
    {
        $movie = Movie::findOrFail($id);

        $movie->update($request->validated());

        return response()->json([
            'message' => 'Movie updated successfully'
        ]);
    }
}
