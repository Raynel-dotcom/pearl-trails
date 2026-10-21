<?php

namespace App\Http\Controllers;

use App\Services\CurrencyService;
use App\Services\RecommendationService;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function __construct(
        protected RecommendationService $recommendationService,
        protected CurrencyService $currencyService
    ) {}

    /**
     * Show the 7-step interactive trip planning quiz.
     */
    public function show()
    {
        $currentCurrency = $this->currencyService->getUserCurrency();
        $budgetBands = $this->currencyService->getBudgetBands($currentCurrency);
        $savedQuiz = session('quiz', []);

        $origins = array_keys(config('explore.origins', []));
        $timeOptions = array_keys(config('explore.time_options', []));
        $groups = config('explore.groups', []);
        $interests = config('explore.interests', []);
        $styles = config('explore.styles', []);
        $preferences = config('explore.preferences', []);

        return view('pages.plan', compact(
            'currentCurrency',
            'budgetBands',
            'savedQuiz',
            'origins',
            'timeOptions',
            'groups',
            'interests',
            'styles',
            'preferences'
        ));
    }

    /**
     * Store quiz submission and redirect to results.
     */
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'origin' => 'required|string',
            'budget_band' => 'required|string',
            'days' => 'required|string',
            'group' => 'required|string',
            'interests' => 'required|array|min:1',
            'interests.*' => 'string',
            'style' => 'required|string',
            'preference' => 'required|string',
        ]);

        $currency = $this->currencyService->getUserCurrency();
        $budgetUgx = $this->currencyService->resolveBandToUgx($validated['budget_band'], $currency);

        $quizData = [
            'origin' => $validated['origin'],
            'budget_band' => $validated['budget_band'],
            'budget_ugx' => $budgetUgx,
            'days' => $validated['days'],
            'group' => $validated['group'],
            'interests' => $validated['interests'],
            'style' => $validated['style'],
            'preference' => $validated['preference'],
            'currency' => $currency,
        ];

        session(['quiz' => $quizData]);

        return redirect()->route('plan.results');
    }

    /**
     * Show top 3 recommended results.
     */
    public function results()
    {
        $quiz = session('quiz');

        if (!$quiz) {
            // Default quiz parameters if directly visited
            $currency = $this->currencyService->getUserCurrency();
            $quiz = [
                'origin' => 'Kampala',
                'budget_band' => '500k',
                'budget_ugx' => 500000,
                'days' => '3 days',
                'group' => 'Friends',
                'interests' => ['Adventure', 'Nature'],
                'style' => 'Moderate',
                'preference' => 'Adventurous',
                'currency' => $currency,
            ];
            session(['quiz' => $quiz]);
        }

        $results = $this->recommendationService->getRecommendations($quiz);

        return view('pages.results', [
            'topRecommendations' => $results['top_recommendations'],
            'cheaperAlternative' => $results['cheaper_alternative'],
            'quiz' => $quiz,
            'currency' => $this->currencyService->getUserCurrency(),
        ]);
    }

    /**
     * Reset quiz and restart.
     */
    public function reset()
    {
        session()->forget('quiz');
        return redirect()->route('plan');
    }
}
