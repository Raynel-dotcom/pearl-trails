<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\SavedTrip;
use App\Services\CurrencyService;
use Illuminate\Http\Request;

class SavedTripController extends Controller
{
    public function __construct(
        protected CurrencyService $currencyService
    ) {}

    /**
     * Display all saved trips for current user or session.
     */
    public function index()
    {
        $userId = auth()->id();
        $sessionId = session()->getId();

        $savedTrips = SavedTrip::with('destination')
            ->when($userId, fn($q) => $q->where('user_id', $userId))
            ->when(!$userId, fn($q) => $q->where(function($sub) use ($sessionId) {
                $sub->where('session_id', $sessionId)
                    ->orWhereNull('user_id');
            }))
            ->latest()
            ->get();

        $currentCurrency = $this->currencyService->getUserCurrency();

        return view('pages.saved', compact('savedTrips', 'currentCurrency'));
    }

    /**
     * Store a trip in saved_trips.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'days' => 'required|integer|min:1',
            'style' => 'required|string',
            'total_ugx' => 'required|numeric|min:0',
            'details' => 'nullable|array',
        ]);

        $userId = auth()->id();
        $sessionId = session()->getId();

        SavedTrip::create([
            'user_id' => $userId,
            'session_id' => $sessionId,
            'destination_id' => $validated['destination_id'],
            'days' => $validated['days'],
            'style' => $validated['style'],
            'total_ugx' => (int) $validated['total_ugx'],
            'details' => $validated['details'] ?? null,
        ]);

        return redirect()->route('saved')->with('success', 'Trip plan successfully saved to your collection!');
    }

    /**
     * Remove a saved trip.
     */
    public function destroy(SavedTrip $savedTrip)
    {
        $userId = auth()->id();
        $sessionId = session()->getId();

        if ($savedTrip->user_id === $userId || $savedTrip->session_id === $sessionId) {
            $savedTrip->delete();
            return redirect()->route('saved')->with('success', 'Trip removed from saved list.');
        }

        abort(403);
    }
}
