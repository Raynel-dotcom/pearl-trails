@extends('layouts.app')
@section('title', 'Uganda Travel Guide — Essential Safari Advice & Tips - Pearl Trails')
@section('meta_description', 'Everything you need to know before visiting Uganda: mountain gorilla trekking rules, weather seasons, packing advice, health requirements, and currency.')

@section('content')
<div class="guide-page-wrapper topo-pattern" style="padding: 4rem 0 6rem;">
    <div class="container">
        <!-- Editorial Hero Header -->
        <div class="page-hero-editorial" style="margin-bottom: 4rem;">
            <span class="glass-badge glass-badge-gold" style="margin-bottom: 1rem;">Uganda Travel Guide</span>
            <h1 class="page-hero-title">The Essential Uganda Travel Guide</h1>
            <p class="page-hero-subtitle">
                Everything you need to know before stepping foot into the Pearl of Africa: gorilla permits, dry seasons, health requirements, currency tips, and safari etiquette.
            </p>
        </div>

        <!-- Guide Articles Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(360px, 1fr)); gap: 2.5rem; margin-bottom: 5rem;">
            
            <!-- Article 1: Gorilla Trekking -->
            <article class="browse-item-card">
                <div class="browse-card-media" style="height: 240px;">
                    <img src="{{ asset('images/destinations/bwindi-gorilla-1.webp') }}" alt="Mountain Gorilla Trekking in Bwindi" class="browse-card-img">
                    <span class="glass-badge" style="position: absolute; top: 1rem; left: 1rem;">Wildlife & Conservation</span>
                </div>
                <div class="browse-card-body">
                    <span style="font-size: 0.78rem; font-weight: 700; color: var(--color-gold); text-transform: uppercase;">Primate Rules</span>
                    <h3 style="font-size: 1.4rem; color: var(--text-heading); margin: 0.4rem 0 0.8rem;">Gorilla Trekking Permits & Etiquette</h3>
                    <p style="font-size: 0.92rem; color: var(--text-muted); line-height: 1.6; margin-bottom: 1.25rem;">
                        Mountain gorilla trekking permits are issued strictly by the Uganda Wildlife Authority (UWA). You must be at least 15 years old. When with the gorilla family, a distance of 7 to 10 meters is maintained to protect primates from human pathogens.
                    </p>
                    <a href="{{ route('destinations.show', 'bwindi') }}" class="browse-action-link" style="font-weight: 700;">
                        Explore Bwindi Impenetrable NP →
                    </a>
                </div>
            </article>

            <!-- Article 2: Best Time to Visit -->
            <article class="browse-item-card">
                <div class="browse-card-media" style="height: 240px;">
                    <img src="{{ asset('images/destinations/murchison-falls-np.webp') }}" alt="Murchison Falls National Park" class="browse-card-img">
                    <span class="glass-badge" style="position: absolute; top: 1rem; left: 1rem;">Weather & Seasons</span>
                </div>
                <div class="browse-card-body">
                    <span style="font-size: 0.78rem; font-weight: 700; color: var(--color-gold); text-transform: uppercase;">Climate Insights</span>
                    <h3 style="font-size: 1.4rem; color: var(--text-heading); margin: 0.4rem 0 0.8rem;">When to Visit: Dry vs Green Seasons</h3>
                    <p style="font-size: 0.92rem; color: var(--text-muted); line-height: 1.6; margin-bottom: 1.25rem;">
                        Uganda is a year-round destination thanks to its equatorial altitude. However, the best months for wildlife viewing and gorilla trekking are the two dry seasons: <strong>June to August</strong> and <strong>December to February</strong>, when trails are firmer and animals congregate around waterholes.
                    </p>
                    <a href="{{ route('destinations') }}" class="browse-action-link" style="font-weight: 700;">
                        Browse All 13 Destinations →
                    </a>
                </div>
            </article>

            <!-- Article 3: Currency & Tipping -->
            <article class="browse-item-card">
                <div class="browse-card-media" style="height: 240px;">
                    <img src="{{ asset('images/destinations/entebbe-lake-victoria.webp') }}" alt="Lake Victoria Entebbe" class="browse-card-img">
                    <span class="glass-badge" style="position: absolute; top: 1rem; left: 1rem;">Money & Practicalities</span>
                </div>
                <div class="browse-card-body">
                    <span style="font-size: 0.78rem; font-weight: 700; color: var(--color-gold); text-transform: uppercase;">Financial Guide</span>
                    <h3 style="font-size: 1.4rem; color: var(--text-heading); margin: 0.4rem 0 0.8rem;">Currency, Mobile Money & Cards</h3>
                    <p style="font-size: 0.92rem; color: var(--text-muted); line-height: 1.6; margin-bottom: 1.25rem;">
                        The local currency is the Ugandan Shilling (UGX). While high-end safari lodges accept credit cards and US Dollars (printed in 2013 or newer), carrying cash in UGX is essential for park gate tips, fruit markets, rolex stands, and community crafts.
                    </p>
                    <a href="{{ route('plan') }}" class="browse-action-link" style="font-weight: 700;">
                        Calculate Your Trip Budget →
                    </a>
                </div>
            </article>

            <!-- Article 4: Packing Essentials -->
            <article class="browse-item-card">
                <div class="browse-card-media" style="height: 240px;">
                    <img src="{{ asset('images/destinations/sipi-falls-3.webp') }}" alt="Sipi Falls Hiking" class="browse-card-img">
                    <span class="glass-badge" style="position: absolute; top: 1rem; left: 1rem;">Preparation</span>
                </div>
                <div class="browse-card-body">
                    <span style="font-size: 0.78rem; font-weight: 700; color: var(--color-gold); text-transform: uppercase;">Packing Guide</span>
                    <h3 style="font-size: 1.4rem; color: var(--text-heading); margin: 0.4rem 0 0.8rem;">Packing for a Ugandan Safari</h3>
                    <p style="font-size: 0.92rem; color: var(--text-muted); line-height: 1.6; margin-bottom: 1.25rem;">
                        Pack sturdy waterproof hiking boots, long gaiters or thick socks to tuck trousers against safari ants, a lightweight rain jacket, neutral earth tones (khaki, olive, beige; avoid bright blue and black which attract tsetse flies), and high SPF sunscreen.
                    </p>
                    <a href="{{ route('recreation') }}" class="browse-action-link" style="font-weight: 700;">
                        Explore Outdoor Activities →
                    </a>
                </div>
            </article>

            <!-- Article 5: Health & Vaccinations -->
            <article class="browse-item-card">
                <div class="browse-card-media" style="height: 240px;">
                    <img src="{{ asset('images/destinations/lake-bunyonyi-view.webp') }}" alt="Lake Bunyonyi Hills" class="browse-card-img">
                    <span class="glass-badge" style="position: absolute; top: 1rem; left: 1rem;">Health & Wellness</span>
                </div>
                <div class="browse-card-body">
                    <span style="font-size: 0.78rem; font-weight: 700; color: var(--color-gold); text-transform: uppercase;">Safety</span>
                    <h3 style="font-size: 1.4rem; color: var(--text-heading); margin: 0.4rem 0 0.8rem;">Health & Yellow Fever Certificate</h3>
                    <p style="font-size: 0.92rem; color: var(--text-muted); line-height: 1.6; margin-bottom: 1.25rem;">
                        Proof of Yellow Fever vaccination is mandatory for entry into Uganda. Consult your travel clinic regarding malaria prophylaxis. Drink bottled or filtered water throughout your safari, and enjoy Lake Bunyonyi (which is famously free from bilharzia!).
                    </p>
                    <a href="{{ route('about') }}" class="browse-action-link" style="font-weight: 700;">
                        Read Our Eco Commitment →
                    </a>
                </div>
            </article>

            <!-- Article 6: Transport & Road Travel -->
            <article class="browse-item-card">
                <div class="browse-card-media" style="height: 240px;">
                    <img src="{{ asset('images/destinations/jinja-quad-biking.webp') }}" alt="River Nile Highway" class="browse-card-img">
                    <span class="glass-badge" style="position: absolute; top: 1rem; left: 1rem;">Navigation</span>
                </div>
                <div class="browse-card-body">
                    <span style="font-size: 0.78rem; font-weight: 700; color: var(--color-gold); text-transform: uppercase;">Road Travel</span>
                    <h3 style="font-size: 1.4rem; color: var(--text-heading); margin: 0.4rem 0 0.8rem;">Highway Travel & Google Maps</h3>
                    <p style="font-size: 0.92rem; color: var(--text-muted); line-height: 1.6; margin-bottom: 1.25rem;">
                        Uganda drives on the left. Major corridors (Kampala–Jinja, Kampala–Masaka–Mbarara) are smooth tarmac, while park tracks require 4x4 clearance. Pearl Trails provides exact highway mileage, driving time, and 1-click live Google Maps navigation for all destinations.
                    </p>
                    <a href="{{ route('destinations.show', 'jinja') }}" class="browse-action-link" style="font-weight: 700;">
                        View Live Route Navigation →
                    </a>
                </div>
            </article>

        </div>

        <!-- Planning CTA -->
        <div class="cta-banner-box" style="background: var(--bg-surface); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 3rem; box-shadow: var(--shadow-sm); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 2rem;">
            <div>
                <h2 style="font-size: 2rem; color: var(--text-heading); margin-bottom: 0.5rem;">Have specific questions about planning your safari?</h2>
                <p style="color: var(--text-muted); max-width: 650px;">
                    Our team of Uganda travel specialists is based in Kampala and ready to help you coordinate accommodation, park permits, or custom itineraries.
                </p>
            </div>
            <div style="display: flex; gap: 1rem;">
                <a href="{{ route('contact') }}" class="btn btn-primary">Contact Our Team</a>
                <a href="{{ route('plan') }}" class="btn btn-gold">Plan My Trip</a>
            </div>
        </div>
    </div>
</div>
@endsection
