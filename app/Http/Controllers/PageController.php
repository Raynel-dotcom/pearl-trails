<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Place;
use App\Services\CurrencyService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct(
        protected CurrencyService $currencyService
    ) {}

    /**
     * Display the Home page.
     */
    public function home()
    {
        // 5 Preview Destinations specified in the design brief
        $previewSlugs = ['bwindi-impenetrable-np', 'bwindi', 'murchison-falls-np', 'jinja', 'sipi-falls', 'lake-bunyonyi'];
        $popularDestinations = Destination::whereIn('slug', $previewSlugs)
            ->get()
            ->sortBy(function ($dest) use ($previewSlugs) {
                return array_search($dest->slug, $previewSlugs);
            });

        // If 'bwindi' slug was used in seeders vs 'bwindi-impenetrable-np'
        if ($popularDestinations->count() < 5) {
            $popularDestinations = Destination::take(5)->get();
        }

        $allDestinations = Destination::all();

        // Recreation places for the discovery section
        $recreationStrip = Place::with('destination')
            ->where('category', 'recreation')
            ->take(8)
            ->get();

        // Featured stays across luxury, moderate, and budget
        $featuredStays = Place::with('destination')
            ->where('category', 'stay')
            ->whereIn('name', [
                'Lemala Wildwaters Lodge',
                'Haven Eco River Lodge',
                'Kyaninga Lodge',
                'Bwindi Lodge by Volcanoes Safaris',
                'Mihingo Safari Lodge',
                'BirdNest Resort @ Lake Bunyonyi',
                'Bushpig Backpackers Hostel Kololo',
                'Rwenzori Trekkers Hostel & Cottages'
            ])
            ->take(6)
            ->get();

        if ($featuredStays->isEmpty()) {
            $featuredStays = Place::with('destination')->where('category', 'stay')->take(6)->get();
        }

        $interestChips = ['Wildlife', 'Adventure', 'Culture', 'Nature', 'Relaxation', 'Food'];

        $experiences = [
            [
                'title' => 'Mountain Gorilla Trekking',
                'tag' => 'Once In A Lifetime',
                'desc' => 'Trek through the misty ancient rainforest of Bwindi to spend an awe-inspiring hour with wild mountain gorilla families.',
                'image' => 'images/destinations/bwindi-gorilla-1.webp',
                'interest' => 'Wildlife',
                'destination_slug' => 'bwindi',
            ],
            [
                'title' => 'Big Five Savannah Safaris',
                'tag' => 'Savannah Wildlife',
                'desc' => 'Witness lions lounging in fig trees, herds of elephants roaming Murchison Nile banks, and leopards tracking at dusk.',
                'image' => 'images/destinations/boat-cruise-elephants.webp',
                'interest' => 'Wildlife',
                'destination_slug' => 'murchison-falls-np',
            ],
            [
                'title' => 'White-Water Rafting the Nile',
                'tag' => 'Extreme Adventure',
                'desc' => 'Conquer the roaring Grade 5 rapids of the legendary River Nile in Jinja with world-class river safety guides.',
                'image' => 'images/destinations/jinja-quad-biking.webp',
                'interest' => 'Adventure',
                'destination_slug' => 'jinja',
            ],
            [
                'title' => 'Sipi Triple Waterfalls & Coffee',
                'tag' => 'Highland Nature',
                'desc' => 'Hike along three dramatic volcanic cascades on Mount Elgon and brew fresh Arabica with local indigenous farmers.',
                'image' => 'images/destinations/sipi-falls-3.webp',
                'interest' => 'Nature',
                'destination_slug' => 'sipi-falls',
            ],
            [
                'title' => 'Island Canoeing & Relaxation',
                'tag' => 'Serene Lakes',
                'desc' => 'Glide across 29 emerald islands in Lake Bunyonyi on traditional dugout canoes beneath misty terraced hillsides.',
                'image' => 'images/destinations/lake-bunyonyi-view.webp',
                'interest' => 'Relaxation',
                'destination_slug' => 'lake-bunyonyi',
            ],
            [
                'title' => 'Chimpanzee Tracking & Primates',
                'tag' => 'Primate Haven',
                'desc' => 'Follow vocal chimpanzee troops through the sunken forest of Kyambura Gorge and ancient ironwood groves of Budongo.',
                'image' => 'images/destinations/chimpanzee-trekking.webp',
                'interest' => 'Nature',
                'destination_slug' => 'queen-elizabeth-np',
            ],
        ];

        $currentCurrency = $this->currencyService->getUserCurrency();
        $budgetBands = $this->currencyService->getBudgetBands($currentCurrency);

        return view('pages.home', compact(
            'popularDestinations',
            'allDestinations',
            'recreationStrip',
            'featuredStays',
            'interestChips',
            'experiences',
            'budgetBands',
            'currentCurrency'
        ));
    }

    /**
     * Display the About page.
     */
    public function about()
    {
        return view('pages.about');
    }

    /**
     * Display the Contact page.
     */
    public function contact()
    {
        return view('pages.contact');
    }

    /**
     * Display Travel Guide.
     */
    public function guide()
    {
        return view('pages.guide');
    }

    /**
     * Display Privacy Policy.
     */
    public function privacy()
    {
        return view('pages.privacy');
    }

    /**
     * Display Terms of Service.
     */
    public function terms()
    {
        return view('pages.terms');
    }
}
