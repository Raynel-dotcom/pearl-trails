@extends('layouts.app')
@section('title', "{$title} - Pearl Trails Uganda")

@section('content')
<div class="browse-page-container">

    <!-- "Your Picks" Sticky Top Bar -->
    <div class="your-picks-bar">
        <div class="picks-header">
            <span class="picks-title">Your Selected Picks:</span>
            <div class="picks-summary-items">
                <span class="pick-tag">
                    Stay: <strong>{{ $picks['stay']['name'] ?? 'Not chosen yet' }}</strong>
                    @if(!empty($picks['stay'])) (@price($picks['stay']['price_ugx'])/nt) @endif
                </span>
                <span class="pick-tag">
                    Eat: <strong>{{ $picks['eat']['name'] ?? 'Not chosen yet' }}</strong>
                    @if(!empty($picks['eat'])) (@price($picks['eat']['price_ugx'])/meal) @endif
                </span>
                <span class="pick-tag">
                    Activity: <strong>{{ $picks['recreation']['name'] ?? 'Not chosen yet' }}</strong>
                    @if(!empty($picks['recreation'])) (@price($picks['recreation']['price_ugx'])) @endif
                </span>
            </div>
            <div class="picks-total-badge">
                <span>Rough Total:</span>
                <strong>@price($picksTotal)</strong>
            </div>
        </div>
    </div>

    <!-- Page Hero -->
    <div class="page-hero">
        <span class="quiz-badge">{{ ucfirst($category) }} Directory</span>
        <h1>{{ $title }}</h1>
        <p>{{ $subtitle }}</p>
    </div>

    @if(session('success'))
        <div class="alert-success-banner">
            <span>✓ {{ session('success') }}</span>
        </div>
    @endif

    <!-- Search & Filter Card -->
    <div class="filter-card">
        <form action="{{ url()->current() }}" method="GET" class="filters-form" id="browseFilterForm">
            <div class="filters-grid">
                <!-- Keyword Search -->
                <div class="filter-group filter-group-search">
                    <label for="browseSearch">Search</label>
                    <div class="filter-input-wrapper">
                        <svg class="search-input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        <input type="text" name="q" id="browseSearch" value="{{ request('q') }}" placeholder="Search by name, site, or specialty..." class="filter-input filter-input-with-icon">
                    </div>
                </div>

                <!-- Destination Filter -->
                <div class="filter-group">
                    <label for="destSelect">Destination</label>
                    <select name="destination" id="destSelect" class="filter-select" onchange="document.getElementById('browseFilterForm').submit()">
                        <option value="">All Uganda Destinations</option>
                        @foreach($destinations as $d)
                            <option value="{{ $d->id }}" {{ $selectedDestinationId === $d->id ? 'selected' : '' }}>
                                {{ $d->name }} ({{ $d->region }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Up to Price Filter -->
                <div class="filter-group">
                    <label for="priceSelect">Maximum Spend ({{ $currentCurrency }})</label>
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
                </div>

                <!-- Action Buttons -->
                <div class="filter-actions-group">
                    <button type="submit" class="btn btn-gold btn-filter-submit">
                        Search
                    </button>
                    @if(request()->hasAny(['q', 'destination', 'max_price']))
                        <a href="{{ url()->current() }}" class="btn btn-outline btn-filter-reset">
                            Clear
                        </a>
                    @endif
                </div>
            </div>

            @if($selectedDestinationId || $maxPriceUgx || request('q'))
                <div class="active-filters-row">
                    <span class="active-filters-label">Active Filters:</span>
                    @if(request('q'))
                        <span class="filter-tag">"{{ request('q') }}" <a href="{{ request()->fullUrlWithQuery(['q' => null]) }}">✕</a></span>
                    @endif
                    @if($selectedDestinationId)
                        @php $activeDest = $destinations->firstWhere('id', $selectedDestinationId); @endphp
                        <span class="filter-tag">{{ $activeDest->name ?? 'Destination' }} <a href="{{ request()->fullUrlWithQuery(['destination' => null]) }}">✕</a></span>
                    @endif
                    @if($maxPriceUgx)
                        <span class="filter-tag">Max @price($maxPriceUgx) <a href="{{ request()->fullUrlWithQuery(['max_price' => null]) }}">✕</a></span>
                    @endif
                    <a href="{{ url()->current() }}" class="clear-filters-link">Reset All</a>
                </div>
            @endif
        </form>
    </div>

    <!-- Cards Grid (Sorted Cheapest First) -->
    <div class="browse-results-count">
        <h2>Showing {{ $items->count() }} {{ Str::plural('Option', $items->count()) }} (Sorted Cheapest First)</h2>
        <span class="price-estimate-note">All rates labelled as estimates</span>
    </div>

    @if($items->isEmpty())
        <div class="empty-state-card">
            <div class="empty-icon-wrap">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </div>
            <h3>No results found matching your filters</h3>
            <p>Try broadening your price limit or viewing all destinations.</p>
            <a href="{{ url()->current() }}" class="btn btn-outline">Clear Filters</a>
        </div>
    @else
        <div class="browse-cards-grid">
            @foreach($items as $item)
                <div class="browse-card {{ $item['fits_plan'] ? 'fits-plan-card' : '' }}">
                    @if(!empty($item['image_path']))
                        <div class="browse-card-media">
                            <img src="{{ asset($item['image_path']) }}" alt="{{ $item['name'] }}" class="browse-card-img" loading="lazy">
                            <div class="browse-card-badges">
                                <span class="type-badge">{{ $item['type'] }}</span>
                                @if($item['is_community'])
                                    <span class="community-badge">Community</span>
                                @endif
                                @if($item['fits_plan'])
                                    <span class="fits-plan-badge">Fits plan</span>
                                @endif
                            </div>
                            <span class="browse-dest-pill">{{ $item['destination_name'] }}</span>
                        </div>
                    @else
                        <div class="browse-card-header">
                            <div class="browse-card-badges">
                                <span class="type-badge">{{ $item['type'] }}</span>
                                @if($item['is_community'])
                                    <span class="community-badge">Community Listing</span>
                                @endif
                                @if($item['fits_plan'])
                                    <span class="fits-plan-badge">Fits your plan</span>
                                @endif
                            </div>
                            <span class="browse-dest-pill">{{ $item['destination_name'] }}</span>
                        </div>
                    @endif

                    <div class="browse-card-body">
                        <h3 class="browse-card-title">{{ $item['name'] }}</h3>
                        <p class="browse-card-desc">
                            {{ $item['description'] ?? "Quality {$category} experience in {$item['destination_name']}." }}
                        </p>

                        <!-- Activities and Fees list if recreation/tourist site -->
                        @if(!empty($item['activities']) && count($item['activities']) > 0)
                            <div class="card-activities-box">
                                <strong>Activities & Fees:</strong>
                                <ul class="activities-fee-list">
                                    @foreach($item['activities'] as $act)
                                        <li>
                                            <span>{{ $act->name }}</span>
                                            <strong>@price($act->fee_ugx)</strong>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if($item['website'])
                            <div class="browse-website-link">
                                <a href="{{ $item['website'] }}" target="_blank" rel="noopener noreferrer">
                                    Visit Official Website ↗
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="browse-card-footer">
                        <div class="browse-price-box">
                            <span class="price-figure">@price($item['price_ugx'])</span>
                            <span class="price-unit">per {{ $item['unit'] }} (est.)</span>
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
                            <button type="submit" class="btn btn-sm {{ $isChosen ? 'btn-chosen' : 'btn-outline' }}">
                                {{ $isChosen ? '✓ Selected Pick' : 'Choose' }}
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
