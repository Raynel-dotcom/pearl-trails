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
}
