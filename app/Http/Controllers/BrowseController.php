<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Listing;
use App\Models\Place;
use App\Services\CostService;
use App\Services\CurrencyService;
use Illuminate\Http\Request;

class BrowseController extends Controller
{
    public function __construct(
        protected CurrencyService $currencyService,
        protected CostService $costService
    ) {}

    /**
     * Stays browse page.
     */
    public function stays(Request $request)
    {
        return $this->renderBrowsePage('stay', 'Where to Stay in Uganda', 'Find eco-lodges, safari camps, and backpacker hostels across Uganda.', $request);
    }

    /**
     * Eat browse page.
     */
    public function eat(Request $request)
    {
        return $this->renderBrowsePage('eat', 'Where to Eat in Uganda', 'Discover authentic local dining spots, cafes, and restaurants with typical spends.', $request);
    }

    /**
     * Recreation browse page.
     */
    public function recreation(Request $request)
    {
        return $this->renderBrowsePage('recreation', 'Recreation & Fun Activities', 'Explore activity centres, boat tours, cultural experiences, and community adventures.', $request);
    }

    /**
     * Shared render logic for Stays, Eat, and Recreation.
     */
    protected function renderBrowsePage(string $category, string $title, string $subtitle, Request $request)
    {
        $destinations = Destination::orderBy('name')->get();
        $selectedDestinationId = $request->destination ? (int) $request->destination : null;
        $maxPriceUgx = $request->max_price ? (int) $request->max_price : null;
        $search = $request->filled('q') ? trim($request->q) : null;

        // 1. Fetch Places
        $placesQuery = Place::with('destination')->where('category', $category);
        if ($selectedDestinationId) {
            $placesQuery->where('destination_id', $selectedDestinationId);
        }
        if ($maxPriceUgx) {
            $placesQuery->where('price_ugx', '<=', $maxPriceUgx);
        }
        if ($search) {
            $placesQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        $places = $placesQuery->get();

        // 2. Fetch approved vendor listings for this category
        $listingTypeMap = [
            'stay' => ['Hotel', 'Lodge', 'Hostel'],
            'eat'  => ['Restaurant'],
            'recreation' => ['Recreation centre', 'Tourist site'],
        ];

        $allowedTypes = $listingTypeMap[$category] ?? [];
        $listingsQuery = Listing::with(['destination', 'activities'])
            ->where('status', 'approved')
            ->whereIn('type', $allowedTypes);

        if ($selectedDestinationId) {
            $listingsQuery->where(function ($q) use ($selectedDestinationId) {
                $q->where('destination_id', $selectedDestinationId)
                  ->orWhereNull('destination_id');
            });
        }
        if ($maxPriceUgx) {
            $listingsQuery->where('price_ugx', '<=', $maxPriceUgx);
        }
        if ($search) {
            $listingsQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('custom_location', 'like', "%{$search}%");
            });
        }
        $listings = $listingsQuery->get();

        // 3. Normalize items into a unified card collection
        $items = collect();

        foreach ($places as $place) {
            $items->push([
                'id' => 'place_' . $place->id,
                'name' => $place->name,
                'destination_name' => $place->destination->name ?? 'Uganda',
                'destination_id' => $place->destination_id,
                'type' => $place->type ?? ucfirst($category),
                'price_ugx' => $place->price_ugx,
                'unit' => $place->unit,
                'is_community' => false,
                'image_path' => $place->image_path ?: $this->resolveFallbackImage($place->category, $place->name),
                'website' => null,
                'activities' => [],
                'description' => $place->description,
            ]);
        }

        foreach ($listings as $listing) {
            $unit = match($category) {
                'stay' => 'night',
                'eat' => 'meal',
                default => 'person',
            };

            $destName = $listing->destination->name ?? ($listing->custom_location ?? 'Uganda');

            $items->push([
                'id' => 'listing_' . $listing->id,
                'name' => $listing->name,
                'destination_name' => $destName,
                'destination_id' => $listing->destination_id,
                'type' => $listing->type,
                'price_ugx' => $listing->price_ugx,
                'unit' => $unit,
                'is_community' => true,
                'image_path' => $listing->image_path ?: $this->resolveFallbackImage($category, $listing->name),
                'website' => $listing->website,
                'activities' => $listing->activities,
                'description' => $listing->description,
            ]);
        }

        // Sort cheapest first
        $items = $items->sortBy('price_ugx')->values();

        // 4. Calculate Quiz Fit Rules
        $quiz = session('quiz');
        $quizTaken = !empty($quiz);
        $budgetUgx = $quiz['budget_ugx'] ?? 500000;
        $days = isset($quiz['days']) ? $this->costService->resolveDays($quiz['days']) : 3;
        $nights = max(1, $days - 1);

        $fitThreshold = match($category) {
            'stay' => ($budgetUgx * 0.40) / $nights,
            'eat'  => ($budgetUgx * 0.25) / max(1, $days),
            'recreation' => $budgetUgx * 0.20,
            default => 100000,
        };

        $items = $items->map(function ($item) use ($quizTaken, $fitThreshold) {
            $item['fits_plan'] = $quizTaken ? ($item['price_ugx'] <= $fitThreshold) : false;
            return $item;
        });

        // 5. "Your picks" bar
        $picks = session('user_picks', [
            'stay' => null,
            'eat' => null,
            'recreation' => null,
        ]);

        $picksTotal = 0;
        if (!empty($picks['stay'])) $picksTotal += $picks['stay']['price_ugx'] * $nights;
        if (!empty($picks['eat'])) $picksTotal += $picks['eat']['price_ugx'] * $days;
        if (!empty($picks['recreation'])) $picksTotal += $picks['recreation']['price_ugx'];

        $currentCurrency = $this->currencyService->getUserCurrency();

        return view('pages.browse', compact(
            'category',
            'title',
            'subtitle',
            'items',
            'destinations',
            'selectedDestinationId',
            'maxPriceUgx',
            'quizTaken',
            'picks',
            'picksTotal',
            'currentCurrency'
        ));
    }

    /**
     * Save pick in session.
     */
    public function savePick(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|in:stay,eat,recreation',
            'name' => 'required|string',
            'price_ugx' => 'required|integer',
        ]);

        $picks = session('user_picks', [
            'stay' => null,
            'eat' => null,
            'recreation' => null,
        ]);

        $picks[$validated['category']] = [
            'name' => $validated['name'],
            'price_ugx' => $validated['price_ugx'],
        ];

        session(['user_picks' => $picks]);

        return redirect()->back()->with('success', "Updated your pick for {$validated['category']}!");
    }

    /**
     * Resolve fallback cover image if item has no explicit image_path.
     */
    protected function resolveFallbackImage(string $category, string $name = ''): string
    {
        $hotelImages = [
            'images/hotels/hotel-cottages-pool.webp',
            'images/hotels/hotel-room-canopy-bed.webp',
            'images/hotels/igongo-country-hotel.webp',
            'images/hotels/ishasha-wilderness-camp.webp',
            'images/hotels/kyaninga-lodge-aerial.webp',
            'images/hotels/kyaninga-lodge-room.webp',
        ];

        $restaurantImages = [
            'images/restaurants/asian-fusion-restaurant.webp',
            'images/restaurants/cafe-javas.webp',
            'images/restaurants/la-cabana-restaurant.webp',
            'images/restaurants/mediterraneo-restaurant-kampala.webp',
            'images/restaurants/piato-restaurant.webp',
            'images/restaurants/the-lawns-restaurant.webp',
            'images/restaurants/ugandan-food-platter.webp',
        ];

        $recreationImages = [
            'images/recreation centres/Forest-park-resort-Buloba-1.webp',
            'images/recreation centres/Kavumba-Recreation-Center-Kids-Park-Wakiso-Uganda-TortoisePathcom-1.webp',
            'images/recreation centres/horseback-riding-spots-kampala.webp',
            'images/recreation centres/jinja-qaud-biking-1024x678-1.webp',
        ];

        $hash = abs(crc32($name));

        return match ($category) {
            'stay' => $hotelImages[$hash % count($hotelImages)],
            'eat' => $restaurantImages[$hash % count($restaurantImages)],
            default => $recreationImages[$hash % count($recreationImages)],
        };
    }
}
