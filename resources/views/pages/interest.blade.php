@extends('layouts.app')
@section('title', 'Explore by Interest' . (!empty($interest) ? ': ' . ucfirst($interest) : '') . ' - Pearl Trails')
@section('meta_description', 'Browse Uganda destinations by interest — wildlife safaris, gorilla trekking, cultural trails, birding, water sports, and more.')

@section('content')
<div class="destinations-page-container">
    <div class="page-hero">
        @if(!empty($interest))
            <span class="quiz-badge">Interest: {{ ucfirst($interest) }}</span>
            <h1>Explore by Interest: {{ ucfirst($interest) }}</h1>
            <p>Showing destinations matching <strong>{{ ucfirst($interest) }}</strong>. <a href="{{ route('interest') }}" class="clear-filters-link" style="margin-left: 0.5rem;">Clear filter ✕</a></p>
        @else
            <span class="quiz-badge">Explore Uganda</span>
            <h1>Explore by Interest</h1>
            <p>Choose an interest below to discover iconic Uganda destinations tailored to your passion.</p>
        @endif
    </div>

    @if(!empty($interests))
        <div class="interest-chips-flex" style="margin-bottom: 2.5rem; display: flex; flex-wrap: wrap; gap: 0.6rem; justify-content: center;">
            @foreach($interests as $chip)
                <a href="{{ route('interest', ['interest' => strtolower($chip)]) }}"
                   class="interest-chip-btn {{ (!empty($interest) && strtolower($interest) === strtolower($chip)) ? 'active' : '' }}">
                    <span class="chip-label">{{ $chip }}</span>
                </a>
            @endforeach
        </div>
    @endif

    @if(!empty($destinations) && $destinations->count())
        <div class="destinations-grid">
            @foreach($destinations as $dest)
                <div class="dest-card">
                    <div class="dest-card-media">
                        @if(!empty($dest->image_path))
                            <img src="{{ asset($dest->image_path) }}" alt="{{ $dest->name }}" class="dest-card-img" loading="lazy">
                        @else
                            <x-scene-svg :destination="$dest" height="210px" />
                        @endif
                        <span class="region-badge">{{ $dest->region }} Uganda</span>
                        <span class="duration-badge">{{ $dest->min_days }}-{{ $dest->max_days }} Days</span>
                    </div>
                    <div class="dest-card-body">
                        <h3 class="dest-title">{{ $dest->name }}</h3>
                        <p class="dest-desc">{{ Str::limit($dest->description, 110) }}</p>
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
    @else
        <div class="empty-state-card">
            <h3>No destinations found for this interest</h3>
            <p>Try exploring our other interest categories or view all destinations.</p>
            <div style="margin-top: 1.5rem; display: flex; gap: 1rem; justify-content: center;">
                <a href="{{ route('interest') }}" class="btn btn-primary">All Interests</a>
                <a href="{{ route('destinations') }}" class="btn btn-outline">All Destinations</a>
            </div>
        </div>
    @endif
</div>

@if($destinations->count())
    <div class="destinations-grid">
        @foreach($destinations as $dest)
            <div class="dest-card">
                <div class="dest-card-media">
                    @if(!empty($dest->image_path))
                        <img src="{{ asset($dest->image_path) }}" alt="{{ $dest->name }}" class="dest-card-img" loading="lazy">
                    @endif
                    <span class="region-badge">{{ $dest->region }} Uganda</span>
                    <span class="duration-badge">{{ $dest->min_days }}-{{ $dest->max_days }} Days</span>
                </div>
                <div class="dest-card-body">
                    <h3 class="dest-title">{{ $dest->name }}</h3>
                    <p class="dest-desc">{{ Str::limit($dest->description, 110) }}</p>
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
@else
    <div class="content-card">
        <p>No destinations match this interest yet. <a href="{{ route('interest') }}">Browse all interests</a> or <a href="{{ route('destinations') }}">view all destinations</a>.</p>
    </div>
@endif
@endsection
