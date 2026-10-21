<?php

namespace Tests\Feature;

use App\Models\Destination;
use App\Services\CostService;
use App\Services\CurrencyService;
use App\Services\RecommendationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServicesCalculationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_cost_service_calculates_breakdown_correctly(): void
    {
        $costService = app(CostService::class);
        $jinja = Destination::where('slug', 'jinja')->firstOrFail();

        $cost = $costService->calculateCost('Kampala', $jinja, 3, 'Moderate');

        $this->assertArrayHasKey('dist_km', $cost);
        $this->assertArrayHasKey('hours', $cost);
        $this->assertArrayHasKey('transport', $cost);
        $this->assertArrayHasKey('accommodation', $cost);
        $this->assertArrayHasKey('food', $cost);
        $this->assertArrayHasKey('activities', $cost);
        $this->assertArrayHasKey('misc', $cost);
        $this->assertArrayHasKey('total', $cost);

        $this->assertEquals(3, $cost['days']);
        $this->assertEquals(2, $cost['nights']);
        $this->assertEquals('Moderate', $cost['style']);

        // Check accommodation = 2 nights * 150000 = 300000
        $this->assertEquals(300000, $cost['accommodation']);
        // Check food = 35000 * 1.0 * 3 = 105000
        $this->assertEquals(105000, $cost['food']);
        // Total should be positive and greater than sum of components
        $this->assertGreaterThan(500000, $cost['total']);
    }

    public function test_recommendation_service_with_specified_inputs(): void
    {
        $recService = app(RecommendationService::class);

        // Specified inputs: origin Kampala, Moderate style, budget 500,000, 3 days, Friends, interests Adventure & Nature, preference Adventurous
        $result = $recService->getRecommendations([
            'origin' => 'Kampala',
            'style' => 'Moderate',
            'budget_ugx' => 500000,
            'days' => 3,
            'group' => 'Friends',
            'interests' => ['Adventure', 'Nature'],
            'preference' => 'Adventurous',
        ]);

        $this->assertCount(3, $result['top_recommendations']);
        $all = collect($result['all_recommendations']);

        $jinjaRec = $all->firstWhere('destination.slug', 'jinja');
        $sipiRec = $all->firstWhere('destination.slug', 'sipi-falls');
        $murchisonRec = $all->firstWhere('destination.slug', 'murchison-falls-np');

        $this->assertNotNull($jinjaRec);
        $this->assertNotNull($sipiRec);
        $this->assertNotNull($murchisonRec);

        // Verify each has score between 0 and 100
        $this->assertGreaterThan(0, $jinjaRec['score']);
        $this->assertLessThanOrEqual(100, $jinjaRec['score']);
        $this->assertGreaterThan(0, $sipiRec['score']);
        $this->assertLessThanOrEqual(100, $sipiRec['score']);
        $this->assertGreaterThan(0, $murchisonRec['score']);
        $this->assertLessThanOrEqual(100, $murchisonRec['score']);

        // Assert 6 sub-scores exist
        $this->assertArrayHasKey('budget', $jinjaRec['sub_scores']);
        $this->assertArrayHasKey('interests', $jinjaRec['sub_scores']);
        $this->assertArrayHasKey('time', $jinjaRec['sub_scores']);
        $this->assertArrayHasKey('distance', $jinjaRec['sub_scores']);
        $this->assertArrayHasKey('group', $jinjaRec['sub_scores']);
        $this->assertArrayHasKey('style', $jinjaRec['sub_scores']);
    }

    public function test_currency_service_rounding_and_bands(): void
    {
        $currService = app(CurrencyService::class);

        // UGX rounding to nearest 5,000
        $this->assertEquals(50000, $currService->roundCurrency(49200, 'UGX'));
        $this->assertEquals(45000, $currService->roundCurrency(46000, 'UGX'));

        // USD rounding: <10 to nearest 1, >=10 to nearest 5
        $this->assertEquals(7, $currService->roundCurrency(6.8, 'USD'));
        $this->assertEquals(25, $currService->roundCurrency(23.4, 'USD'));
        $this->assertEquals(105, $currService->roundCurrency(103.8, 'USD'));

        // Format checks
        $this->assertStringContainsString('UGX', $currService->format(50000, 'UGX'));
        $this->assertStringContainsString('$', $currService->format(365000, 'USD'));

        // Budget bands check
        $bandsUgx = $currService->getBudgetBands('UGX');
        $this->assertCount(5, $bandsUgx);
        $bandsUsd = $currService->getBudgetBands('USD');
        $this->assertCount(5, $bandsUsd);
    }
}
