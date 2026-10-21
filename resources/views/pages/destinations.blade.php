@extends('layouts.app')
@section('title', 'Destinations - Explore All 13 Iconic Uganda Safaris & Sites')

@section('content')
<div class="destinations-page-container">
    <div class="page-hero">
        <span class="quiz-badge">Uganda Destination Guide</span>
        <h1>Explore Uganda's 13 Iconic Destinations</h1>
        <p>From the mountain gorillas of Bwindi to the thundering waters of Murchison Falls and the source of the Nile in Jinja—filter and discover your ideal itinerary.</p>
    </div>

    <!-- Server-Side Filter Bar -->
    <div class="filter-card">
        <form action="{{ route('destinations') }}" method="GET" class="filters-form" id="destinationsFilterForm">
            <div class="filters-grid">
                <!-- Search by Keyword -->
                <div class="filter-group filter-group-search">
                    <label for="destSearch">🔍 Search Destination</label>
                    <div class="filter-input-wrapper">
                        <input type="text" name="q" id="destSearch" value="{{ request('q') }}" placeholder="e.g. Bwindi, Gorillas, Jinja..." class="filter-input">
                    </div>
                </div>

                <!-- Region Filter -->
                <div class="filter-group">
                    <label for="filterRegion">📍 Region</label>
                    <select name="region" id="filterRegion" class="filter-select" onchange="document.getElementById('destinationsFilterForm').submit()">
                        <option value="">All Regions</option>
                        @foreach($regions as $reg)
                            <option value="{{ $reg }}" {{ request('region') === $reg ? 'selected' : '' }}>{{ $reg }} Uganda</option>
                        @endforeach
                    </select>
                </div>

                <!-- Budget Filter -->
                <div class="filter-group">
                    <label for="filterBudget">💰 Budget (From)</label>
                    <select name="budget_band" id="filterBudget" class="filter-select" onchange="document.getElementById('destinationsFilterForm').submit()">
                        <option value="">Any Budget</option>
                        @foreach($budgetBands as $band)
                            <option value="{{ $band['id'] }}" {{ request('budget_band') === $band['id'] ? 'selected' : '' }}>
                                Up to {{ $band['label'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Duration Filter -->
                <div class="filter-group">
                    <label for="filterDuration">⏱️ Duration</label>
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
                    <label for="filterInterest">🌿 Interest</label>
                    <select name="interest" id="filterInterest" class="filter-select" onchange="document.getElementById('destinationsFilterForm').submit()">
                        <option value="">All Interests</option>
                        @foreach($interests as $interest)
                            <option value="{{ $interest }}" {{ request('interest') === $interest ? 'selected' : '' }}>{{ $interest }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Style Filter -->
                <div class="filter-group">
                    <label for="filterStyle">🎒 Travel Style</label>
                    <select name="style" id="filterStyle" class="filter-select" onchange="document.getElementById('destinationsFilterForm').submit()">
                        <option value="">Any Style</option>
                        @foreach($styles as $st)
                            <option value="{{ $st }}" {{ request('style') === $st ? 'selected' : '' }}>{{ $st }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Group Filter -->
                <div class="filter-group">
                    <label for="filterGroup">👥 Travel Group</label>
                    <select name="group" id="filterGroup" class="filter-select" onchange="document.getElementById('destinationsFilterForm').submit()">
                        <option value="">Any Group</option>
                        @foreach($groups as $grp)
                            <option value="{{ $grp }}" {{ request('group') === $grp ? 'selected' : '' }}>{{ $grp }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Action Buttons -->
                <div class="filter-actions-group">
                    <button type="submit" class="btn btn-gold btn-filter-submit">Filter</button>
                    @if(request()->hasAny(['q', 'region', 'budget_band', 'duration', 'interest', 'style', 'group']))
                        <a href="{{ route('destinations') }}" class="btn btn-outline btn-filter-reset">Reset</a>
                    @endif
                </div>
            </div>

            @if(request()->hasAny(['q', 'region', 'budget_band', 'duration', 'interest', 'style', 'group']))
                <div class="active-filters-row">
                    <span class="active-filters-label">Active Filters:</span>
                    @if(request('q'))
                        <span class="filter-tag">"{{ request('q') }}" <a href="{{ request()->fullUrlWithQuery(['q' => null]) }}">✕</a></span>
                    @endif
                    @if(request('region'))
                        <span class="filter-tag">{{ request('region') }} <a href="{{ request()->fullUrlWithQuery(['region' => null]) }}">✕</a></span>
                    @endif
                    @if(request('interest'))
                        <span class="filter-tag">{{ request('interest') }} <a href="{{ request()->fullUrlWithQuery(['interest' => null]) }}">✕</a></span>
                    @endif
                    @if(request('style'))
                        <span class="filter-tag">{{ request('style') }} <a href="{{ request()->fullUrlWithQuery(['style' => null]) }}">✕</a></span>
                    @endif
                    @if(request('group'))
                        <span class="filter-tag">{{ request('group') }} <a href="{{ request()->fullUrlWithQuery(['group' => null]) }}">✕</a></span>
                    @endif
                    @if(request('duration'))
                        <span class="filter-tag">{{ request('duration') }} Days <a href="{{ request()->fullUrlWithQuery(['duration' => null]) }}">✕</a></span>
                    @endif
                    @if(request('budget_band'))
                        <span class="filter-tag">Budget: {{ request('budget_band') }} <a href="{{ request()->fullUrlWithQuery(['budget_band' => null]) }}">✕</a></span>
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
            <span class="empty-icon">🔍</span>
            <h3>No destinations match your active filters</h3>
            <p>Try clearing some filter criteria to explore more locations.</p>
            <a href="{{ route('destinations') }}" class="btn btn-outline">Reset Filters</a>
        </div>
    @else
        <div class="destinations-grid">
            @foreach($destinations as $dest)
                <div class="dest-card">
                    <div class="dest-card-media">
                        <x-scene-svg :destination="$dest" height="210px" />
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
                                View Details →
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
