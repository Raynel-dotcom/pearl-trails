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

        return view('pages.home', compact(
            'popularDestinations',
            'recreationStrip',
            'interestChips',
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
