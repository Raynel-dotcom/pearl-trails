<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class AdminListingController extends Controller
{
    /**
     * Moderation dashboard to list all listings.
     */
    public function index(Request $request)
    {
        $status = $request->status;
        $query = Listing::with(['user', 'destination', 'activities'])->latest();

        if ($status && in_array($status, ['pending', 'approved', 'rejected'], true)) {
            $query->where('status', $status);
        }

        $listings = $query->paginate(20);

        return view('admin.listings', compact('listings', 'status'));
    }

    /**
     * Approve listing.
     */
    public function approve(Listing $listing)
    {
        $listing->update(['status' => 'approved']);
        return redirect()->back()->with('success', "Listing '{$listing->name}' has been approved!");
    }

    /**
     * Reject listing.
     */
    public function reject(Listing $listing)
    {
        $listing->update(['status' => 'rejected']);
        return redirect()->back()->with('success', "Listing '{$listing->name}' has been rejected.");
    }

    /**
     * Delete listing.
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();
        return redirect()->back()->with('success', "Listing '{$listing->name}' has been permanently deleted.");
    }
}
