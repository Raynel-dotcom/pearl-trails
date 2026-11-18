@extends('layouts.app')
@section('title', "{$title} — Pearl Trails Uganda")
@section('meta_description', "{$subtitle} Explore verified options across 13 Uganda destinations with transparent pricing.")

@section('content')
<div class="browse-page-wrapper topo-pattern">
    <div class="container">

        <!-- Sticky "Your Selected Picks" Bar -->
        <div class="picks-glass-toolbar">
            <div class="picks-left-cluster">
                <span class="picks-label">YOUR PICKS:</span>
                <span class="dest-tag-pill">
                    Stay: <strong>{{ $picks['stay']['name'] ?? 'None' }}</strong>
                    @if(!empty($picks['stay'])) (@price($picks['stay']['price_ugx'])/nt) @endif
                </span>
                <span class="dest-tag-pill">
                    Eat: <strong>{{ $picks['eat']['name'] ?? 'None' }}</strong>
                    @if(!empty($picks['eat'])) (@price($picks['eat']['price_ugx'])/meal) @endif
                </span>
                <span class="dest-tag-pill">
                    Activity: <strong>{{ $picks['recreation']['name'] ?? 'None' }}</strong>
                    @if(!empty($picks['recreation'])) (@price($picks['recreation']['price_ugx'])) @endif
                </span>
            </div>
            <div class="picks-right-cluster">
                <span class="picks-calc-label">Estimated Total:</span>
                <strong class="picks-total-val">@price($picksTotal)</strong>
                <a href="{{ route('plan') }}" class="btn btn-sm btn-gold">Plan Trip →</a>
            </div>
        </div>

        <!-- Editorial Hero Header -->
        <div class="page-hero-editorial">
            <span class="ref-kicker">
                @if($category === 'stay') — Where to Stay in Uganda — @elseif($category === 'eat') — Where to Eat in Uganda — @else — Recreation &amp; Fun Activities — @endif
            </span>
            <h1 class="page-hero-title">{{ $title }}</h1>
            <p class="page-hero-subtitle">{{ $subtitle }}</p>
        </div>

        @if(session('success'))
            <div class="ref-success-alert">
                ✓ {{ session('success') }}
            </div>
        @endif

        <!-- Glassmorphism Filter Card -->
        <div class="dest-filter-glass-bar">
            <form action="{{ url()->current() }}" method="GET" class="filters-form" id="browseFilterForm">
                <div class="filter-row-top">
                    <!-- Search Input -->
                    <div class="filter-input-wrap">
                        <span class="filter-input-icon">🔍</span>
                        <input type="text" name="q" id="browseSearch" value="{{ request('q') }}" placeholder="Search by name, site, or specialty..." class="filter-search-input">
                    </div>

                    <!-- Destination Select -->
                    <select name="destination" id="destSelect" class="filter-select" onchange="document.getElementById('browseFilterForm').submit()">
                        <option value="">All Uganda Destinations</option>
                        @foreach($destinations as $d)
                            <option value="{{ $d->id }}" {{ $selectedDestinationId === $d->id ? 'selected' : '' }}>
                                {{ $d->name }} ({{ $d->region }})
                            </option>
                        @endforeach
                    </select>

                    <!-- Maximum Spend Filter -->
                    <select name="max_price" id="priceSelect" class="filter-select" onchange="document.getElementById('browseFilterForm').submit()">
                        <option value="">Any Budget</option>
                        @if($currentCurrency === 'UGX')
                            <option value="30000" {{ $maxPriceUgx === 30000 ? 'selected' : '' }}>Under UGX 30,000</option>
                            <option value="60000" {{ $maxPriceUgx === 60000 ? 'selected' : '' }}>Under UGX 60,000</option>
                            <option value="120000" {{ $maxPriceUgx === 120000 ? 'selected' : '' }}>Under UGX 120,000</option>
                            <option value="250000" {{ $maxPriceUgx === 250000 ? 'selected' : '' }}>Under UGX 250,000</option>
                            <option value="500000" {{ $maxPriceUgx === 500000 ? 'selected' : '' }}>Under UGX 500,000</option>
                        @else
                            <option value="73000" {{ $maxPriceUgx === 73000 ? 'selected' : '' }}>Under ~@price(73000)</option>
                            <option value="182500" {{ $maxPriceUgx === 182500 ? 'selected' : '' }}>Under ~@price(182500)</option>
                            <option value="365000" {{ $maxPriceUgx === 365000 ? 'selected' : '' }}>Under ~@price(365000)</option>
                            <option value="730000" {{ $maxPriceUgx === 730000 ? 'selected' : '' }}>Under ~@price(730000)</option>
                        @endif
                    </select>

                    <!-- Submit & Reset -->
                    <button type="submit" class="btn btn-gold btn-sm">Filter</button>
                    @if(request()->hasAny(['q', 'destination', 'max_price']))
                        <a href="{{ url()->current() }}" class="btn btn-outline btn-sm">Reset</a>
                    @endif
                </div>

                <!-- Active Filter Tags -->
                @if($selectedDestinationId || $maxPriceUgx || request('q'))
                    <div class="active-filters-row">
                        <span class="active-filters-label">Active Filters:</span>
                        @if(request('q'))
                            <span class="dest-tag-pill">"{{ request('q') }}" <a href="{{ request()->fullUrlWithQuery(['q' => null]) }}" class="pill-remove">✕</a></span>
                        @endif
                        @if($selectedDestinationId)
                            @php $activeDest = $destinations->firstWhere('id', $selectedDestinationId); @endphp
                            <span class="dest-tag-pill">{{ $activeDest->name ?? 'Destination' }} <a href="{{ request()->fullUrlWithQuery(['destination' => null]) }}" class="pill-remove">✕</a></span>
                        @endif
                        @if($maxPriceUgx)
                            <span class="dest-tag-pill">Max @price($maxPriceUgx) <a href="{{ request()->fullUrlWithQuery(['max_price' => null]) }}" class="pill-remove">✕</a></span>
                        @endif
                        <a href="{{ url()->current() }}" class="clear-all-link">Reset All</a>
                    </div>
                @endif
            </form>
        </div>

        <!-- Result Headline -->
        <div class="editorial-header-row" style="margin-bottom: 2rem;">
            <div>
                <h2 style="font-size: 1.65rem;">Showing {{ $items->count() }} {{ Str::plural('Option', $items->count()) }}</h2>
                <p style="font-size: 0.88rem; color: var(--text-muted);">Verified local directory rates in {{ $currentCurrency }}</p>
            </div>
        </div>

        @if($items->isEmpty())
            <div class="empty-state-card">
                <h3>No results found matching your filters</h3>
                <p>Try broadening your price limit or viewing all destinations across Uganda.</p>
                <a href="{{ url()->current() }}" class="btn btn-gold">Clear Filters</a>
            </div>
        @else
            <div class="browse-main-grid">
                @foreach($items as $item)
                    <div class="browse-item-card">
                        <div class="browse-card-media">
                            @if(!empty($item['image_path']))
                                <img src="{{ asset($item['image_path']) }}?v={{ @filemtime(public_path($item['image_path'])) ?: '1' }}" alt="{{ $item['name'] }}" class="browse-card-img" loading="lazy">
                            @else
                                <div style="width: 100%; height: 100%; background: var(--color-midnight);"></div>
                            @endif
                            <div class="browse-card-badges">
                                <span class="browse-badge">{{ $item['type'] }}</span>
                                @if($item['is_community'])
                                    <span class="browse-badge" style="background: var(--color-safari);">Community</span>
                                @endif
                                @if($item['fits_plan'])
                                    <span class="browse-badge" style="background: var(--color-gold); color: var(--color-midnight);">Fits plan</span>
                                @endif
                            </div>
                            <span class="browse-dest-pill">{{ $item['destination_name'] }}</span>
                        </div>

                        <div class="browse-card-body">
                            <h3 class="browse-item-title">{{ $item['name'] }}</h3>
                            <p class="browse-item-desc">
                                {{ $item['description'] ?? "Quality {$category} experience in {$item['destination_name']}." }}
                            </p>

                            <!-- Activities & Fees list if recreation -->
                            @if(!empty($item['activities']) && count($item['activities']) > 0)
                                <div class="activities-fee-box">
                                    <strong class="fee-box-title">Activities & Fees:</strong>
                                    <ul class="fee-box-list">
                                        @foreach($item['activities'] as $act)
                                            <li>
                                                <span>{{ $act->name }}</span>
                                                <strong>@price($act->fee_ugx)</strong>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="browse-card-links">
                                @if($item['website'])
                                    <a href="{{ $item['website'] }}" target="_blank" rel="noopener noreferrer" class="browse-action-link">
                                        Official Website ↗
                                    </a>
                                @endif
                                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($item['name'] . ', ' . $item['destination_name'] . ', Uganda') }}" target="_blank" rel="noopener noreferrer" class="browse-action-link maps-pin-link">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: -1px; margin-right: 3px;">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                    View on Maps ↗
                                </a>
                            </div>

                            <div class="browse-card-footer">
                                <div class="browse-price-box">
                                    <span class="browse-price-val">@price($item['price_ugx'])</span>
                                    <span class="browse-price-unit">per {{ $item['unit'] }} (est.)</span>
                                </div>

                                <!-- Choose Button Form -->
                                <form action="{{ route('picks.save') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="category" value="{{ $category }}">
                                    <input type="hidden" name="name" value="{{ $item['name'] }}">
                                    <input type="hidden" name="price_ugx" value="{{ $item['price_ugx'] }}">
                                    
                                    @php
                                        $isChosen = (!empty($picks[$category]) && $picks[$category]['name'] === $item['name']);
                                    @endphp
                                    <button type="submit" class="btn btn-sm {{ $isChosen ? 'btn-gold' : 'btn-primary' }}">
                                        {{ $isChosen ? '✓ Selected' : 'Choose' }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection