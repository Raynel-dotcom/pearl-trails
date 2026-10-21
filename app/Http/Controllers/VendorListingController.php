<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Listing;
use App\Models\ListingActivity;
use Illuminate\Http\Request;

class VendorListingController extends Controller
{
    /**
     * Show the "List Your Business" vendor registration form.
     */
    public function create()
    {
        $destinations = Destination::orderBy('name')->get();
        $listingTypes = config('explore.listing_types', [
            'Hotel', 'Lodge', 'Hostel', 'Restaurant', 'Tourist site', 'Recreation centre'
        ]);

        return view('pages.list-business', compact('destinations', 'listingTypes'));
    }

    /**
     * Store a vendor submission as pending.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:Hotel,Lodge,Hostel,Restaurant,Tourist site,Recreation centre',
            'name' => 'required|string|max:255',
            'destination_id' => 'nullable|exists:destinations,id',
            'custom_location' => 'nullable|string|max:255',
            'price_ugx' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'website' => ['nullable', 'regex:/^https?:\/\/.+/i'],
            'contact' => 'required|string|max:255',
            'activities' => 'nullable|array',
            'activities.*.name' => 'nullable|string|max:255',
            'activities.*.fee_ugx' => 'nullable|integer|min:0',
        ], [
            'website.regex' => 'Website URL must begin with http:// or https://',
        ]);

        $user = auth()->user();
        if ($user && $user->role === 'visitor') {
            $user->update(['role' => 'vendor']);
        }

        $listing = Listing::create([
            'user_id' => auth()->id(),
            'type' => $validated['type'],
            'name' => $validated['name'],
            'destination_id' => !empty($validated['destination_id']) ? $validated['destination_id'] : null,
            'custom_location' => $validated['custom_location'] ?? null,
            'price_ugx' => $validated['price_ugx'],
            'description' => $validated['description'] ?? null,
            'website' => $validated['website'] ?? null,
            'contact' => $validated['contact'],
            'status' => 'pending',
        ]);

        if (!empty($validated['activities'])) {
            foreach ($validated['activities'] as $act) {
                if (!empty($act['name'])) {
                    ListingActivity::create([
                        'listing_id' => $listing->id,
                        'name' => $act['name'],
                        'fee_ugx' => (int) ($act['fee_ugx'] ?? 0),
                    ]);
                }
            }
        }

        return redirect()->route('vendor.listings')
            ->with('success', 'Your business has been submitted successfully and is currently under review by our team!');
    }

    /**
     * Vendor dashboard to view own listings.
     */
    public function index()
    {
        $listings = Listing::with(['destination', 'activities'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('vendor.dashboard', compact('listings'));
    }

    /**
     * Edit own listing.
     */
    public function edit(Listing $listing)
    {
        if ($listing->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $destinations = Destination::orderBy('name')->get();
        $listingTypes = config('explore.listing_types', [
            'Hotel', 'Lodge', 'Hostel', 'Restaurant', 'Tourist site', 'Recreation centre'
        ]);

        return view('vendor.edit', compact('listing', 'destinations', 'listingTypes'));
    }

    /**
     * Update own listing.
     */
    public function update(Request $request, Listing $listing)
    {
        if ($listing->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'type' => 'required|in:Hotel,Lodge,Hostel,Restaurant,Tourist site,Recreation centre',
            'name' => 'required|string|max:255',
            'destination_id' => 'nullable|exists:destinations,id',
            'custom_location' => 'nullable|string|max:255',
            'price_ugx' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'website' => ['nullable', 'regex:/^https?:\/\/.+/i'],
            'contact' => 'required|string|max:255',
            'activities' => 'nullable|array',
            'activities.*.name' => 'nullable|string|max:255',
            'activities.*.fee_ugx' => 'nullable|integer|min:0',
        ]);

        $listing->update([
            'type' => $validated['type'],
            'name' => $validated['name'],
            'destination_id' => !empty($validated['destination_id']) ? $validated['destination_id'] : null,
            'custom_location' => $validated['custom_location'] ?? null,
            'price_ugx' => $validated['price_ugx'],
            'description' => $validated['description'] ?? null,
            'website' => $validated['website'] ?? null,
            'contact' => $validated['contact'],
            'status' => 'pending', // Re-verify on edit
        ]);

        // Re-sync activities
        $listing->activities()->delete();
        if (!empty($validated['activities'])) {
            foreach ($validated['activities'] as $act) {
                if (!empty($act['name'])) {
                    ListingActivity::create([
                        'listing_id' => $listing->id,
                        'name' => $act['name'],
                        'fee_ugx' => (int) ($act['fee_ugx'] ?? 0),
                    ]);
                }
            }
        }

        return redirect()->route('vendor.listings')->with('success', 'Listing updated and submitted for moderation.');
    }

    /**
     * Delete own listing.
     */
    public function destroy(Listing $listing)
    {
        if ($listing->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $listing->delete();

        return redirect()->route('vendor.listings')->with('success', 'Listing deleted.');
    }
}
