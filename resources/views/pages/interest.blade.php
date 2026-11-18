@extends('layouts.app')
@section('title', 'Explore by Interest' . (!empty($interest) ? ': ' . ucfirst($interest) : '') . ' - Pearl Trails')
@section('meta_description', 'Browse Uganda destinations by interest — wildlife safaris, gorilla trekking, cultural trails, birding, water sports, and more.')

@section('content')
<div class="interest-page-wrapper topo-pattern">
    <div class="container">
        <!-- Editorial Hero Header -->
        <div class="page-hero-editorial">
            <span class="ref-kicker">— CURATED EXPERIENCES —</span>
            @if(!empty($interest))
                <h1 class="page-hero-title">Explore Uganda by Interest: {{ ucfirst($interest) }}</h1>
                <p class="page-hero-subtitle">
                    Showing destinations matching <strong>{{ ucfirst($interest) }}</strong> across Uganda. <a href="{{ route('interest') }}" style="color: var(--color-gold); text-decoration: underline; margin-left: 0.5rem;">Clear filter ✕</a>
                </p>
            @else
                <h1 class="page-hero-title">Explore Uganda by Interest</h1>
                <p class="page-hero-subtitle">
                    Select your preferred adventure style below to discover curated Uganda destinations tailored to your passion.
                </p>
            @endif
        </div>

        <!-- Interest Category Chips Bar -->
        <div class="interest-chips-flex" style="margin-bottom: 3rem; display: flex; gap: 0.75rem; flex-wrap: wrap; justify-content: center;">
            @foreach($interests as $chip)
                <a href="{{ route('interest', ['interest' => strtolower($chip)]) }}"
                   class="btn btn-sm {{ (!empty($interest) && strtolower($interest) === strtolower($chip)) ? 'btn-gold' : 'btn-outline' }}"
                   style="border-radius: var(--radius-full); text-transform: uppercase; font-size: 0.78rem; letter-spacing: 0.08em;">
                    <span>{{ $chip }}</span>
                </a>
            @endforeach
        </div>

        @if($destinations->count())
            <div class="destinations-main-grid">
                @foreach($destinations as $dest)
                    <div class="dest-main-card">
                        <div class="dest-main-media">
                            @if(!empty($dest->image_path))
                                <img src="{{ asset($dest->image_path) }}" alt="{{ $dest->name }}" class="dest-main-img" loading="lazy">
                            @endif
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
                            <p class="dest-main-desc">{{ Str::limit($dest->description, 120) }}</p>
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
        @else
            <div class="empty-state-card" style="text-align: center; padding: 4rem 2rem; background: var(--bg-surface); border-radius: var(--radius-md); border: 1px solid var(--border-color); margin-bottom: 4rem;">
                <p>No destinations match this interest yet. <a href="{{ route('interest') }}" style="color: var(--color-gold); font-weight: 700;">Browse all interests</a> or <a href="{{ route('destinations') }}" style="color: var(--color-gold); font-weight: 700;">view all destinations</a>.</p>
            </div>
        @endif
    </div>
</div>
@endsection