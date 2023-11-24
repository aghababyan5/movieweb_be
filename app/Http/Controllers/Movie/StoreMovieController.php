<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovieRequest;
use App\Services\MovieService;

class StoreMovieController extends Controller
{
    protected $service;

    public function __construct(MovieService $movieService)
    {
        $this->service = $movieService;
    }

    public function __invoke(MovieRequest $request)
    {
        $this->service->store($request->validated());

        return response()->json([
            'message' => 'Movie stored successfully'
        ]);
    }

}