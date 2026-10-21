<?php

namespace Tests\Feature;

use App\Models\Destination;
use App\Models\SavedTrip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DetailAndSavedTripsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_destination_detail_page_loads_with_all_sections(): void
    {
        $destination = Destination::where('slug', 'jinja')->firstOrFail();

        $response = $this->get("/destinations/{$destination->slug}");
        $response->assertStatus(200);
        $response->assertSee($destination->name);
        $response->assertSee('Where to stay near Jinja');
        $response->assertSee('Where to eat near Jinja');
        $response->assertSee('Recreation near Jinja');
        $response->assertSee('Build Your Trip Budget');
        $response->assertSee('Estimated Cost Breakdown');
        $response->assertSee('Suggested');
    }

    public function test_user_can_save_and_delete_trip(): void
    {
        $destination = Destination::where('slug', 'jinja')->firstOrFail();

        $response = $this->post('/saved', [
            'destination_id' => $destination->id,
            'days' => 3,
            'style' => 'Moderate',
            'total_ugx' => 450000,
        ]);

        $response->assertRedirect('/saved');
        $this->assertDatabaseHas('saved_trips', [
            'destination_id' => $destination->id,
            'total_ugx' => 450000,
        ]);

        $savedPage = $this->get('/saved');
        $savedPage->assertStatus(200);
        $savedPage->assertSee('Your Saved Uganda Trips');
        $savedPage->assertSee('Jinja');

        $savedTrip = SavedTrip::first();
        $deleteResponse = $this->delete("/saved/{$savedTrip->id}");
        $deleteResponse->assertRedirect('/saved');
        $this->assertDatabaseMissing('saved_trips', ['id' => $savedTrip->id]);
    }
}
