<?php

namespace Tests\Feature;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VendorListingTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_view_list_your_business_landing(): void
    {
        $response = $this->get('/list-your-business');
        $response->assertStatus(200);
        $response->assertSee('List Your Uganda Tourism Business');
        $response->assertSee('Promote your hotel');
    }

    public function test_vendor_can_register_and_create_listing_with_activities(): void
    {
        // 1. Create a vendor user
        $vendor = User::factory()->create([
            'role' => 'vendor',
        ]);

        $this->actingAs($vendor);

        // 2. View vendor dashboard
        $response = $this->get('/vendor/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Vendor Portal');

        // 3. Submit a listing with repeatable activities
        $listingData = [
            'name' => 'Queen Elizabeth Eco Lodge',
            'type' => 'Lodge',
            'price_ugx' => 180000,
            'contact' => '+256 700 123456',
            'custom_location' => 'Kasese / Rubirizi',
            'description' => 'Spectacular views over the Kazinga channel with solar power and locally sourced meals.',
            'website' => 'https://queenelizabethlodge.example',
            'activities' => [
                [
                    'name' => 'Kazinga Boat Safari',
                    'fee_ugx' => 120000,
                ],
                [
                    'name' => 'Guided Crater Lakes Walk',
                    'fee_ugx' => 50000,
                ],
            ],
        ];

        $postResponse = $this->post('/vendor/listings', $listingData);
        $postResponse->assertRedirect(route('vendor.listings'));

        $this->assertDatabaseHas('listings', [
            'name' => 'Queen Elizabeth Eco Lodge',
            'type' => 'Lodge',
            'status' => 'pending',
            'user_id' => $vendor->id,
        ]);

        $listing = Listing::where('name', 'Queen Elizabeth Eco Lodge')->first();
        $this->assertNotNull($listing);
        $this->assertCount(2, $listing->activities);
        $this->assertEquals('Kazinga Boat Safari', $listing->activities->first()->name);

        // Pending listing should NOT be visible on public stays page yet
        $staysResponse = $this->get('/stays');
        $staysResponse->assertStatus(200);
        $staysResponse->assertDontSee('Queen Elizabeth Eco Lodge');
    }

    public function test_admin_can_approve_pending_listing_and_make_it_live(): void
    {
        $vendor = User::factory()->create(['role' => 'vendor']);
        $admin = User::factory()->create(['role' => 'admin']);

        $listing = Listing::create([
            'user_id' => $vendor->id,
            'name' => 'Bwindi Gorilla Trekkers Rest',
            'type' => 'Lodge',
            'contact' => '+256 777 000111',
            'price_ugx' => 250000,
            'status' => 'pending',
            'description' => 'Cozy rooms 5 minutes from Buhoma gate.',
        ]);

        // Regular vendor cannot access admin panel (must be forbidden 403)
        $this->actingAs($vendor);
        $this->get('/admin/listings')->assertStatus(403);

        // Admin can access admin panel
        $this->actingAs($admin);
        $adminPanel = $this->get('/admin/listings');
        $adminPanel->assertStatus(200);
        $adminPanel->assertSee('Listing Moderation');
        $adminPanel->assertSee('Bwindi Gorilla Trekkers Rest');

        // Admin approves the listing
        $approveResponse = $this->post("/admin/listings/{$listing->id}/approve");
        $approveResponse->assertRedirect();

        $listing->refresh();
        $this->assertEquals('approved', $listing->status);

        // Now approved listing appears on public stays browse page
        $staysResponse = $this->get('/stays');
        $staysResponse->assertStatus(200);
        $staysResponse->assertSee('Bwindi Gorilla Trekkers Rest');
    }
}
