<?php

namespace App\Services;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Support\Facades\Http;

class TheMovieDBService
{
    /**
     * http
     *
     * @var mixed
     */
    protected $http;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->http = Http::withToken(config('services.themoviedb.api_key'))
                        ->baseUrl(config('services.themoviedb.api_url'));
    }

    /**
     * syncGenres
     *
     * @return void
     */
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

    /**
     * syncTrendingFilms
     *
     * @param  mixed $timeWindow
     * @return void
     */
    public function syncTrendingFilms($timeWindow): void
    {
        $response = $this->http->get($this->addLanguageParamToUrl('/trending/movie/' . $timeWindow));
        $response->throw();
        $films = $response->json()['results'];
        foreach ($films as $film) {
            $this->createOrUpdateFilm($film, $timeWindow);
        }

        $this->removeOldTrendingFilms($films, $timeWindow);
    }

    /**
     * addLanguageParamToUrl
     *
     * @param  mixed $url
     * @return string
     */
    private function addLanguageParamToUrl(string $url): string
    {
        $language = app()->getLocale();
        return $url . '?language=' . $language;
    }


    /**
     * createOrUpdateFilm
     *
     * @param  mixed $film
     * @param  mixed $timeWindow
     * @return void
     */
    protected function createOrUpdateFilm(array $film, $timeWindow): void
    {
        $dbFilm = Film::where('themoviedb_id', $film['id'])->withTrashed()->first();
        if(!$dbFilm){
            $dbFilm = Film::create([
                'themoviedb_id' => $film['id'],
                'title' => $film['title'],
                'overview' => $film['overview'],
                'poster_path' => $film['poster_path'],
                'backdrop_path' => $film['backdrop_path'],
                'release_date' => $film['release_date'],
                'vote_average' => $film['vote_average'],
                'vote_count' => $film['vote_count'],
                'popularity' => $film['popularity'],
                'trending_' . $timeWindow => true,
            ]);
        }else{
            $dbFilm->update([
                'vote_average' => $film['vote_average'],
                'vote_count' => $film['vote_count'],
                'popularity' => $film['popularity'],
                'trending_' . $timeWindow => true,
            ]);
        }

        $this->syncGenresForFilm($dbFilm, $film['genre_ids']);
    }

    /**
     * syncGenresForFilm
     *
     * @param  mixed $film
     * @param  mixed $genreIds
     * @return void
     */
    protected function syncGenresForFilm(Film $film, array $genreIds): void
    {
        $genres = Genre::whereIn('themoviedb_id', $genreIds)->get();
        $film->genres()->sync($genres);
    }

    /**
     * removeOldTrendingFilms
     *
     * @param  mixed $films
     * @param  mixed $timeWindow
     * @return void
     */
    protected function removeOldTrendingFilms(array $films, $timeWindow): void
    {
        $filmIds = array_column($films, 'id');
        Film::where('trending_' . $timeWindow, true)
            ->whereNotIn('themoviedb_id', $filmIds)
            ->update([
                'trending_' . $timeWindow => false,
            ]);
    }

    /**
     * getFilm
     *
     * @param  mixed $filmId
     * @return array
     */
    public function getFilm(int $filmId): array
    {
        $response = $this->http->get($this->addLanguageParamToUrl('/movie/' . $filmId));
        $response->throw();
        return $response->json();
    }

    /**
     * getFilmCredits
     *
     * @param  mixed $filmId
     * @return array
     */
    public function getFilmCredits(int $filmId): array
    {
        $response = $this->http->get($this->addLanguageParamToUrl('/movie/' . $filmId . '/credits'));
        $response->throw();
        return $response->json();
    }


    /**
     * getFilmVideos
     *
     * @param  mixed $filmId
     * @return \Illuminate\Support\Collection
     */
    public function getFilmVideos(int $filmId): \Illuminate\Support\Collection
    {
        $response = $this->http->get($this->addLanguageParamToUrl('/movie/' . $filmId . '/videos'));
        $response->throw();
        return collect($response->json()['results']);
    }
}
