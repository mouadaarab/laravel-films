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
        'original_title',
        'poster_path',
        'release_date',
        'video',
        'vote_average',
        'vote_count',
        'genre_id',
    ];

    protected $casts = [
        'adult' => 'boolean',
        'video' => 'boolean',
        'release_date' => 'date',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class)->withTimestamps();
    }
}
