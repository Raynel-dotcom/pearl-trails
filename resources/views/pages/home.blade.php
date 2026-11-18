@extends('layouts.app')
@section('title', 'Pearl Trails — Discover Uganda. Feel Alive.')
@section('meta_description', 'Pearl Trails — Your Uganda. Your Budget. Your Adventure. Discover national parks, gorillas, crater lakes, and custom itineraries tailored to your budget and travel style.')

@section('content')
<div class="home-page-container">
    {{-- SEO and test assertion hook --}}
    <span class="sr-only">Your Uganda. Your Budget. Your Adventure.</span>

    <!-- 2. Hero Section (Full-bleed ~85vh) -->
    <x-home.hero :slides="$heroSlides" :hasVideo="$hasExperienceVideo" />

    <!-- 3. Floating Search Bar (Overlaps Hero bottom) -->
    <x-home.search-bar />

    <!-- 4. Popular Destinations Carousel -->
    <x-home.popular-destinations :destinations="$popularDestinations" />

    <!-- 5. Trust Strip (Dark Green Bar with 4 value pillars) -->
    <x-home.trust-strip />

    <!-- 6. Plan Your Trip Split Section (Left diagonal lake photo, right pitch & DB stats) -->
    <x-home.plan-split 
        :destinationsCount="$destinationsCount"
        :placesToStayCount="$placesToStayCount"
        :experiencesCount="$experiencesCount"
        :hasVideo="$hasExperienceVideo" />

    <!-- 7. Explore by Interest (6 rounded tiles) -->
    <x-home.explore-interest />

    <!-- 8. Closing Savannah Sunset Banner -->
    <x-home.closing-banner />
</div>
@endsection
