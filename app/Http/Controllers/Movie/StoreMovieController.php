<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovieRequest;
use App\Services\MovieService;

class StoreMovieController extends Controller
{
    protected $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function __invoke(MovieRequest $request)
    {
        $this->movieService->store($request->validated());

        return response()->json([
            'message' => 'Movie stored successfully'
        ]);
    }

}
