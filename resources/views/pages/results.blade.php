@extends('layouts.app')
@section('title', 'Your Trip Recommendations - Top 3 Matches')

@section('content')
<div class="results-page-container">
    <div class="results-header">
        <span class="quiz-badge">Personalized Matches</span>
        <h1 class="results-title">Your Top Recommended Uganda Destinations</h1>
        <p class="results-subtitle">
            Based on your {{ $quiz['days'] }} itinerary from {{ $quiz['origin'] }} for {{ $quiz['group'] }} traveling {{ $quiz['style'] }} style.
        </p>
        <div class="results-actions-top">
            <a href="{{ route('plan.reset') }}" class="btn btn-outline">
                🔄 Plan Another Trip
            </a>
            <span class="currency-disclaimer-tag">
                Prices shown in {{ $currency }}. Approximate estimates for planning.
            </span>
        </div>
    </div>

    <!-- Cheaper Alternative Callout if top choice exceeds budget -->
    @if($cheaperAlternative && !$topRecommendations[0]['is_within_budget'])
        <div class="budget-alert-banner alert-notice">
            <div class="banner-icon">💡</div>
            <div class="banner-body">
                <h3>Looking for a budget-friendly alternative?</h3>
                <p>
                    Your top match exceeds your target budget, but <strong>{{ $cheaperAlternative['destination']->name }}</strong> 
                    is comfortably within budget at <strong>@price($cheaperAlternative['cost']['total'])</strong> with a 
                    <strong>{{ $cheaperAlternative['score'] }}%</strong> match score!
                </p>
                <a href="{{ route('destinations.show', $cheaperAlternative['destination']->slug) }}" class="btn btn-sm btn-outline">
                    View Cheaper Alternative ({{ $cheaperAlternative['destination']->name }})
                </a>
            </div>
        </div>
    @endif

    <!-- Top 3 Recommendations Grid -->
    <div class="recommendations-grid">
        @foreach($topRecommendations as $index => $rec)
            @php
                $dest = $rec['destination'];
                $rank = $index + 1;
            @endphp
            <div class="rec-card {{ $rank === 1 ? 'featured-card' : '' }}">
                <div class="rec-card-media">
                    <x-scene-svg :destination="$dest" height="230px" />
                    <div class="rank-badge rank-{{ $rank }}">
                        #{{ $rank }} Pick
                    </div>
                    <div class="match-score-badge">
                        <span class="match-number">{{ $rec['score'] }}%</span>
                        <span class="match-label">Match</span>
                    </div>
                </div>

                <div class="rec-card-body">
                    <div class="rec-card-meta">
                        <span class="region-pill">{{ $dest->region }} Uganda</span>
                        <span class="difficulty-pill">{{ $dest->difficulty }}</span>
                    </div>

                    <h2 class="rec-card-title">{{ $dest->name }}</h2>
                    <p class="rec-card-desc">{{ Str::limit($dest->description, 140) }}</p>

                    <!-- Budget Fit Banner -->
                    @if($rec['is_within_budget'])
                        <div class="budget-fit-banner within-budget">
                            <span class="fit-icon">✓</span>
                            <span>Within your budget (approx. @price($rec['budget_diff']) remaining)</span>
                        </div>
                    @else
                        <div class="budget-fit-banner over-budget">
                            <span class="fit-icon">⚠️</span>
                            <span>May exceed target budget by @price(abs($rec['budget_diff']))</span>
                        </div>
                    @endif

                    <!-- Cost Breakdown Summary -->
                    <div class="cost-summary-box">
                        <div class="cost-label">Estimated Total ({{ $quiz['days'] }})</div>
                        <div class="cost-value">@price($rec['cost']['total'])</div>
                        <div class="cost-sub">Includes transport, {{ $rec['cost']['nights'] }} nights stay, food, activities & misc</div>
                    </div>

                    <!-- Why We Recommend It Bullets -->
                    <div class="why-recommend-box">
                        <h4>Why We Recommend It:</h4>
                        <ul class="why-bullets-list">
                            @foreach(array_slice($rec['why_bullets'], 0, 3) as $bullet)
                                <li>{{ $bullet }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Action Button -->
                    <div class="rec-card-footer">
                        <a href="{{ route('destinations.show', $dest->slug) }}" class="btn {{ $rank === 1 ? 'btn-gold' : 'btn-primary' }} btn-block">
                            View Full Trip Plan & Itinerary →
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Bottom Actions -->
    <div class="results-bottom-bar">
        <h3>Want to adjust your travel parameters?</h3>
        <p>Try modifying your duration, budget band, or interests to explore other possibilities.</p>
        <div class="bottom-btns">
            <a href="{{ route('plan.reset') }}" class="btn btn-outline">
                🔄 Plan Another Trip
            </a>
            <a href="{{ route('destinations') }}" class="btn btn-primary">
                Browse All 13 Destinations →
            </a>
        </div>
    </div>
</div>
@endsection
