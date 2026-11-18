@extends('layouts.app')
@section('title', 'About Us — The Story Behind Pearl Trails Uganda')
@section('meta_description', 'Learn about Pearl Trails, Uganda\'s premier tourism discovery platform built to make safari exploration transparent, authentic, and accessible.')

@section('content')
<div class="about-page-wrapper topo-pattern" style="padding: 4rem 0 6rem;">
    <div class="container">
        <!-- Editorial Header -->
        <div class="page-hero-editorial" style="margin-bottom: 4rem;">
            <span class="glass-badge glass-badge-gold" style="margin-bottom: 1rem;">Brand Story</span>
            <h1 class="page-hero-title">About Pearl Trails</h1>
            <p class="page-hero-subtitle">
                Connecting curious global and domestic travelers with the majestic wonder, rich wildlife, and warm culture of the Pearl of Africa.
            </p>
        </div>

        <!-- Story & Pillars Grid -->
        <div class="about-editorial-grid">
            <div style="background: var(--bg-surface); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 3rem; box-shadow: var(--shadow-sm);">
                <span style="font-size: 0.78rem; font-weight: 700; color: var(--color-gold); text-transform: uppercase; letter-spacing: 1.5px;">Our Origins</span>
                <h2 style="font-size: 2rem; color: var(--text-heading); margin: 0.5rem 0 1.25rem;">The Pearl of Africa Decision Platform</h2>
                <p style="font-size: 1.05rem; line-height: 1.75; color: var(--text-main); margin-bottom: 1.25rem;">
                    Pearl Trails was founded with a single mission: to eliminate the guesswork, inflated agency markups, and friction from planning a trip across Uganda. From the mist-draped volcanic peaks of Bwindi to the thundering surge of Murchison Falls, Uganda is one of the most biodiverse countries on earth.
                </p>
                <p style="font-size: 1rem; line-height: 1.7; color: var(--text-muted);">
                    Whether you have 48 hours for a weekend river expedition in Jinja or two weeks to navigate the snow-capped Rwenzoris and the remote plains of Kidepo Valley, our platform pairs authentic local intelligence with transparent pricing and live Google navigation.
                </p>
            </div>

            <div style="background: var(--bg-surface); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 3rem; box-shadow: var(--shadow-sm); display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <span style="font-size: 0.78rem; font-weight: 700; color: var(--color-gold); text-transform: uppercase; letter-spacing: 1.5px;">Pillars of Integrity</span>
                    <h2 style="font-size: 2rem; color: var(--text-heading); margin: 0.5rem 0 1.25rem;">Our Core Commitments</h2>
                    
                    <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                        <div style="display: flex; gap: 1rem;">
                            <div style="font-weight: 800; color: var(--color-gold); font-size: 1.2rem;">01</div>
                            <div>
                                <h4 style="font-size: 1.1rem; color: var(--text-heading); margin-bottom: 0.2rem;">Fair Pricing Transparency</h4>
                                <p style="font-size: 0.9rem; color: var(--text-muted); line-height: 1.5;">All displayed rates reflect verified lodge rack rates, licensed ranger tariffs, and real transport estimates.</p>
                            </div>
                        </div>

                        <div style="display: flex; gap: 1rem;">
                            <div style="font-weight: 800; color: var(--color-gold); font-size: 1.2rem;">02</div>
                            <div>
                                <h4 style="font-size: 1.1rem; color: var(--text-heading); margin-bottom: 0.2rem;">Empowering Ugandan Enterprises</h4>
                                <p style="font-size: 0.9rem; color: var(--text-muted); line-height: 1.5;">We connect homegrown lodges, certified safari drivers, and community craft centres directly with travelers.</p>
                            </div>
                        </div>

                        <div style="display: flex; gap: 1rem;">
                            <div style="font-weight: 800; color: var(--color-gold); font-size: 1.2rem;">03</div>
                            <div>
                                <h4 style="font-size: 1.1rem; color: var(--text-heading); margin-bottom: 0.2rem;">Preservation & Eco-Tourism</h4>
                                <p style="font-size: 0.9rem; color: var(--text-muted); line-height: 1.5;">We champion responsible travel practices that safeguard endangered mountain gorillas, primates, and community forests.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="display: flex; gap: 1rem; margin-top: 2rem; flex-wrap: wrap;">
                    <a href="{{ route('plan') }}" class="btn btn-primary">Plan Your Custom Trip</a>
                    <a href="{{ route('list-business') }}" class="btn btn-outline">List Your Business</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
