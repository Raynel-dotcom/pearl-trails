<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'Pearl Trails')) — The Pearl of Africa</title>
    <meta name="description" content="@yield('meta_description', 'Pearl Trails is Uganda\'s premier travel and tourism discovery platform. Explore national parks, misty gorilla forests, crater lakes, white-water Nile rapids, and tailor-made safari itineraries.')">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    <!-- Google Fonts: Cormorant Garamond, Playfair Display, Caveat & DM Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@600;700&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,600;1,700&family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ @filemtime(public_path('css/app.css')) ?: '2.0' }}">
    
    <script>
        // Check for saved dark mode preference
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="{{ request()->routeIs('home') ? 'is-home-page' : 'is-inner-page' }}">
    <!-- 1. GLOBAL NAVIGATION BAR -->
    <header class="site-header {{ request()->routeIs('home') ? 'header-home-overlay' : 'header-solid' }}" id="siteHeader">
        <div class="nav-container nav-wrapper">
            <!-- Brand Logo (Mountain & Safari Trails Emblem) -->
            <a href="{{ route('home') }}" class="brand-logo" aria-label="Pearl Trails Home">
                <span class="logo-emblem-svg" aria-hidden="true">
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none">
                        <path d="M3 21L10 8L15 16L18 12L25 21H3Z" fill="url(#goldLogoGrad)" stroke="#D6A84B" stroke-width="1.2" stroke-linejoin="round"/>
                        <path d="M9 21C9 17 13 14 15 14C17.5 14 18 18 21 21" stroke="#F5F2E9" stroke-width="1.4" stroke-linecap="round"/>
                        <circle cx="21" cy="8" r="2.5" fill="#D6A84B"/>
                        <defs>
                            <linearGradient id="goldLogoGrad" x1="14" y1="8" x2="14" y2="21" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#E5BA5F"/>
                                <stop offset="1" stop-color="#B88628"/>
                            </linearGradient>
                        </defs>
                    </svg>
                </span>
                <span class="brand-text-group">
                    <span class="brand-name">PEARL TRAILS</span>
                    <span class="brand-tagline">THE PEARL OF AFRICA</span>
                </span>
            </a>

            <!-- Reference Pill Navigation Menu (Desktop) -->
            <nav class="nav-primary-desktop nav-pill-bar" aria-label="Main Navigation">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    Home
                </a>

                <!-- Destinations Dropdown -->
                <div class="nav-dropdown-item">
                    <a href="{{ route('destinations') }}" class="nav-link nav-dropdown-trigger {{ request()->routeIs('destinations*') ? 'active' : '' }}">
                        Destinations <span class="nav-caret">▾</span>
                    </a>
                    <div class="nav-dropdown-menu">
                        <a href="{{ route('destinations') }}" class="dropdown-link">All 13 Destinations</a>
                        <a href="{{ route('destinations.show', 'bwindi-impenetrable-np') }}" class="dropdown-link">Bwindi Impenetrable NP</a>
                        <a href="{{ route('destinations.show', 'murchison-falls-np') }}" class="dropdown-link">Murchison Falls NP</a>
                        <a href="{{ route('destinations.show', 'queen-elizabeth-np') }}" class="dropdown-link">Queen Elizabeth NP</a>
                        <a href="{{ route('destinations.show', 'jinja') }}" class="dropdown-link">Jinja & River Nile</a>
                        <a href="{{ route('destinations.show', 'lake-bunyonyi') }}" class="dropdown-link">Lake Bunyonyi</a>
                        <a href="{{ route('destinations.show', 'sipi-falls') }}" class="dropdown-link">Sipi Falls</a>
                    </div>
                </div>

                <!-- Where to Stay Dropdown -->
                <div class="nav-dropdown-item">
                    <a href="{{ route('stays') }}" class="nav-link nav-dropdown-trigger {{ request()->routeIs('stays*') ? 'active' : '' }}">
                        Where to Stay <span class="nav-caret">▾</span>
                    </a>
                    <div class="nav-dropdown-menu">
                        <a href="{{ route('stays') }}" class="dropdown-link">All Accommodation</a>
                        <a href="{{ route('stays', ['destination' => 1]) }}" class="dropdown-link">Bwindi Gorilla Lodges</a>
                        <a href="{{ route('stays', ['destination' => 2]) }}" class="dropdown-link">Murchison Nile Camps</a>
                        <a href="{{ route('stays', ['destination' => 5]) }}" class="dropdown-link">Bunyonyi Island Resorts</a>
                    </div>
                </div>

                <!-- Where to Eat Dropdown -->
                <div class="nav-dropdown-item">
                    <a href="{{ route('eat') }}" class="nav-link nav-dropdown-trigger {{ request()->routeIs('eat*') ? 'active' : '' }}">
                        Where to Eat <span class="nav-caret">▾</span>
                    </a>
                    <div class="nav-dropdown-menu">
                        <a href="{{ route('eat') }}" class="dropdown-link">All Dining & Cuisine</a>
                        <a href="{{ route('eat', ['destination' => 4]) }}" class="dropdown-link">Jinja Waterfront Dining</a>
                        <a href="{{ route('eat', ['destination' => 10]) }}" class="dropdown-link">Kampala Food Scene</a>
                    </div>
                </div>

                <!-- Recreation & Fun Dropdown -->
                <div class="nav-dropdown-item">
                    <a href="{{ route('recreation') }}" class="nav-link nav-dropdown-trigger {{ request()->routeIs('recreation*') ? 'active' : '' }}">
                        Recreation & Fun <span class="nav-caret">▾</span>
                    </a>
                    <div class="nav-dropdown-menu">
                        <a href="{{ route('recreation') }}" class="dropdown-link">All Day Activities</a>
                        <a href="{{ route('interest', ['interest' => 'adventure']) }}" class="dropdown-link">White-Water Rafting</a>
                        <a href="{{ route('interest', ['interest' => 'wildlife']) }}" class="dropdown-link">Primate Tracking</a>
                    </div>
                </div>

                <!-- Plan My Trip Dropdown -->
                <div class="nav-dropdown-item">
                    <a href="{{ route('plan') }}" class="nav-link nav-dropdown-trigger {{ request()->routeIs('plan*') ? 'active' : '' }}">
                        Plan My Trip <span class="nav-caret">▾</span>
                    </a>
                    <div class="nav-dropdown-menu">
                        <a href="{{ route('plan') }}" class="dropdown-link">7-Step Safari Wizard</a>
                        <a href="{{ route('saved') }}" class="dropdown-link">Saved Itineraries</a>
                    </div>
                </div>

                <!-- More Dropdown -->
                <div class="nav-dropdown-item">
                    <span class="nav-link nav-dropdown-trigger {{ request()->routeIs('about*') || request()->routeIs('contact*') || request()->routeIs('guide*') ? 'active' : '' }}" style="cursor: pointer;">
                        More <span class="nav-caret">▾</span>
                    </span>
                    <div class="nav-dropdown-menu">
                        <a href="{{ route('guide') }}" class="dropdown-link">Uganda Travel Guide</a>
                        <a href="{{ route('about') }}" class="dropdown-link">About Pearl Trails</a>
                        <a href="{{ route('contact') }}" class="dropdown-link">Contact & Inquiries</a>
                        <a href="{{ route('list-your-business') }}" class="dropdown-link">List Your Business</a>
                    </div>
                </div>
            </nav>

            <!-- Header Right Controls -->
            <div class="nav-actions-right">
                <!-- Theme Toggle & Search Pill -->
                <div class="nav-tool-pill">
                    <button class="theme-toggle-btn" id="themeToggleBtn" title="Toggle Light / Dark Theme" aria-label="Toggle Theme">
                        <svg class="theme-svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
                    </button>
                    <a href="{{ route('destinations') }}" class="nav-search-btn" title="Search Destinations" aria-label="Search">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    </a>
                </div>

                <!-- Currency Dropdown -->
                <div class="currency-dropdown-wrapper">
                    <label for="currencySelect" class="sr-only">Currency</label>
                    <select id="currencySelect" class="currency-select" onchange="window.location.href='/currency/' + this.value">
                        @foreach($supportedCurrencies ?? ['UGX', 'USD', 'EUR', 'GBP'] as $curr)
                            <option value="{{ $curr }}" {{ ($currentCurrency ?? 'UGX') === $curr ? 'selected' : '' }}>
                                {{ $curr }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Plan Your Trip CTA Button -->
                <a href="{{ route('plan') }}" class="btn-plan-trip-header">
                    <span>Plan Your Trip</span>
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 4px;"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>

                <!-- Hamburger Menu Button (Mobile) -->
                <button class="hamburger-btn" id="hamburgerBtn" aria-label="Toggle Navigation Menu" aria-expanded="false">
                    <span id="hamburgerIcon" aria-hidden="true">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                    </span>
                    <span class="hamburger-label">Menu</span>
                </button>
            </div>

            <!-- Hamburger Drawer Menu -->
            <div class="nav-drawer" id="navDrawer" role="dialog" aria-label="Site Navigation">
                <div class="drawer-header">
                    <div class="drawer-brand">
                        <span class="logo-emblem-svg" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon>
                            </svg>
                        </span>
                        <div>
                            <div style="font-weight: 800; font-family: var(--font-serif); font-size: 1.1rem; letter-spacing: 0.5px;">PEARL TRAILS</div>
                            <div style="font-size: 0.68rem; color: var(--color-gold); letter-spacing: 1px;">THE PEARL OF AFRICA</div>
                        </div>
                    </div>
                    <button class="drawer-close-btn" id="drawerCloseBtn" aria-label="Close Navigation Menu">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <div class="drawer-content">
                    <!-- Explore Links -->
                    <div class="drawer-section">
                        <span class="drawer-section-title">Discover Uganda</span>
                        <a href="{{ route('home') }}" class="drawer-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                        <a href="{{ route('destinations') }}" class="drawer-link {{ request()->routeIs('destinations*') ? 'active' : '' }}">Destinations</a>
                        <a href="{{ route('interest') }}" class="drawer-link {{ request()->routeIs('interest*') || request()->routeIs('experiences*') ? 'active' : '' }}">Experiences & Activities</a>
                        <a href="{{ route('recreation') }}" class="drawer-link {{ request()->routeIs('recreation*') ? 'active' : '' }}">Recreational Centers</a>
                        <a href="{{ route('stays') }}" class="drawer-link {{ request()->routeIs('stays*') ? 'active' : '' }}">Accommodation & Lodges</a>
                        <a href="{{ route('eat') }}" class="drawer-link {{ request()->routeIs('eat*') ? 'active' : '' }}">Dining & Cuisine</a>
                    </div>

                    <!-- Planning & Guide -->
                    <div class="drawer-section">
                        <span class="drawer-section-title">Trip Planning</span>
                        <a href="{{ route('plan') }}" class="drawer-link {{ request()->routeIs('plan*') ? 'active' : '' }}">Plan Your Adventure (Interactive)</a>
                        <a href="{{ route('guide') }}" class="drawer-link {{ request()->routeIs('guide*') ? 'active' : '' }}">Uganda Travel Guide</a>
                        <a href="{{ route('saved') }}" class="drawer-link {{ request()->routeIs('saved*') ? 'active' : '' }}">Saved Itineraries</a>
                    </div>

                    <!-- Company & Partner Links -->
                    <div class="drawer-section">
                        <span class="drawer-section-title">Pearl Trails</span>
                        <a href="{{ route('about') }}" class="drawer-link {{ request()->routeIs('about*') ? 'active' : '' }}">About Us</a>
                        <a href="{{ route('contact') }}" class="drawer-link {{ request()->routeIs('contact*') ? 'active' : '' }}">Contact Us</a>
                        <a href="{{ route('list-your-business') }}" class="drawer-link {{ request()->routeIs('list-your-business*') || request()->routeIs('list-business*') ? 'active' : '' }}">List Your Tourism Enterprise</a>
                        <a href="{{ route('privacy') }}" class="drawer-link {{ request()->routeIs('privacy*') ? 'active' : '' }}">Privacy Policy</a>
                        <a href="{{ route('terms') }}" class="drawer-link {{ request()->routeIs('terms*') ? 'active' : '' }}">Terms of Service</a>
                    </div>

                    <!-- Account / Moderation -->
                    <div class="drawer-section drawer-auth-section">
                        <span class="drawer-section-title">My Account</span>
                        @auth
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.listings') }}" class="drawer-link {{ request()->routeIs('admin*') ? 'active' : '' }}">Admin Moderation</a>
                            @elseif(auth()->user()->isVendor())
                                <a href="{{ route('vendor.listings') }}" class="drawer-link {{ request()->routeIs('vendor*') ? 'active' : '' }}">Vendor Dashboard</a>
                            @endif
                            <a href="{{ route('profile.edit') }}" class="drawer-link {{ request()->routeIs('profile*') ? 'active' : '' }}">Profile Settings</a>
                            <form action="{{ route('logout') }}" method="POST" class="drawer-logout-form">
                                @csrf
                                <button type="submit" class="drawer-link drawer-logout-btn">Log Out ({{ auth()->user()->name }})</button>
                            </form>
                        @else
                            <div class="drawer-auth-buttons">
                                <a href="{{ route('login') }}" class="btn btn-outline btn-sm">Log In</a>
                                <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Sign Up</a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Backdrop Overlay -->
            <div class="drawer-backdrop" id="drawerBackdrop"></div>
        </div>
    </header>

    <!-- Main Content Area (Full bleed capable) -->
    <main class="main-content" id="mainContent">
        @yield('content')
    </main>

    <!-- 10. PREMIUM LUXURY FOOTER -->
    <footer class="site-footer">
        <div class="container footer-inner">
            <div class="footer-grid">
                <!-- Brand Statement Column -->
                <div class="footer-col-brand">
                    <div class="footer-logo">
                        <span class="logo-emblem-svg" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon>
                            </svg>
                        </span>
                        <span class="footer-brand-title">PEARL TRAILS</span>
                    </div>
                    <p class="footer-tagline-sub">THE PEARL OF AFRICA</p>
                    <p class="footer-mission">
                        A curated Ugandan travel and tourism platform inspiring visitors to discover mist-covered gorilla forests, roaring Nile waterfalls, serene island lakes, authentic cultural heritage, and unforgettable safari adventures.
                    </p>
                    <div class="footer-badges">
                        <span class="footer-badge">Authentic Uganda</span>
                        <span class="footer-badge">Verified Pricing</span>
                        <span class="footer-badge">Live Maps</span>
                    </div>
                </div>

                <!-- Navigation Column 1: Discover -->
                <div class="footer-col">
                    <h4 class="footer-heading">Discover Uganda</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('destinations') }}">All 13 Destinations</a></li>
                        <li><a href="{{ route('interest') }}">Experiences & Safaris</a></li>
                        <li><a href="{{ route('recreation') }}">Recreational Centers</a></li>
                        <li><a href="{{ route('stays') }}">Safari Lodges & Stays</a></li>
                        <li><a href="{{ route('eat') }}">Local Dining & Cafes</a></li>
                        <li><a href="{{ route('guide') }}">Uganda Travel Guide</a></li>
                    </ul>
                </div>

                <!-- Navigation Column 2: Planning & Tools -->
                <div class="footer-col">
                    <h4 class="footer-heading">Trip Planning</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('plan') }}">Plan Your Adventure</a></li>
                        <li><a href="{{ route('saved') }}">Saved Itineraries</a></li>
                        <li><a href="{{ route('list-your-business') }}">List Your Business</a></li>
                        <li><a href="{{ route('about') }}">About Pearl Trails</a></li>
                        <li><a href="{{ route('contact') }}">Contact & Inquiries</a></li>
                        <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('terms') }}">Terms of Service</a></li>
                    </ul>
                </div>

                <!-- Column 3: Newsletter & Contact -->
                <div class="footer-col footer-col-newsletter">
                    <h4 class="footer-heading">Newsletter</h4>
                    <p class="footer-newsletter-text">Receive curated seasonal itineraries, primate tracking updates, and safari stories straight from the Pearl of Africa.</p>
                    <form action="{{ route('contact') }}" method="GET" class="footer-newsletter-form">
                        <input type="email" placeholder="Your email address" aria-label="Email address" required class="newsletter-input">
                        <button type="submit" class="newsletter-btn">Subscribe</button>
                    </form>
                    <div class="footer-contact-snippet">
                        <span>Kampala, Uganda</span> &bull; 
                        <a href="mailto:pearltrailsug@gmail.com">pearltrailsug@gmail.com</a>
                    </div>
                </div>
            </div>

            <div class="footer-bottom-bar">
                <p>&copy; {{ date('Y') }} PEARL TRAILS. Handcrafted in Uganda. All rights reserved.</p>
                <div class="footer-bottom-links">
                    <a href="{{ route('privacy') }}">Privacy</a>
                    <a href="{{ route('terms') }}">Terms</a>
                    <a href="{{ route('contact') }}">Support</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Interactive Navigation & Theme Scripts -->
    <script>
        // Theme toggle
        const themeToggleBtn = document.getElementById('themeToggleBtn');
        const sunSvg = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>`;
        const moonSvg = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>`;
        
        function updateThemeIcon() {
            if (themeToggleBtn) {
                themeToggleBtn.innerHTML = document.documentElement.classList.contains('dark') ? sunSvg : moonSvg;
            }
        }
        if (themeToggleBtn) {
            themeToggleBtn.addEventListener('click', () => {
                const isDark = document.documentElement.classList.toggle('dark');
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
                updateThemeIcon();
            });
            updateThemeIcon();
        }

        // Homepage Transparent Navbar scroll effect
        const siteHeader = document.getElementById('siteHeader');
        if (document.body.classList.contains('is-home-page')) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 40) {
                    siteHeader.classList.add('header-scrolled');
                } else {
                    siteHeader.classList.remove('header-scrolled');
                }
            }, { passive: true });
        }

        // Drawer & Hamburger Navigation
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const hamburgerIcon = document.getElementById('hamburgerIcon');
        const navDrawer = document.getElementById('navDrawer');
        const drawerBackdrop = document.getElementById('drawerBackdrop');
        const drawerCloseBtn = document.getElementById('drawerCloseBtn');

        const hamburgerSvg = `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>`;
        const closeSvg = `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>`;

        function openDrawer() {
            navDrawer.classList.add('open');
            drawerBackdrop.classList.add('open');
            document.body.classList.add('drawer-active');
            hamburgerBtn.setAttribute('aria-expanded', 'true');
            if (hamburgerIcon) hamburgerIcon.innerHTML = closeSvg;
        }

        function closeDrawer() {
            navDrawer.classList.remove('open');
            drawerBackdrop.classList.remove('open');
            document.body.classList.remove('drawer-active');
            hamburgerBtn.setAttribute('aria-expanded', 'false');
            if (hamburgerIcon) hamburgerIcon.innerHTML = hamburgerSvg;
        }

        function toggleDrawer() {
            if (navDrawer.classList.contains('open')) {
                closeDrawer();
            } else {
                openDrawer();
            }
        }

        if (hamburgerBtn) hamburgerBtn.addEventListener('click', toggleDrawer);
        if (drawerCloseBtn) drawerCloseBtn.addEventListener('click', closeDrawer);
        if (drawerBackdrop) drawerBackdrop.addEventListener('click', closeDrawer);

        // Close on Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && navDrawer && navDrawer.classList.contains('open')) {
                closeDrawer();
            }
        });

        // Close drawer when any link inside is tapped
        document.querySelectorAll('.drawer-link').forEach(link => {
            link.addEventListener('click', closeDrawer);
        });
    </script>
</body>
</html>
