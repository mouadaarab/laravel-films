<?php

namespace App\Http\Livewire\Film;

use App\Models\Film;
use Livewire\Component;

class Show extends Component
{
    public Film $film;
    public $updateFilmModal;

    protected $rules = [
        'film.title' => 'required|string|min:6',
        'film.original_title' => 'required|string|min:6',
        'film.overview' => 'required|string|min:6',
        'film.trending_day' => 'required|boolean',
        'film.trending_week' => 'required|boolean',
    ];

    public function render()
    {
        return view('livewire.film.show');
    }

    public function save()
    {
        $this->validate();
        $this->film->save();
        $this->emit('saved');
        $this->updateFilmModal = false;
    }

    public function delete()
    {
        $this->film->delete();
        $this->emit('deleted');
    }
}
