<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Services\MovieService;
use Illuminate\Http\JsonResponse;

class GetReleaseDatesController extends Controller
{
    protected $service;

    public function __construct(MovieService $movieService)
    {
        $this->service = $movieService;
    }

    public function __invoke(): JsonResponse
    {
        $releaseDates = $this->service->getReleaseDates();

        return response()->json([
            'release_dates' => $releaseDates
        ]);
    }
}
