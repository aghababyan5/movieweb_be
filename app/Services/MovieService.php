<?php

namespace App\Services;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Collection;

class MovieService
{
    public function store(array $data)
    {
        return Movie::query()->create([
            'title' => $data['title'],
            'release_date' => $data['release_date'],
            'country' => $data['country'],
            'genre' => $data['genre'],
            'duration' => $data['duration'],
            'description' => $data['description'],
            'img' => $data['img'],
            'video' => $data['video'],
        ]);
    }

    public function getAll()
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

    public function update(array $data)
    {
        $movie = Movie::query()->where('id', $data['id']);

        $movie->update([
            'title' => $data['title'],
            'release_date' => $data['release_date'],
            'country' => $data['country'],
            'genre' => $data['genre'],
            'duration' => $data['duration'],
            'img' => $data['img'],
            'video' => $data['video'],
        ]);

        return response()->noContent();
    }

    public function getAllGenres(): Collection
    {
        return Genre::all();
    }

    public function getMoviesByGenre($id)
    {
    }
}
