<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;
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
}
