@extends('layouts.app')
@section('title', 'Saved Trips - Your Pearl Trails Itineraries')

@section('content')
<div class="saved-trips-container">
    <div class="page-hero">
        <span class="quiz-badge">Trip Collections</span>
        <h1>Your Saved Uganda Trips</h1>
        <p>Review and manage your bookmarked itineraries, customized budgets, and selected destinations.</p>
    </div>

    @if(session('success'))
        <div class="alert-success-banner">
            <span>✓ {{ session('success') }}</span>
        </div>
    @endif

    @if($savedTrips->isEmpty())
        <div class="empty-state-card">
            <span class="empty-icon">🗺️</span>
            <h3>No saved trips yet</h3>
            <p>Take our 7-step travel wizard or explore any of Uganda's 13 destinations and click "Save Trip" to keep track of your favorites.</p>
            <div class="empty-state-actions">
                <a href="{{ route('plan') }}" class="btn btn-gold">Plan My Trip (Quiz)</a>
                <a href="{{ route('destinations') }}" class="btn btn-outline">Browse Destinations</a>
            </div>
        </div>
    @else
        <div class="saved-trips-grid">
            @foreach($savedTrips as $trip)
                <div class="saved-trip-card">
                    <div class="saved-trip-media">
                        <x-scene-svg :destination="$trip->destination" height="180px" />
                        <span class="region-badge">{{ $trip->destination->region }} Uganda</span>
                    </div>

                    <div class="saved-trip-body">
                        <div class="saved-meta-row">
                            <span class="saved-days">{{ $trip->days }} Days</span>
                            <span class="saved-style">{{ $trip->style }} Style</span>
                            <span class="saved-date">{{ $trip->created_at->format('M d, Y') }}</span>
                        </div>

                        <h3 class="saved-title">{{ $trip->destination->name }}</h3>
                        <p class="saved-desc">{{ Str::limit($trip->destination->description, 100) }}</p>

                        <div class="saved-price-row">
                            <span class="saved-price-label">Saved Total Estimate:</span>
                            <strong class="saved-price-amount">@price($trip->total_ugx)</strong>
                        </div>

                        <div class="saved-actions-footer">
                            <a href="{{ route('destinations.show', $trip->destination->slug) }}" class="btn btn-sm btn-primary">
                                View Trip Plan →
                            </a>

                            <form action="{{ route('saved.destroy', $trip->id) }}" method="POST" onsubmit="return confirm('Remove this trip from your saved list?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    🗑️ Remove
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
