<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Services\CostService;
use App\Services\CurrencyService;
use App\Services\RecommendationService;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function __construct(
        protected CostService $costService,
        protected RecommendationService $recommendationService,
        protected CurrencyService $currencyService
    ) {}

    /**
     * Destinations listing page with server-side filters.
     */
    public function index(Request $request)
    {
        $query = Destination::query();

        // Search Keyword
        if ($request->filled('q')) {
            $term = trim($request->q);
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', "%{$term}%")
                  ->orWhere('description', 'like', "%{$term}%")
                  ->orWhere('region', 'like', "%{$term}%");
            });
        }

        // Filter: Region
        if ($request->filled('region')) {
            $query->where('region', $request->region);
        }

        // Filter: Duration
        if ($request->filled('duration')) {
            $days = (int) $request->duration;
            $query->where('min_days', '<=', $days)
                  ->where('max_days', '>=', $days);
        }

        // Filter: Interest
        if ($request->filled('interest')) {
            $interest = $request->interest;
            $query->whereJsonContains('interests', $interest);
        }

        // Filter: Style
        if ($request->filled('style')) {
            $style = $request->style;
            $query->whereJsonContains('styles', $style);
        }

        // Filter: Group
        if ($request->filled('group')) {
            $group = $request->group;
            $query->whereJsonContains('groups', $group);
        }

        $destinations = $query->orderBy('name')->get();

        // Filter: Budget (from)
        if ($request->filled('budget_band')) {
            $budgetUgx = $this->currencyService->resolveBandToUgx($request->budget_band);
            $destinations = $destinations->filter(function ($dest) use ($budgetUgx) {
                return $dest->estimated_cost_from_kampala <= $budgetUgx;
            });
        }

        $regions = config('explore.regions', []);
        $interests = config('explore.interests', []);
        $styles = config('explore.styles', []);
        $groups = config('explore.groups', []);
        $timeOptions = config('explore.time_options', []);
        $currentCurrency = $this->currencyService->getUserCurrency();
        $budgetBands = $this->currencyService->getBudgetBands($currentCurrency);

        return view('pages.destinations', compact(
            'destinations',
            'regions',
            'interests',
            'styles',
            'groups',
            'timeOptions',
            'budgetBands',
            'currentCurrency'
        ));
    }

    /**
     * Explore by Interest page presets the interest filter.
     */
    public function exploreByInterest(string $interest = 'Wildlife')
    {
        $request = request();
        $request->merge(['interest' => ucfirst($interest)]);
        return $this->index($request);
    }

    /**
     * Destination / Trip Detail page.
     */
    public function show(string $slug)
    {
        $destination = Destination::with(['places', 'listings' => function ($q) {
            $q->where('status', 'approved')->with('activities');
        }])->where('slug', $slug)->firstOrFail();

        $quiz = session('quiz');
        $origin = $quiz['origin'] ?? 'Kampala';
        $days = isset($quiz['days']) ? $this->costService->resolveDays($quiz['days']) : $destination->rec_days;
        $style = $quiz['style'] ?? 'Moderate';
        $group = $quiz['group'] ?? 'Couple';
        $selectedInterests = $quiz['interests'] ?? ($destination->interests ?? []);
        $preference = $quiz['preference'] ?? ($destination->preferred_trip_types[0] ?? 'Adventurous');
        $budgetUgx = $quiz['budget_ugx'] ?? 500000;

        // Cost breakdown for this destination
        $costData = $this->costService->calculateCost($origin, $destination, $days, $style);

        // Scores and match
        $scores = $this->recommendationService->calculateScores(
            $destination,
            $costData,
            $budgetUgx,
            $days,
            $group,
            $style,
            $selectedInterests,
            $preference
        );
        $matchScore = (int) round(array_sum($scores));
        $matchScore = max(0, min(100, $matchScore));

        // Cheaper alternative if over budget
        $cheaperAlternative = null;
        if ($costData['total'] > $budgetUgx) {
            $cheaper = Destination::where('id', '!=', $destination->id)->get()->filter(function ($other) use ($origin, $days, $style, $budgetUgx) {
                $c = $this->costService->calculateCost($origin, $other, $days, $style);
                return $c['total'] <= $budgetUgx;
            })->first();

            if ($cheaper) {
                $cheaperAlternative = [
                    'destination' => $cheaper,
                    'cost' => $this->costService->calculateCost($origin, $cheaper, $days, $style),
                ];
            }
        }

        // Places near X (up to 4 options, cheapest first)
        $stays = $destination->places->where('category', 'stay')->sortBy('price_ugx')->take(4);
        $eatPlaces = $destination->places->where('category', 'eat')->sortBy('price_ugx')->take(4);
        $recreationPlaces = $destination->places->where('category', 'recreation')->sortBy('price_ugx')->take(4);
        $visitPlaces = $destination->places->where('category', 'visit')->sortBy('price_ugx');

        // Approved vendor listings near destination
        $approvedListings = $destination->listings;

        // Approved Tourist sites and Recreation centres for ticks
        $vendorVisits = $approvedListings->where('type', 'Tourist site');
        $vendorRecs = $approvedListings->where('type', 'Recreation centre');

        $currentCurrency = $this->currencyService->getUserCurrency();

        return view('pages.detail', compact(
            'destination',
            'costData',
            'scores',
            'matchScore',
            'quiz',
            'days',
            'style',
            'group',
            'origin',
            'budgetUgx',
            'cheaperAlternative',
            'stays',
            'eatPlaces',
            'recreationPlaces',
            'visitPlaces',
            'vendorVisits',
            'vendorRecs',
            'currentCurrency'
        ));
    }
}
