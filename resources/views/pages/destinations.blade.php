@extends('layouts.app')
@section('title', 'Destinations - Explore All 13 Iconic Uganda Safaris & Sites')
@section('meta_description', 'Browse all 13 Uganda destinations — national parks, crater lakes, mountain trails, and island retreats. Filter by region, budget, interest, and travel style.')

@section('content')
<div class="destinations-page-container" style="max-width: 1280px; margin: 0 auto; padding: 2.5rem 1.5rem 5rem;">
    <div class="page-hero" style="text-align: center; max-width: 840px; margin: 0 auto 3rem;">
        <span class="section-kicker-gold">Destination Directory</span>
        <h1 class="section-title-serif" style="margin: 0.6rem 0 1rem; font-size: clamp(2.2rem, 3.8vw, 3rem); line-height: 1.15;">Explore Uganda's 13 Iconic Destinations</h1>
        <p style="font-size: 1.05rem; line-height: 1.6; color: var(--text-muted); margin: 0 auto;">From the mountain gorillas of Bwindi to the thundering waters of Murchison Falls and the source of the Nile in Jinja—filter and discover your ideal itinerary.</p>
    </div>

    <!-- Server-Side Filter Bar -->
    <div class="filter-card">
        <form action="{{ route('destinations') }}" method="GET" class="filters-form" id="destinationsFilterForm">
            <div class="filters-grid">
                <!-- Search by Keyword -->
                <div class="filter-group filter-group-search">
                    <label for="destSearch">Search Destination</label>
                    <div class="filter-input-wrapper">
                        <svg class="search-input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        <input type="text" name="q" id="destSearch" value="{{ request('q') }}" placeholder="Search by name, region, or attraction (e.g. Bwindi, Gorillas, Jinja)..." class="filter-input filter-input-with-icon">
                    </div>
                </div>

                <!-- Region Filter -->
                <div class="filter-group">
                    <label for="filterRegion">Region</label>
                    <select name="region" id="filterRegion" class="filter-select" onchange="document.getElementById('destinationsFilterForm').submit()">
                        <option value="">All Regions</option>
                        @foreach($regions as $reg)
                            <option value="{{ $reg }}" {{ request('region') === $reg ? 'selected' : '' }}>{{ $reg }} Uganda</option>
                        @endforeach
                    </select>
                </div>

                <!-- Budget Filter -->
                <div class="filter-group">
                    <label for="filterBudget">Budget (From)</label>
                    <select name="budget_band" id="filterBudget" class="filter-select" onchange="document.getElementById('destinationsFilterForm').submit()">
                        <option value="">Any Budget</option>
                        @foreach($budgetBands as $band)
                            <option value="{{ $band['id'] }}" {{ request('budget_band') === $band['id'] ? 'selected' : '' }}>
                                {{ $band['label'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Duration Filter -->
                <div class="filter-group">
                    <label for="filterDuration">Duration</label>
                    <select name="duration" id="filterDuration" class="filter-select" onchange="document.getElementById('destinationsFilterForm').submit()">
                        <option value="">Any Duration</option>
                        <option value="1" {{ request('duration') == '1' ? 'selected' : '' }}>1 Day Excursion</option>
                        <option value="2" {{ request('duration') == '2' ? 'selected' : '' }}>Weekend (2 Days)</option>
                        <option value="3" {{ request('duration') == '3' ? 'selected' : '' }}>3 Days</option>
                        <option value="5" {{ request('duration') == '5' ? 'selected' : '' }}>5 Days</option>
                        <option value="7" {{ request('duration') == '7' ? 'selected' : '' }}>7+ Days</option>
                    </select>
                </div>

                <!-- Interest Filter -->
                <div class="filter-group">
                    <label for="filterInterest">Interest</label>
                    <select name="interest" id="filterInterest" class="filter-select" onchange="document.getElementById('destinationsFilterForm').submit()">
                        <option value="">All Interests</option>
                        @foreach($interests as $interest)
                            <option value="{{ $interest }}" {{ request('interest') === $interest ? 'selected' : '' }}>{{ $interest }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Style Filter -->
                <div class="filter-group">
                    <label for="filterStyle">Travel Style</label>
                    <select name="style" id="filterStyle" class="filter-select" onchange="document.getElementById('destinationsFilterForm').submit()">
                        <option value="">Any Style</option>
                        @foreach($styles as $st)
                            <option value="{{ $st }}" {{ request('style') === $st ? 'selected' : '' }}>{{ $st }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Group Filter -->
                <div class="filter-group">
                    <label for="filterGroup">Travel Group</label>
                    <select name="group" id="filterGroup" class="filter-select" onchange="document.getElementById('destinationsFilterForm').submit()">
                        <option value="">Any Group</option>
                        @foreach($groups as $grp)
                            <option value="{{ $grp }}" {{ request('group') === $grp ? 'selected' : '' }}>{{ $grp }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Action Buttons -->
                <div class="filter-actions-group">
                    <button type="submit" class="btn btn-primary btn-filter-submit">Filter</button>
                    @if(request()->hasAny(['q', 'region', 'budget_band', 'duration', 'interest', 'style', 'group']))
                        <a href="{{ route('destinations') }}" class="btn btn-outline btn-filter-reset">Reset</a>
                    @endif
                </div>
            </div>

            @if(request()->hasAny(['q', 'region', 'budget_band', 'duration', 'interest', 'style', 'group']))
                <div class="active-filters-row">
                    <span class="active-filters-label">Active Filters:</span>
                    @if(request('q'))
                        <span class="filter-tag">"{{ request('q') }}" <a href="{{ request()->fullUrlWithQuery(['q' => null]) }}">&times;</a></span>
                    @endif
                    @if(request('region'))
                        <span class="filter-tag">{{ request('region') }} <a href="{{ request()->fullUrlWithQuery(['region' => null]) }}">&times;</a></span>
                    @endif
                    @if(request('interest'))
                        <span class="filter-tag">{{ request('interest') }} <a href="{{ request()->fullUrlWithQuery(['interest' => null]) }}">&times;</a></span>
                    @endif
                    @if(request('style'))
                        <span class="filter-tag">{{ request('style') }} <a href="{{ request()->fullUrlWithQuery(['style' => null]) }}">&times;</a></span>
                    @endif
                    @if(request('group'))
                        <span class="filter-tag">{{ request('group') }} <a href="{{ request()->fullUrlWithQuery(['group' => null]) }}">&times;</a></span>
                    @endif
                    @if(request('duration'))
                        <span class="filter-tag">{{ request('duration') }} Days <a href="{{ request()->fullUrlWithQuery(['duration' => null]) }}">&times;</a></span>
                    @endif
                    @if(request('budget_band'))
                        <span class="filter-tag">Budget: {{ request('budget_band') }} <a href="{{ request()->fullUrlWithQuery(['budget_band' => null]) }}">&times;</a></span>
                    @endif
                    <a href="{{ route('destinations') }}" class="clear-filters-link">Clear All</a>
                </div>
            @endif
        </form>
    </div>

    <!-- Destinations Grid -->
    <div class="destinations-results-header">
        <h2>Showing {{ $destinations->count() }} {{ Str::plural('Destination', $destinations->count()) }}</h2>
        <span class="price-estimate-note">Prices shown from Kampala (Budget style) • Estimates at approximate rates</span>
    </div>

    @if($destinations->isEmpty())
        <div class="empty-state-card">
            <span class="empty-icon" aria-hidden="true">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </span>
            <h3>No destinations match your active filters</h3>
            <p>Try clearing some filter criteria to explore more locations across Uganda.</p>
            <a href="{{ route('destinations') }}" class="btn btn-outline">Reset Filters</a>
        </div>
    @else
        <div class="destinations-grid">
            @foreach($destinations as $dest)
                <div class="dest-card" onclick="window.location='{{ route('destinations.show', $dest->slug) }}'" tabindex="0" role="link" aria-label="Explore {{ $dest->name }} Details">
                    <div class="dest-card-media">
                        @if(!empty($dest->image_path))
                            <img src="{{ asset($dest->image_path) }}" alt="{{ $dest->name }}" class="dest-card-img" loading="lazy">
                        @else
                            <x-scene-svg :destination="$dest" height="220px" />
                        @endif
                        <span class="region-badge">{{ $dest->region }} Uganda</span>
                        <span class="duration-badge">{{ $dest->min_days }}-{{ $dest->max_days }} Days</span>
                    </div>

                    <div class="dest-card-body">
                        <h3 class="dest-title">{{ $dest->name }}</h3>
                        <p class="dest-desc">{{ Str::limit($dest->description, 120) }}</p>

                        <!-- 3 Interest Tags -->
                        <div class="interest-tags-row">
                            @foreach(array_slice($dest->interests ?? [], 0, 3) as $tag)
                                <span class="tag-pill">{{ $tag }}</span>
                            @endforeach
                        </div>

                        <div class="dest-card-footer">
                            <div class="dest-price-box">
                                <span class="price-label">From</span>
                                <span class="price-amount">@price($dest->estimated_cost_from_kampala)</span>
                            </div>
                            <a href="{{ route('destinations.show', $dest->slug) }}" class="btn btn-sm btn-primary">
                                View Details &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
