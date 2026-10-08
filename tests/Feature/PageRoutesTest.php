<?php

namespace Tests\Feature;

use Tests\TestCase;

class PageRoutesTest extends TestCase
{
    public function test_home_page_loads_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Pearl Trails');
        $response->assertSee('Welcome to Pearl Trails');
    }

    public function test_destinations_page_loads_successfully(): void
    {
        $response = $this->get('/destinations');
        $response->assertStatus(200);
        $response->assertSee('Destinations');
    }

    public function test_plan_page_loads_successfully(): void
    {
        $response = $this->get('/plan');
        $response->assertStatus(200);
        $response->assertSee('Plan My Trip');
    }

    public function test_interest_page_loads_successfully(): void
    {
        $response = $this->get('/interest/wildlife');
        $response->assertStatus(200);
        $response->assertSee('Explore by Interest');
        $response->assertSee('Wildlife');
    }

    public function test_saved_page_loads_successfully(): void
    {
        $response = $this->get('/saved');
        $response->assertStatus(200);
        $response->assertSee('Saved Trips');
    }

    public function test_about_page_loads_successfully(): void
    {
        $response = $this->get('/about');
        $response->assertStatus(200);
        $response->assertSee('About Pearl Trails');
    }
}
