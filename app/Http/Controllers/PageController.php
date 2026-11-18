<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\HeroSlide;
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
     * Sections in order:
     * 1. Hero ("Your Uganda. Your Budget. Your Adventure.")
     * 2. How It Works (3 steps)
     * 3. Popular Destinations (Jinja, Murchison, Bwindi, Sipi, Bunyonyi, Ssese)
     * 4. Recreation Centres strip with a button to the Recreation page
     * 5. Explore by Interest chips (Wildlife, Adventure, Culture, Nature, Relaxation, Food)
     * 6. Budget Explorer tiles
     * 7. Why Use Explore Uganda
     */
    public function home()
    {
        $popularSlugs = ['jinja', 'murchison-falls-np', 'bwindi', 'sipi-falls', 'lake-bunyonyi', 'ssese-islands'];
        $popularDestinations = Destination::whereIn('slug', $popularSlugs)
            ->get()
            ->sortBy(function ($dest) use ($popularSlugs) {
                return array_search($dest->slug, $popularSlugs);
            });

        $recreationStrip = Place::with('destination')
            ->where('category', 'recreation')
            ->inRandomOrder()
            ->take(6)
            ->get();

        $interestChips = ['Wildlife', 'Adventure', 'Culture', 'Nature', 'Relaxation', 'Food'];

        $currentCurrency = $this->currencyService->getUserCurrency();
        $budgetBands = $this->currencyService->getBudgetBands($currentCurrency);

        $heroSlides = HeroSlide::where('is_active', true)->orderBy('order')->get();
        if ($heroSlides->isEmpty()) {
            $heroSlides = collect([
                (object)[
                    'image_path' => 'images/hero/hero-gorilla.webp',
                    'title' => 'Discover Uganda. / Feel Alive.',
                    'subtitle' => 'From mist-covered mountains and breathtaking wildlife to hidden lakes and unforgettable adventures.',
                    'link' => '/destinations',
                ],
                (object)[
                    'image_path' => 'images/hero/hero-falls.webp',
                    'title' => 'Murchison Falls. / Untamed Power.',
                    'subtitle' => 'Witness the world\'s most powerful waterfall where the Nile crashes through a 7-meter gorge.',
                    'link' => '/destinations/murchison-falls-np',
                ],
                (object)[
                    'image_path' => 'images/hero/hero-bunyonyi.webp',
                    'title' => 'Lake Bunyonyi. / Sacred Tranquility.',
                    'subtitle' => 'Glide across 29 emerald islands enveloped by the terraced hills of southwestern Uganda.',
                    'link' => '/destinations/lake-bunyonyi',
                ],
                (object)[
                    'image_path' => 'images/hero/hero-savanna.webp',
                    'title' => 'Golden Savannah. / Endless Horizons.',
                    'subtitle' => 'Experience untamed wildlife under breathtaking African sunsets across vast wilderness expanses.',
                    'link' => '/destinations/kidepo-valley',
                ],
                (object)[
                    'image_path' => 'images/hero/hero-sipi.webp',
                    'title' => 'Sipi Falls. / Majestic Cascades.',
                    'subtitle' => 'Trek the legendary triple waterfalls on the lush slopes of volcanic Mount Elgon.',
                    'link' => '/destinations/sipi-falls',
                ],
            ]);
        }

        $destinationsCount = Destination::count();
        $placesToStayCount = Place::where('category', 'stay')->count();
        $experiencesCount = Place::whereIn('category', ['recreation', 'visit'])->count();
        $hasExperienceVideo = !empty(config('app.experience_video')) && file_exists(public_path(config('app.experience_video')));

        return view('pages.home', compact(
            'popularDestinations',
            'recreationStrip',
            'interestChips',
            'budgetBands',
            'currentCurrency',
            'heroSlides',
            'destinationsCount',
            'placesToStayCount',
            'experiencesCount',
            'hasExperienceVideo'
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
