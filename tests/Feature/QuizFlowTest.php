<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuizFlowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_plan_page_renders_with_quiz_form(): void
    {
        $response = $this->get('/plan');
        $response->assertStatus(200);
        $response->assertSee('Find Your Perfect Uganda Adventure');
        $response->assertSee('Where are you starting your journey from?');
    }

    public function test_quiz_submission_redirects_to_results(): void
    {
        $response = $this->post('/plan', [
            'origin' => 'Kampala',
            'budget_band' => '500k',
            'days' => '3 days',
            'group' => 'Friends',
            'interests' => ['Adventure', 'Nature'],
            'style' => 'Moderate',
            'preference' => 'Adventurous',
        ]);

        $response->assertRedirect('/plan/results');
        $this->assertNotNull(session('quiz'));

        $resultsResponse = $this->get('/plan/results');
        $resultsResponse->assertStatus(200);
        $resultsResponse->assertSee('Your Top Recommended Uganda Destinations');
    }

    public function test_quiz_reset_clears_session(): void
    {
        session(['quiz' => ['origin' => 'Kampala']]);
        $response = $this->get('/plan/reset');
        $response->assertRedirect('/plan');
        $this->assertNull(session('quiz'));
    }
}
