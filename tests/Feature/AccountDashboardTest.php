<?php

namespace Tests\Feature;

use App\Models\Destination;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class AccountDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_access_dashboard_and_account_views(): void
    {
        $user = User::factory()->create([
            'name' => 'Raynel Explorer',
            'email' => 'raynel.test@example.com',
            'role' => 'visitor',
        ]);

        $response = $this->actingAs($user)->get('/account');
        $response->assertStatus(200);
        $response->assertSee('Raynel Explorer');
        $response->assertSee('Travel Explorer');
        $response->assertSee('Saved Itineraries');
        $response->assertSee('+256 772 068 901');

        $dashResponse = $this->actingAs($user)->get('/dashboard');
        $dashResponse->assertStatus(200);
        $dashResponse->assertSee('Raynel Explorer');
    }

    public function test_guest_is_redirected_to_login_when_accessing_account(): void
    {
        $response = $this->get('/account');
        $response->assertRedirect('/login');
    }

    public function test_vendor_listing_supports_photo_upload(): void
    {
        $vendor = User::factory()->create([
            'role' => 'vendor',
        ]);

        $destination = Destination::create([
            'name' => 'Bwindi Impenetrable NP',
            'slug' => 'bwindi-impenetrable-np',
            'region' => 'Southwest',
            'description' => 'Home of mountain gorillas',
            'min_days' => 2,
            'max_days' => 4,
            'interests' => ['Wildlife', 'Nature'],
            'price_tier' => 'Luxury',
            'est_cost_per_day_ugx' => 500000,
            'lat' => -1.05,
            'lon' => 29.61,
        ]);

        $fakePhoto = UploadedFile::fake()->create('my-lodge.webp', 100, 'image/webp');

        $response = $this->actingAs($vendor)->post('/list-your-business', [
            'name' => 'Gorilla View Haven',
            'type' => 'Lodge',
            'destination_id' => $destination->id,
            'price_ugx' => 350000,
            'contact' => '+256772068901',
            'description' => 'Luxury eco lodge overlooking Bwindi forest.',
            'image' => $fakePhoto,
        ]);

        $response->assertRedirect(route('vendor.listings'));

        $this->assertDatabaseHas('listings', [
            'name' => 'Gorilla View Haven',
            'type' => 'Lodge',
            'price_ugx' => 350000,
            'user_id' => $vendor->id,
        ]);

        $listing = Listing::where('name', 'Gorilla View Haven')->first();
        $this->assertNotNull($listing->image_path);
        $this->assertStringContainsString('images/listings/', $listing->image_path);

        // Clean up created file
        if (File::exists(public_path($listing->image_path))) {
            File::delete(public_path($listing->image_path));
        }
    }

    public function test_registration_with_redirect_to_preserves_destination(): void
    {
        $response = $this->post('/register', [
            'name' => 'New Partner',
            'email' => 'partner@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'vendor',
            'redirect_to' => '/list-your-business',
        ]);

        $response->assertRedirect('/list-your-business');
        $this->assertAuthenticated();
    }

    public function test_contact_page_always_shows_whatsapp_and_email_with_defaults(): void
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
        $response->assertSee('natukundaraynel@gmail.com');
        $response->assertSee('+256 772 068 901');
        $response->assertSee('https://wa.me/256772068901', false);
    }
}
