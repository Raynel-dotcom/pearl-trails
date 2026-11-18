@extends('layouts.app')
@section('title', 'Destinations — Explore Uganda\'s 13 Iconic Destinations - Pearl Trails')
@section('meta_description', 'Explore all 13 Uganda destinations with Pearl Trails: national parks, mountain gorilla sanctuaries, roaring Nile waterfalls, and island retreats. Filter by region, budget, and travel style.')

@section('content')
<div class="destinations-page-wrapper topo-pattern">
    <div class="container">
        <!-- Editorial Hero Header -->
        <div class="page-hero-editorial">
            <span class="ref-kicker">— DESTINATION DIRECTORY —</span>
            <h1 class="page-hero-title">Explore Uganda's 13 Iconic Destinations</h1>
            <p class="page-hero-subtitle">
                From the misty mountain gorilla forests of Bwindi to the thunderous gorge of Murchison Falls and the serene islands of Lake Bunyonyi — discover verified Uganda adventures tailored to your budget.
            </p>
        </div>

        <!-- Glassmorphism Filter Toolbar -->
        <div class="dest-filter-glass-bar">
            <form action="{{ route('destinations') }}" method="GET" class="filters-form" id="destinationsFilterForm">
                <div class="filter-row-top">
                    <!-- Search Input -->
                    <div class="filter-input-wrap">
                        <span class="filter-input-icon">🔍</span>
                        <input type="text" name="q" id="destSearch" value="{{ request('q') }}" placeholder="Search by destination name, region, or attraction..." class="filter-search-input">
                    </div>

                    <!-- Region Filter -->
                    <select name="region" id="filterRegion" class="filter-select" onchange="document.getElementById('destinationsFilterForm').submit()">
                        <option value="">All Regions</option>
                        @foreach($regions as $reg)
                            <option value="{{ $reg }}" {{ request('region') === $reg ? 'selected' : '' }}>{{ $reg }} Uganda</option>
                        @endforeach
                    </select>

                    <!-- Budget Filter -->
                    <select name="budget_band" id="filterBudget" class="filter-select" onchange="document.getElementById('destinationsFilterForm').submit()">
                        <option value="">Any Budget</option>
                        @foreach($budgetBands as $band)
                            <option value="{{ $band['id'] }}" {{ request('budget_band') === $band['id'] ? 'selected' : '' }}>
                                {{ $band['label'] }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Duration Filter -->
                    <select name="duration" id="filterDuration" class="filter-select" onchange="document.getElementById('destinationsFilterForm').submit()">
                        <option value="">Any Duration</option>
                        <option value="1" {{ request('duration') == '1' ? 'selected' : '' }}>1 Day Excursion</option>
                        <option value="2" {{ request('duration') == '2' ? 'selected' : '' }}>Weekend (2 Days)</option>
                        <option value="3" {{ request('duration') == '3' ? 'selected' : '' }}>3 Days</option>
                        <option value="5" {{ request('duration') == '5' ? 'selected' : '' }}>5 Days</option>
                        <option value="7" {{ request('duration') == '7' ? 'selected' : '' }}>7+ Days</option>
                    </select>

                    <!-- Interest Filter -->
                    <select name="interest" id="filterInterest" class="filter-select" onchange="document.getElementById('destinationsFilterForm').submit()">
                        <option value="">All Interests</option>
                        @foreach($interests as $interest)
                            <option value="{{ $interest }}" {{ request('interest') === $interest ? 'selected' : '' }}>{{ $interest }}</option>
                        @endforeach
                    </select>

                    <!-- Travel Style -->
                    <select name="style" id="filterStyle" class="filter-select" onchange="document.getElementById('destinationsFilterForm').submit()">
                        <option value="">Any Style</option>
                        @foreach($styles as $st)
                            <option value="{{ $st }}" {{ request('style') === $st ? 'selected' : '' }}>{{ $st }}</option>
                        @endforeach
                    </select>

                    <!-- Travel Group -->
                    <select name="group" id="filterGroup" class="filter-select" onchange="document.getElementById('destinationsFilterForm').submit()">
                        <option value="">Any Group</option>
                        @foreach($groups as $grp)
                            <option value="{{ $grp }}" {{ request('group') === $grp ? 'selected' : '' }}>{{ $grp }}</option>
                        @endforeach
                    </select>

                    <!-- Submit & Reset -->
                    <button type="submit" class="btn btn-sm btn-gold">Filter</button>
                    @if(request()->hasAny(['q', 'region', 'budget_band', 'duration', 'interest', 'style', 'group']))
                        <a href="{{ route('destinations') }}" class="btn btn-outline btn-sm">Reset</a>
                    @endif
                </div>

                <!-- Active Filter Tags -->
                @if(request()->hasAny(['q', 'region', 'budget_band', 'duration', 'interest', 'style', 'group']))
                    <div class="active-filters-row">
                        <span class="active-filters-label">Active Filters:</span>
                        @if(request('q'))
                            <span class="dest-tag-pill">"{{ request('q') }}" <a href="{{ request()->fullUrlWithQuery(['q' => null]) }}" class="pill-remove">✕</a></span>
                        @endif
                        @if(request('region'))
                            <span class="dest-tag-pill">{{ request('region') }} Uganda <a href="{{ request()->fullUrlWithQuery(['region' => null]) }}" class="pill-remove">✕</a></span>
                        @endif
                        @if(request('interest'))
                            <span class="dest-tag-pill">{{ request('interest') }} <a href="{{ request()->fullUrlWithQuery(['interest' => null]) }}" class="pill-remove">✕</a></span>
                        @endif
                        @if(request('style'))
                            <span class="dest-tag-pill">{{ request('style') }} <a href="{{ request()->fullUrlWithQuery(['style' => null]) }}" class="pill-remove">✕</a></span>
                        @endif
                        @if(request('group'))
                            <span class="dest-tag-pill">{{ request('group') }} <a href="{{ request()->fullUrlWithQuery(['group' => null]) }}" class="pill-remove">✕</a></span>
                        @endif
                        @if(request('duration'))
                            <span class="dest-tag-pill">{{ request('duration') }} Days <a href="{{ request()->fullUrlWithQuery(['duration' => null]) }}" class="pill-remove">✕</a></span>
                        @endif
                        @if(request('budget_band'))
                            <span class="dest-tag-pill">Budget: {{ request('budget_band') }} <a href="{{ request()->fullUrlWithQuery(['budget_band' => null]) }}" class="pill-remove">✕</a></span>
                        @endif
                        <a href="{{ route('destinations') }}" class="clear-all-link">Clear All</a>
                    </div>
                @endif
            </form>
        </div>

        <!-- Result Count Headline -->
        <div class="editorial-header-row" style="margin-bottom: 2rem;">
            <div>
                <h2 style="font-size: 1.65rem;">Showing {{ $destinations->count() }} {{ Str::plural('Destination', $destinations->count()) }}</h2>
                <p style="font-size: 0.88rem; color: var(--text-muted);">Prices estimated from Kampala • Verified transparent tariffs in {{ $currentCurrency }}</p>
            </div>
        </div>

        <!-- Destinations Main Grid -->
        @if($destinations->isEmpty())
            <div class="empty-state-card">
                <h3>No destinations match your active filters</h3>
                <p>Try resetting some filter criteria to explore more locations across Uganda.</p>
                <a href="{{ route('destinations') }}" class="btn btn-gold">Reset All Filters</a>
            </div>
        @else
            <div class="destinations-main-grid">
                @foreach($destinations as $dest)
                    <div class="dest-main-card">
                        <div class="dest-main-media">
                            <img src="{{ asset($dest->image_path ?? 'images/destinations/bwindi-gorilla-1.webp') }}" alt="{{ $dest->name }}" class="dest-main-img" loading="lazy">
                            <span class="ref-loc-badge" style="position: absolute; top: 1rem; left: 1rem;">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                <span>{{ $dest->region }} Uganda</span>
                            </span>
                            <span class="ref-card-pill-gold" style="position: absolute; bottom: 1rem; right: 1rem;">
                                {{ $dest->min_days }}–{{ $dest->max_days }} Days
                            </span>
                        </div>

                        <div class="dest-main-body">
                            <h3 class="dest-main-title">{{ $dest->name }}</h3>
                            <p class="dest-main-desc">{{ Str::limit($dest->description, 130) }}</p>

                            <!-- Interest Tags -->
                            <div class="dest-tags-flex">
                                @foreach(array_slice($dest->interests ?? [], 0, 3) as $tag)
                                    <span class="dest-tag-pill">{{ $tag }}</span>
                                @endforeach
                            </div>

                            <div class="dest-card-bottom">
                                <div class="preview-price-box">
                                    <span class="preview-price-label">Estimated from</span>
                                    <span class="preview-price-val">@price($dest->estimated_cost_from_kampala)</span>
                                </div>
                                <a href="{{ route('destinations.show', $dest->slug) }}" class="ref-view-details-link">
                                    <span>View Details</span>
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection