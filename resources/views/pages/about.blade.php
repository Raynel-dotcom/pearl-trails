@extends('layouts.app')

@section('title', 'About Pearl Trails - Tourism Decision Assistant for Uganda')
@section('meta_description', 'Discover the story behind Pearl Trails, an intelligent tourism platform dedicated to transparent trip planning, local community empowerment, and eco-conservation across Uganda.')

@section('content')
<div class="about-page-wrapper">
    <!-- Header / Hero -->
    <div class="page-hero about-hero">
        <span class="quiz-badge">Our Mission & Story</span>
        <h1>About Pearl Trails</h1>
        <p>Connecting curious travellers with the majestic landscapes, rich wildlife, and warm hospitality of Uganda.</p>
    </div>

    <!-- 1. The Mission Story Card -->
    <div class="about-story-card">
        <div class="about-story-content">
            <span class="detail-label" style="display: block; margin-bottom: 0.5rem;">The Pearl of Africa Decision Assistant</span>
            <h2>Guiding Your Journey Through Uganda with Clarity</h2>
            <p>
                Pearl Trails was created to eliminate the uncertainty from exploring Uganda. Whether you have 24 hours for a whitewater excursion in Jinja, a weekend retreat amidst volcanic crater lakes, or two weeks traversing the Rwenzori snow peaks and Kidepo savannahs, we provide the clarity you need.
            </p>
            <p>
                We unite transparent budget estimates, realistic driving times, official Uganda Wildlife Authority (UWA) tariffs, and authentic local recommendations into an effortless, personalized travel experience.
            </p>
            <p>
                Our platform gives independent travellers, families, and safari explorers total confidence to discover the true Pearl of Africa on their own terms.
            </p>
        </div>
    </div>

    <!-- 2. Platform Highlights / Stats Strip -->
    <div class="about-stats-grid">
        <div class="about-stat-card">
            <span class="about-stat-number">13</span>
            <span class="about-stat-label">Iconic Destinations Covered</span>
        </div>
        <div class="about-stat-card">
            <span class="about-stat-number">155+</span>
            <span class="about-stat-label">Lodges, Diners & Experiences</span>
        </div>
        <div class="about-stat-card">
            <span class="about-stat-number">4</span>
            <span class="about-stat-label">Currencies Supported (UGX, USD, EUR, GBP)</span>
        </div>
        <div class="about-stat-card">
            <span class="about-stat-number">100%</span>
            <span class="about-stat-label">Transparent Cost Calculations</span>
        </div>
    </div>

    <!-- 3. Core Commitments -->
    <div class="about-section-header">
        <span class="quiz-badge">What Drives Us</span>
        <h3>Our Core Commitments</h3>
    </div>

    <div class="about-values-grid">
        <!-- Value 1 -->
        <div class="about-value-card">
            <div class="about-value-icon" aria-hidden="true">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="1" x2="12" y2="23"></line>
                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                </svg>
            </div>
            <h4 class="about-value-title">Fair Pricing Transparency</h4>
            <p class="about-value-desc">
                No hidden charges or inflated tourist marks. Every estimate transparently breaks down transport, stay options, food, and official park tariffs.
            </p>
        </div>

        <!-- Value 2 -->
        <div class="about-value-card">
            <div class="about-value-icon" aria-hidden="true">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
            </div>
            <h4 class="about-value-title">Community-First Tourism</h4>
            <p class="about-value-desc">
                We empower homegrown Ugandan lodges, campsites, cultural storytellers, and diners by linking them directly with international and domestic travellers.
            </p>
        </div>

        <!-- Value 3 -->
        <div class="about-value-card">
            <div class="about-value-icon" aria-hidden="true">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                </svg>
            </div>
            <h4 class="about-value-title">Eco-Conservation & Wildlife</h4>
            <p class="about-value-desc">
                We advocate for ethical travel that safeguards endangered mountain gorillas, chimpanzee corridors, and delicate afro-alpine habitats for generations to come.
            </p>
        </div>
    </div>

    <!-- 4. Winston Churchill Quote Card -->
    <div class="about-quote-card">
        <span class="quote-mark" aria-hidden="true">&ldquo;</span>
        <blockquote class="about-quote-text">
            For magnificence, for novelty, for the vast scale of each separate detail, it is no exaggeration to say that the scenery of Uganda has no equal in the whole expanse of Africa... Call it the Pearl of Africa.
        </blockquote>
        <span class="about-quote-author">Sir Winston Churchill — My African Journey (1908)</span>
    </div>

    <!-- 5. Dual Action Cards (Same styling as Contact page) -->
    <div class="about-cta-grid">
        <div class="about-cta-card">
            <div>
                <span class="detail-label" style="display: block; margin-bottom: 0.4rem;">Start Exploring</span>
                <h4>Plan Your Custom Uganda Trip</h4>
                <p>
                    Take our 7-step travel wizard to find destinations that align with your budget, duration, travel companions, and preferred adventures.
                </p>
            </div>
            <div>
                <a href="{{ route('plan') }}" class="btn-gold">
                    Start Planning (Quiz) &rarr;
                </a>
            </div>
        </div>

        <div class="about-cta-card vendor-alt">
            <div>
                <span class="detail-label" style="display: block; margin-bottom: 0.4rem;">Partner With Us</span>
                <h4>List Your Tourism Business</h4>
                <p>
                    Operate a safari lodge, guest house, traditional restaurant, or outdoor recreation activity in Uganda? Reach visitors from around the world.
                </p>
            </div>
            <div>
                <a href="{{ route('list-your-business') }}" class="btn-vendor-outline">
                    List Your Business &rarr;
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
