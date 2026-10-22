@extends('layouts.app')
@section('title', 'Vendor Dashboard - My Pearl Trails Listings')

@section('content')
<div class="vendor-dashboard-container">
    <div class="dashboard-header-flex">
        <div>
            <span class="quiz-badge">Vendor Portal</span>
            <h1>Manage Your Business Listings</h1>
            <p>Track your submissions, moderation status, and public tourist visibility.</p>
        </div>
        <div>
            <a href="{{ route('list-business') }}" class="btn btn-gold">
                + Add New Listing
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert-success-banner">
            <span>✓ {{ session('success') }}</span>
        </div>
    @endif

    @if($listings->isEmpty())
        <div class="empty-state-card">
            <div class="empty-icon-wrap">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
            </div>
            <h3>No business listings found</h3>
            <p>You haven't submitted any listings yet. Showcase your hotel, restaurant, or activity center to tourists!</p>
            <a href="{{ route('list-business') }}" class="btn btn-gold">List Your First Business</a>
        </div>
    @else
        <div class="vendor-listings-table-wrapper">
            <table class="dashboard-table">
                <thead>
                    <tr>
                        <th>Business Name</th>
                        <th>Type</th>
                        <th>Location</th>
                        <th>Price (UGX)</th>
                        <th>Activities</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listings as $listing)
                        <tr>
                            <td>
                                <strong>{{ $listing->name }}</strong>
                                @if($listing->website)
                                    <br><a href="{{ $listing->website }}" target="_blank" class="small-link">Website ↗</a>
                                @endif
                            </td>
                            <td><span class="type-pill">{{ $listing->type }}</span></td>
                            <td>{{ $listing->destination->name ?? ($listing->custom_location ?? 'Uganda') }}</td>
                            <td>@price($listing->price_ugx)</td>
                            <td>{{ $listing->activities->count() }} activities</td>
                            <td>
                                @if($listing->status === 'approved')
                                    <span class="badge-status-approved">✓ Approved</span>
                                @elseif($listing->status === 'pending')
                                    <span class="badge-status-pending">⏳ Pending Review</span>
                                @else
                                    <span class="badge-status-rejected">✕ Rejected</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons-flex">
                                    <a href="{{ route('vendor.listings.edit', $listing->id) }}" class="btn btn-sm btn-outline">
                                        Edit
                                    </a>
                                    <form action="{{ route('vendor.listings.destroy', $listing->id) }}" method="POST" onsubmit="return confirm('Delete this listing?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
