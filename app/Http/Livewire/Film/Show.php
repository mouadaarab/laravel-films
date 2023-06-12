<?php

namespace App\Http\Livewire\Film;

use App\Http\Requests\UpdateFilmRequest;
use App\Models\Film;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Show extends Component
{
    public Film $film;
    public $updateFilmModal;
    public $trailerModal;
    public $confirmingFilmDeletionModal;

    protected function rules(){
        return (new UpdateFilmRequest())->rules();
    }

    public function render()
    {
        return view('livewire.film.show');
    }

    public function mount(Film $film)
    {
        $this->film = $film;
    }

    public function save()
    {
        $validated = Validator::make(['film' => $this->film->attributesToArray()], $this->rules())->validate();
        $this->film->update($validated);
        $this->emit('saved');
        $this->updateFilmModal = false;
    }

    public function delete()
    {
        $this->film->delete();
        return redirect()->route('films.trending');
    }

    public function openUpdateFilmModal()
    {
        $this->updateFilmModal = true;
    }

    public function closeUpdateFilmModal()
    {
        $this->updateFilmModal = false;
    }

    public function openTrailerModal()
    {
        $this->trailerModal = true;
        $this->emit('trailerStart');
    }

    public function closeTrailerModal()
    {
        $this->trailerModal = false;
        $this->emit('trailerStop');
    }
}
