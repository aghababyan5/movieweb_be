<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovieRequest;
use App\Services\MovieService;
use Illuminate\Http\JsonResponse;

class UpdateMovieController extends Controller
{

    protected $service;

    public function __construct(MovieService $movieService)
    {
        $this->service = $movieService;
    }

    public function __invoke(MovieRequest $request, $id): JsonResponse
    {
        $this->service->update($id, $request->validated());

        return response()->json([
            'message' => 'Movie updated successfully',
        ]);
    }

}
