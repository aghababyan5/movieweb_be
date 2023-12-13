<?php

namespace App\Services;

use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\ReleaseDate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
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
            '/movie_images',
            file_get_contents($data['img'])
        );

        $sliderImageName = Str::random(32).'.'
            .$data['img_slider']->getClientOriginalExtension();
        Storage::disk('public')->put(
            '/movie_slider_images',
            file_get_contents($data['img_slider'])
        );

        $genreNames = $data['genres'];
        $genreIds = Genre::whereIn('name', $genreNames)->pluck('id')->toArray();

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

    public function getAll(): Collection
    {
        return Movie::all();
    }

    public function getOne($id)
    {
        return Movie::find($id);
    }

    public function destroy($id)
    {
        return Movie::find($id)->delete();
    }

    public function update(array $data): Response
    {
        $movie = Movie::query()->where('id', $data['id']);

        $movie->update([
            'title'        => $data['title'],
            'release_date' => $data['release_date'],
            'country'      => $data['country'],
            'genre'        => $data['genre'],
            'duration'     => $data['duration'],
            'img'          => $data['img'],
            'video'        => $data['video'],
        ]);

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
