<?php

namespace Tests\Feature\Livewire\Home;

use App\Http\Livewire\Home\Dashboard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Dashboard::class);

        $component->assertStatus(200);
    }
}
