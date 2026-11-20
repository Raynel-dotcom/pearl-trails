<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the comprehensive user account & member dashboard.
     */
    public function dashboard(Request $request): View
    {
        $user = $request->user();

        $savedTrips = \App\Models\SavedTrip::with('destination')
            ->where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                      ->orWhere('session_id', session()->getId());
            })
            ->latest()
            ->get();

        $listings = \App\Models\Listing::with(['destination', 'activities'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('pages.account', compact('user', 'savedTrips', 'listings'));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return $this->dashboard($request);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
