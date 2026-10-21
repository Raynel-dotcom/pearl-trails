<?php

namespace Tests\Feature;

use App\Models\Destination;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DestinationsFilterTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_destinations_index_loads_all_13_destinations(): void
    {
        $response = $this->get('/destinations');
        $response->assertStatus(200);
        $response->assertSee('Explore Uganda\'s 13 Iconic Destinations', false);
        $response->assertSee('Jinja');
        $response->assertSee('Bwindi Impenetrable NP');
        $response->assertSee('Murchison Falls NP');
    }

    public function test_filter_by_region_returns_only_matching(): void
    {
        $response = $this->get('/destinations?region=North');
        $response->assertStatus(200);
        $response->assertSee('Murchison Falls NP');
        $response->assertSee('Kidepo Valley NP');
        $response->assertDontSee('<h3 class="dest-title">Jinja</h3>', false);
    }

    public function test_filter_by_interest_preset_via_explore_by_interest_route(): void
    {
        $response = $this->get('/interest/Wildlife');
        $response->assertStatus(200);
        $response->assertSee('Wildlife');
    }
}
