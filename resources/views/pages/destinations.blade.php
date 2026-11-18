@extends('layouts.app')
@section('title', 'Destinations — Explore Uganda\'s 13 Iconic Destinations - Pearl Trails')
@section('meta_description', 'Explore all 13 Uganda destinations with Pearl Trails: national parks, mountain gorilla sanctuaries, roaring Nile waterfalls, and island retreats. Filter by region, budget, and travel style.')

@section('content')
<div class="destinations-page-wrapper topo-pattern">
    <div class="container">
        <!-- Editorial Hero Header -->
        <div class="page-hero-editorial">
            <span class="glass-badge glass-badge-gold" style="margin-bottom: 1rem;">Destination Discovery</span>
            <h1 class="page-hero-title">Explore Uganda's 13 Iconic Destinations</h1>
            <p class="page-hero-subtitle">
                From the mountain gorillas of Bwindi to the thundering waters of Murchison Falls and the source of the Nile in Jinja—find your ideal adventure across the Pearl of Africa.
            </p>
        </div>

        <!-- Glassmorphism Filter Toolbar -->
        <div class="dest-filter-glass-bar">
            <form action="{{ route('destinations') }}" method="GET" class="filters-form" id="destinationsFilterForm">
                <div class="filter-row-top">
                    <!-- Search Input -->
                    <input type="text" name="q" id="destSearch" value="{{ request('q') }}" placeholder="Search by destination name, region, or attraction (e.g. Bwindi, Nile, Sipi)..." class="filter-search-input">

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
                    <button type="submit" class="btn btn-primary btn-sm">Search</button>
                    @if(request()->hasAny(['q', 'region', 'budget_band', 'duration', 'interest', 'style', 'group']))
                        <a href="{{ route('destinations') }}" class="btn btn-outline btn-sm">Reset</a>
                    @endif
                </div>

                <!-- Active Filter Tags -->
                @if(request()->hasAny(['q', 'region', 'budget_band', 'duration', 'interest', 'style', 'group']))
                    <div class="active-filters-row" style="display: flex; gap: 0.5rem; flex-wrap: wrap; align-items: center; padding-top: 1rem; border-top: 1px solid var(--border-color);">
                        <span style="font-size: 0.78rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">Active Filters:</span>
                        @if(request('q'))
                            <span class="dest-tag-pill">"{{ request('q') }}" <a href="{{ request()->fullUrlWithQuery(['q' => null]) }}" style="margin-left: 4px;">✕</a></span>
                        @endif
                        @if(request('region'))
                            <span class="dest-tag-pill">{{ request('region') }} Uganda <a href="{{ request()->fullUrlWithQuery(['region' => null]) }}" style="margin-left: 4px;">✕</a></span>
                        @endif
                        @if(request('interest'))
                            <span class="dest-tag-pill">{{ request('interest') }} <a href="{{ request()->fullUrlWithQuery(['interest' => null]) }}" style="margin-left: 4px;">✕</a></span>
                        @endif
                        @if(request('style'))
                            <span class="dest-tag-pill">{{ request('style') }} <a href="{{ request()->fullUrlWithQuery(['style' => null]) }}" style="margin-left: 4px;">✕</a></span>
                        @endif
                        @if(request('group'))
                            <span class="dest-tag-pill">{{ request('group') }} <a href="{{ request()->fullUrlWithQuery(['group' => null]) }}" style="margin-left: 4px;">✕</a></span>
                        @endif
                        @if(request('duration'))
                            <span class="dest-tag-pill">{{ request('duration') }} Days <a href="{{ request()->fullUrlWithQuery(['duration' => null]) }}" style="margin-left: 4px;">✕</a></span>
                        @endif
                        @if(request('budget_band'))
                            <span class="dest-tag-pill">Budget: {{ request('budget_band') }} <a href="{{ request()->fullUrlWithQuery(['budget_band' => null]) }}" style="margin-left: 4px;">✕</a></span>
                        @endif
                        <a href="{{ route('destinations') }}" style="font-size: 0.8rem; font-weight: 700; color: var(--color-gold); text-decoration: underline; margin-left: auto;">Clear All</a>
                    </div>
                @endif
            </form>
        </div>

        <!-- Result Count Headline -->
        <div class="editorial-header-row" style="margin-bottom: 2rem;">
            <div>
                <h2 style="font-size: 1.65rem;">Showing {{ $destinations->count() }} {{ Str::plural('Destination', $destinations->count()) }}</h2>
                <p style="font-size: 0.88rem; color: var(--text-muted);">Prices estimated from Kampala (Budget style) • Verified transparent tariffs</p>
            </div>
        </div>

        <!-- Destinations Main Grid -->
        @if($destinations->isEmpty())
            <div class="empty-state-card" style="text-align: center; padding: 4rem 2rem; background: var(--bg-surface); border-radius: var(--radius-md); border: 1px solid var(--border-color); margin-bottom: 4rem;">
                <h3 style="margin-bottom: 0.75rem;">No destinations match your active filters</h3>
                <p style="color: var(--text-muted); margin-bottom: 1.5rem;">Try resetting some filter criteria to explore more locations across Uganda.</p>
                <a href="{{ route('destinations') }}" class="btn btn-outline">Reset All Filters</a>
            </div>
        @else
            <div class="destinations-main-grid">
                @foreach($destinations as $dest)
                    <div class="dest-main-card">
                        <div class="dest-main-media">
                            <img src="{{ asset($dest->image_path ?? 'images/destinations/bwindi-gorilla-1.webp') }}" alt="{{ $dest->name }}" class="dest-main-img" loading="lazy">
                            <span class="glass-badge" style="position: absolute; top: 1rem; left: 1rem;">{{ $dest->region }} Uganda</span>
                            <span class="glass-badge glass-badge-gold" style="position: absolute; bottom: 1rem; right: 1rem;">{{ $dest->min_days }}–{{ $dest->max_days }} Days</span>
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
</div>
@endsection
