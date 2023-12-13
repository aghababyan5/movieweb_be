<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Services\MovieService;
use Illuminate\Http\JsonResponse;

class GetCountriesController extends Controller
{

    protected $service;

    public function __construct(MovieService $movieService)
    {
        $this->service = $movieService;
    }

    public function __invoke(): JsonResponse
    {
        $countries = $this->service->getCountries();

        return response()->json([
            'countries' => $countries,
        ]);
    }

}
