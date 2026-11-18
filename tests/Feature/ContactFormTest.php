<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_page_renders_successfully(): void
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
        $response->assertSee('Contact Pearl Trails');
        $response->assertSee('We reply within 2 working days.');
        $response->assertDontSee('pearltrailsug@gmail.com');
    }

    public function test_user_can_submit_contact_message(): void
    {
        $payload = [
            'name'    => 'Sarah Namubiru',
            'email'   => 'sarah@example.com',
            'subject' => 'Gorilla Safari Inquiry',
            'message' => 'Hello, I would like to inquire about Bwindi permits.',
        ];

        $response = $this->post('/contact', $payload);

        $response->assertRedirect('/contact');
        $response->assertSessionHas('contact_success');

        $this->assertDatabaseHas('contact_messages', [
            'email'   => 'sarah@example.com',
            'subject' => 'Gorilla Safari Inquiry',
        ]);
    }

    public function test_contact_form_requires_valid_fields(): void
    {
        $response = $this->post('/contact', []);
        $response->assertSessionHasErrors(['name', 'email', 'subject', 'message']);
    }

    public function test_contact_details_render_when_configured(): void
    {
        config([
            'site.email'    => 'safaris@pearl-trails.test',
            'site.phone'    => '+256 772 000 111',
            'site.whatsapp' => '+256772000111',
            'site.address'  => 'Plot 12 Kimathi Avenue, Kampala',
            'site.hours'    => 'Mon – Fri: 8:00 AM – 5:00 PM',
        ]);

        $response = $this->get('/contact');
        $response->assertStatus(200);
        $response->assertSee('safaris@pearl-trails.test');
        $response->assertSee('+256 772 000 111');
        $response->assertSee('Chat on WhatsApp');
        $response->assertSee('https://wa.me/256772000111', false);
        $response->assertSee('Plot 12 Kimathi Avenue, Kampala');
        $response->assertSee('Mon – Fri: 8:00 AM – 5:00 PM');
    }

    public function test_contact_details_are_hidden_when_empty(): void
    {
        config([
            'site.email'    => null,
            'site.phone'    => null,
            'site.whatsapp' => null,
            'site.address'  => null,
            'site.hours'    => null,
        ]);

        $response = $this->get('/contact');
        $response->assertStatus(200);
        $response->assertDontSee('mailto:');
        $response->assertDontSee('Chat on WhatsApp');
        $response->assertDontSee('https://wa.me');
        $response->assertDontSee('Hours');
    }
}
