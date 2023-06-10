<?php

namespace App\Services;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Support\Facades\Http;

class TheMovieDBService
{
    protected $http;
    public function __construct()
    {
        $this->http = Http::withToken(config('services.themoviedb.api_key'))
                        ->baseUrl(config('services.themoviedb.api_url'));
    }

    public function syncGenres(): void
    {
        $response = $this->http->get($this->addLanguageParamToUrl('/genre/movie/list'));
        $response->throw();
        $genres = $response->json()['genres'];
        foreach ($genres as $genre) {
            Genre::firstOrCreate([
                'themoviedb_id' => $genre['id'],
            ], [
                'name' => $genre['name'],
            ]);
        }
    }

    public function syncFilms(): void
    {
        $response = $this->http->get($this->addLanguageParamToUrl('/movie/popular'));
        $response->throw();
        $films = $response->json()['results'];
        foreach ($films as $film) {
            $this->createOrUpdateFilm($film);
        }
    }

    private function addLanguageParamToUrl(string $url): string
    {
        $language = app()->getLocale();
        return $url . '?language=' . $language;
    }


    protected function createOrUpdateFilm(array $film): void
    {
        $filmModel = Film::firstOrNew(['themoviedb_id' => $film['id']]);
        $filmModel->fill([
            'adult' => $film['adult'],
            'backdrop_path' => $film['backdrop_path'],
            'title' => $film['title'],
            'original_language' => $film['original_language'],
            'original_title' => $film['original_title'],
            'poster_path' => $film['poster_path'],
            'release_date' => $film['release_date'],
            'video' => $film['video'],
            'vote_average' => $film['vote_average'],
            'vote_count' => $film['vote_count'],
        ]);
        $filmModel->save();

        $ids = Genre::query()
            ->whereIn('themoviedb_id', $film['genre_ids'])
            ->pluck('id')
            ->toArray();
        $filmModel->genres()->sync($ids);


    }
}
