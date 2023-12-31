<?php

namespace Tests\Feature\Livewire\Film;

use App\Http\Livewire\Film\Show;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ShowTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Show::class);

        $component->assertStatus(200);
    }
}
