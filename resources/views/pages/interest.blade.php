@extends('layouts.app')
@section('title', 'Explore by Interest' . (!empty($interest) ? ': ' . ucfirst($interest) : '') . ' - Pearl Trails')
@section('meta_description', 'Browse Uganda destinations by interest — wildlife safaris, gorilla trekking, cultural trails, birding, water sports, and more.')

@section('content')
<div class="page-hero">
    @if(!empty($interest))
        <h1>Explore Uganda by Interest: {{ ucfirst($interest) }}</h1>
        <p>Showing destinations that match <strong>{{ ucfirst($interest) }}</strong>. <a href="{{ route('interest') }}">Clear filter ✕</a></p>
    @else
        <h1>Explore Uganda by Interest</h1>
        <p>Choose an interest below to filter Uganda destinations by what excites you most.</p>
    @endif
</div>

<div class="interest-chips-flex" style="margin-bottom: 2rem;">
    @foreach($interests as $chip)
        <a href="{{ route('interest', ['interest' => strtolower($chip)]) }}"
           class="interest-chip-btn {{ (!empty($interest) && strtolower($interest) === strtolower($chip)) ? 'active' : '' }}">
            <span class="chip-label">{{ $chip }}</span>
        </a>
    @endforeach
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
