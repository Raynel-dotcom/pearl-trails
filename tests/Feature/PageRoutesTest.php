<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageRoutesTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_loads_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Pearl Trails');
        $response->assertSee('Your Uganda. Your Budget. Your Adventure.');
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
        $response->assertSee('Explore Uganda');
    }

    public function test_saved_page_loads_successfully(): void
    {
        $response = $this->get('/saved');
        $response->assertStatus(200);
        $response->assertSee('Saved Trips');
    }

    public function test_browse_pages_load_successfully(): void
    {
        $this->get('/stays')->assertStatus(200)->assertSee('Where to Stay');
        $this->get('/eat')->assertStatus(200)->assertSee('Where to Eat');
        $this->get('/recreation')->assertStatus(200)->assertSee('Recreation & Fun Activities');
    }

    public function test_static_pages_load_successfully(): void
    {
        $this->get('/about')->assertStatus(200)->assertSee('About Pearl Trails');
        $this->get('/contact')->assertStatus(200)->assertSee('Contact Pearl Trails');
        $this->get('/privacy')->assertStatus(200)->assertSee('Privacy Policy');
        $this->get('/terms')->assertStatus(200)->assertSee('Terms of Service');
        $this->get('/list-your-business')->assertStatus(200)->assertSee('List Your Business');
    }
}
