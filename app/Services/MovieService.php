<?php

namespace App\Services;

use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\ReleaseDate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MovieService
{

    public function store(array $data): Model|Builder
    {
        $imageName = Str::random(32).'.'
            .$data['img']->getClientOriginalExtension();
        Storage::disk('public')->put(
            'movie_images/'.$imageName,
            file_get_contents($data['img'])
        );

        $sliderImageName = Str::random(32).'.'
            .$data['img_slider']->getClientOriginalExtension();
        Storage::disk('public')->put(
            'movie_slider_images/'.$sliderImageName,
            file_get_contents($data['img_slider'])
        );

        $genreNames = $data['genres'];
        $genreIds = Genre::whereIn('title', $genreNames)->pluck('id')->toArray(
        );

        $newMovie
            = Movie::query()->create([
            'title'        => $data['title'],
            'release_date' => $data['release_date'],
            'country'      => $data['country'],
            'duration'     => $data['duration'],
            'description'  => $data['description'],
            'img_slider'   => $sliderImageName,
            'img'          => $imageName,
            'video'        => $data['video'],
            'imdb_score'   => $data['imdb_score'],
        ]);

        $newMovie->genres()->attach($genreIds);

        return $newMovie;
    }

    public function getAll()
    {
        return Movie::with([
            'genres' => function ($query) {
                $query->select('title');
            },
        ])->get();
    }

    public function show($id)
    {
        $movie = Movie::find($id);
        if ( ! $movie) {
            abort(404);
        }

        return $movie->load([
            'genres' => function ($query) {
                $query->select('title');
            },
        ]);
    }

    public function destroy($id): Response|JsonResponse
    {
        $movie = Movie::find($id);

        if ( ! $movie) {
            abort(404);
        }

        $movieImage = $movie['img'];
        $movieSliderImage = $movie['img_slider'];

        Storage::disk('public')->delete('movie_images/'.$movieImage);
        Storage::disk('public')->delete(
            'movie_slider_images/'.$movieSliderImage
        );

        $movie->genres()->detach();

        $movie->delete();

        return response()->noContent();
    }

    public function update($id, array $data): Response|JsonResponse
    {
        $movie = Movie::find($id);

        if ( ! $movie) {
            abort(404);
        }

        $oldImageName = $movie['img'];
        $oldSliderImageName = $movie['img_slider'];
        $newImage = $data['img'];
        $newSliderImage = $data['img_slider'];

        // Generating new image names
        $newImageName = Str::random(32).'.'
            .$newImage->getClientOriginalExtension();
        $newSliderImageName = Str::random(32).'.'
            .$newSliderImage->getClientOriginalExtension();

        // Deleting old images
        Storage::disk('public')->delete('movie_images/'.$oldImageName);
        Storage::disk('public')->delete(
            'movie_slider_images/'.$oldSliderImageName
        );

        // Storing new images
        Storage::disk('public')->put(
            'movie_images/'.$newImageName,
            file_get_contents($newImage)
        );
        Storage::disk('public')->put(
            'movie_slider_images/'.$newSliderImageName,
            file_get_contents($newSliderImage)
        );

        // Updating database
        $movie->update([
            'title'        => $data['title'],
            'release_date' => $data['release_date'],
            'country'      => $data['country'],
            'duration'     => $data['duration'],
            'description'  => $data['description'],
            'img_slider'   => $newSliderImageName,
            'img'          => $newImageName,
            'video'        => $data['video'],
            'imdb_score'   => $data['imdb_score'],
        ]);

        // Syncing genres
        $genreNames = $data['genres'];
        $genreIds = Genre::whereIn('title', $genreNames)->pluck('id')->toArray(
        );
        $movie->genres()->sync($genreIds);

        return response()->noContent();
    }

    public function getAllGenres(): Collection
    {
        return Genre::all();
    }

    public function getReleaseDates(): Collection
    {
        return ReleaseDate::all();
    }

    public function getCountries(): Collection
    {
        return Country::all();
    }

}
