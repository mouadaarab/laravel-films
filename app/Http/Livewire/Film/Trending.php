<?php

namespace App\Http\Livewire\Film;

use Livewire\Component;
use Livewire\WithPagination;

class Trending extends Component
{
    use WithPagination;


    public $timeWindow;
    public $search = '';
    public $searchQuery = '';

    public function mount()
    {
        if(request()->has('time_window')){
            $this->timeWindow = request()->query('time_window');
        }else{
            $this->timeWindow = 'day';
        }

        if(request()->has('search_query')){
            $this->searchQuery = request()->query('search_query');
            $this->search = request()->query('search_query');
        }else{
            $this->search = '';
        }
    }


    public function render()
    {
        $searchResults = \App\Models\Film::query()
            ->trending($this->timeWindow)
            ->where('title', 'like', '%' . $this->search . '%')
            ->orderBy('vote_average', 'desc')
            ->orderBy('vote_count', 'desc')
            ->with('genres')
            ->paginate(9);

        return view('livewire.film.trending', compact('searchResults'));
    }

    public function changeTimeWindow($timeWindow)
    {
        return redirect()->route('films.trending', ['time_window' => $timeWindow]);
    }

    public function changeSearch()
    {
        return redirect()->route('films.trending', [
            'search_query' => $this->searchQuery,
            'time_window' => $this->timeWindow,
        ]);
    }

    public function paginationView()
    {

        return 'components.films-paginate';

    }
}
