@extends('layouts.app')
@section('title', "{$title} - Pearl Trails Uganda")

@section('content')
<div class="browse-page-container">

    <!-- "Your Picks" Sticky Top Bar -->
    <div class="your-picks-bar">
        <div class="picks-header">
            <span class="picks-title">🌟 Your Selected Picks:</span>
            <div class="picks-summary-items">
                <span class="pick-tag">
                    🛏️ Stay: <strong>{{ $picks['stay']['name'] ?? 'Not chosen yet' }}</strong>
                    @if(!empty($picks['stay'])) (@price($picks['stay']['price_ugx'])/nt) @endif
                </span>
                <span class="pick-tag">
                    🍽️ Eat: <strong>{{ $picks['eat']['name'] ?? 'Not chosen yet' }}</strong>
                    @if(!empty($picks['eat'])) (@price($picks['eat']['price_ugx'])/meal) @endif
                </span>
                <span class="pick-tag">
                    🛶 Activity: <strong>{{ $picks['recreation']['name'] ?? 'Not chosen yet' }}</strong>
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

    <!-- Filter Bar -->
    <div class="filter-card">
        <form action="{{ url()->current() }}" method="GET" class="filters-form" id="browseFilterForm">
            <div class="filters-grid">
                <!-- Destination Filter -->
                <div class="filter-group">
                    <label for="destSelect">Filter by Destination</label>
                    <select name="destination" id="destSelect" onchange="document.getElementById('browseFilterForm').submit()">
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
                    <label for="priceSelect">Up to Price</label>
                    <select name="max_price" id="priceSelect" onchange="document.getElementById('browseFilterForm').submit()">
                        <option value="">Any Price</option>
                        @if($currentCurrency === 'UGX')
                            <option value="30000" {{ $maxPriceUgx === 30000 ? 'selected' : '' }}>Up to UGX 30,000</option>
                            <option value="60000" {{ $maxPriceUgx === 60000 ? 'selected' : '' }}>Up to UGX 60,000</option>
                            <option value="120000" {{ $maxPriceUgx === 120000 ? 'selected' : '' }}>Up to UGX 120,000</option>
                            <option value="250000" {{ $maxPriceUgx === 250000 ? 'selected' : '' }}>Up to UGX 250,000</option>
                            <option value="500000" {{ $maxPriceUgx === 500000 ? 'selected' : '' }}>Up to UGX 500,000</option>
                        @else
                            <option value="73000" {{ $maxPriceUgx === 73000 ? 'selected' : '' }}>Up to ~@price(73000)</option>
                            <option value="182500" {{ $maxPriceUgx === 182500 ? 'selected' : '' }}>Up to ~@price(182500)</option>
                            <option value="365000" {{ $maxPriceUgx === 365000 ? 'selected' : '' }}>Up to ~@price(365000)</option>
                            <option value="730000" {{ $maxPriceUgx === 730000 ? 'selected' : '' }}>Up to ~@price(730000)</option>
                        @endif
                    </select>
                </div>
            </div>

            @if($selectedDestinationId || $maxPriceUgx)
                <div class="active-filters-row">
                    <span class="active-filters-label">Active Filter:</span>
                    @if($selectedDestinationId)
                        @php $activeDest = $destinations->firstWhere('id', $selectedDestinationId); @endphp
                        <span class="filter-tag">{{ $activeDest->name ?? 'Destination' }} <a href="{{ request()->fullUrlWithQuery(['destination' => null]) }}">✕</a></span>
                    @endif
                    @if($maxPriceUgx)
                        <span class="filter-tag">Max @price($maxPriceUgx) <a href="{{ request()->fullUrlWithQuery(['max_price' => null]) }}">✕</a></span>
                    @endif
                    <a href="{{ url()->current() }}" class="clear-filters-link">Reset Filters</a>
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
            <span class="empty-icon">🔎</span>
            <h3>No results found matching your filters</h3>
            <p>Try broadening your price limit or viewing all destinations.</p>
            <a href="{{ url()->current() }}" class="btn btn-outline">Clear Filters</a>
        </div>
    @else
        <div class="browse-cards-grid">
            @foreach($items as $item)
                <div class="browse-card {{ $item['fits_plan'] ? 'fits-plan-card' : '' }}">
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
                        <span class="browse-dest-pill">📍 {{ $item['destination_name'] }}</span>
                    </div>

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
                                    🌐 Visit Official Website ↗
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
