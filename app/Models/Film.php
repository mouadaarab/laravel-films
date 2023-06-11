<?php

namespace App\Models;

use App\Classes\Person;
use App\Services\TheMovieDBService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Film extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'adult',
        'backdrop_path',
        'themoviedb_id',
        'title',
        'original_language',
        'original_title',
        'overview',
        'poster_path',
        'release_date',
        'video',
        'vote_average',
        'vote_count',
        'genre_id',
        'trending_week',
        'trending_day',
    ];

    protected $casts = [
        'adult' => 'boolean',
        'video' => 'boolean',
        'release_date' => 'date',
        'vote_average' => 'float',
        'vote_count' => 'integer',
        'trending_week' => 'boolean',
        'trending_day' => 'boolean',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class)->withTimestamps();
    }

    public function scopeTrending($query, $timeWindow)
    {
        return $query->where('trending_' . $timeWindow, true);
    }


    public function getBackdropUrlAttribute()
    {
        return $this->backdrop_path
            ? config('services.themoviedb.backdrop_image_url') . $this->backdrop_path
            : 'https://via.placeholder.com/1280x720.png?text=No+Image';
    }

    public function getPosterUrlAttribute()
    {
        return $this->poster_path
            ? config('services.themoviedb.poster_image_url') . $this->poster_path
            : 'https://via.placeholder.com/500x750.png?text=No+Image';
    }

    public function getReleaseYearAttribute()
    {
        return $this->release_date->format('Y');
    }

    public function getGenresListAttribute()
    {
        return $this->genres->pluck('name')->implode(', ');
    }

    public function getYoutubeTrailerAttribute(){
        $youtubeTrailerVideo = app(TheMovieDBService::class)
            ->getFilmVideos($this->themoviedb_id)
            ->where('site', 'YouTube')
            ->where('type', 'Trailer')
            ->first();

        if($youtubeTrailerVideo){
            return 'https://www.youtube.com/embed/' . $youtubeTrailerVideo['key'];
        }

        return null;
    }

    public function getCastsAttribute(){
        $casts = app(TheMovieDBService::class)
            ->getFilmCredits($this->themoviedb_id)['cast'];

        return Person::collection($casts);
    }

    public function getCrewsAttribute(){
        $crews = app(TheMovieDBService::class)
            ->getFilmCredits($this->themoviedb_id)['crew'];

        return Person::collection($crews);
    }
}
