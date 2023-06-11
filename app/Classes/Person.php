<?php

namespace App\Classes;

class Person
{
    public $id;
    public $name;
    public $character;
    public $job;
    public $profile_url;

    public function __construct($person)
    {
        $this->id = $person['id'];
        $this->name = $person['name'];
        $this->character = $person['character'] ?? null;
        $this->job = $person['job'] ?? null;
        $this->profile_url = $person['profile_path']
            ? config('services.themoviedb.profile_image_url') . $person['profile_path']
            : 'https://via.placeholder.com/1280x720.png?text=No+Image';
    }

    public static function collection($persons, $take = 7)
    {
        return collect($persons)
        ->unique('name')
        ->take($take)
        ->map(function ($person) {
            return new Person($person);
        });
    }


}
