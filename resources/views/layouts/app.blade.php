<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Pearl Trails — The Pearl of Africa')</title>
    <meta name="description" content="@yield('meta_description', 'Pearl Trails is Uganda\'s premier tourism decision platform. Explore national parks, misty gorilla forests, stays, restaurants, and custom itineraries.')">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600;700&family=Inter:ital,opsz,wght@0,14..32,400..700;1,14..32,400..700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

    <!-- CSS Design System Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/variables.css') }}?v={{ file_exists(public_path('css/variables.css')) ? filemtime(public_path('css/variables.css')) : time() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ file_exists(public_path('css/app.css')) ? filemtime(public_path('css/app.css')) : time() }}">
    <link rel="stylesheet" href="{{ asset('css/header-footer.css') }}?v={{ file_exists(public_path('css/header-footer.css')) ? filemtime(public_path('css/header-footer.css')) : time() }}">
    @if(request()->routeIs('home'))
        <link rel="stylesheet" href="{{ asset('css/home-hero.css') }}?v={{ file_exists(public_path('css/home-hero.css')) ? filemtime(public_path('css/home-hero.css')) : time() }}">
        <link rel="stylesheet" href="{{ asset('css/home-sections.css') }}?v={{ file_exists(public_path('css/home-sections.css')) ? filemtime(public_path('css/home-sections.css')) : time() }}">
    @endif

    @if(request()->routeIs('home') && file_exists(public_path('images/hero/hero-gorilla.webp')))
        <link rel="preload" as="image" href="{{ asset('images/hero/hero-gorilla.webp') }}?v={{ filemtime(public_path('images/hero/hero-gorilla.webp')) }}" type="image/webp" fetchpriority="high">
    @endif

    <!-- Dark Mode Preference Script (Default to Light Mode) -->
    <script>
        (function() {
            const savedTheme = localStorage.getItem('pt_theme');
            if (savedTheme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>
</head>
<body class="{{ request()->routeIs('home') ? 'is-home-page' : 'is-internal-page' }}">

    <!-- 1. STICKY HEADER (Transparent over hero, turns solid forest green on scroll) -->
    <header class="site-header" id="siteHeader">
        <div class="header-container">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="brand-link" aria-label="Pearl Trails Home">
                <svg width="38" height="38" viewBox="0 0 48 48" fill="none" class="brand-icon-svg" aria-hidden="true">
                    <path d="M4 38L18 14L28 30L34 20L44 38H4Z" stroke="var(--gold)" stroke-width="2.5" stroke-linejoin="round"/>
                    <path d="M12 38L22 22L30 38" stroke="var(--gold-soft)" stroke-width="1.8" stroke-linejoin="round"/>
                    <circle cx="37" cy="12" r="4" fill="var(--gold)"/>
                    <path d="M6 42C16 39 32 44 42 41" stroke="var(--gold)" stroke-width="2" stroke-linecap="round"/>
                </svg>
                <div class="brand-text-col">
                    <span class="brand-name">Pearl Trails</span>
                    <span class="brand-tagline">The Pearl of Africa</span>
                </div>
            </a>

            <!-- Centre: Pill-Shaped Glass Navigation Bar -->
            <nav class="glass-nav-pill" aria-label="Primary Navigation">
                <!-- Home -->
                <div class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link-btn {{ request()->routeIs('home') ? 'active' : '' }}">
                        Home
                    </a>
                </div>

                <!-- Destinations Dropdown -->
                <div class="nav-item">
                    <button type="button" class="nav-link-btn {{ request()->routeIs('destinations*') ? 'active' : '' }}" aria-haspopup="true" aria-expanded="false">
                        Destinations
                        <span class="nav-chevron" aria-hidden="true">&#9662;</span>
                    </button>
                    <div class="nav-dropdown" role="menu">
                        <a href="{{ route('destinations') }}" class="dropdown-link" role="menuitem">All Destinations</a>
                        <a href="{{ route('interest') }}" class="dropdown-link" role="menuitem">Explore by Interest</a>
                        <a href="{{ route('destinations') }}#map-view" class="dropdown-link" role="menuitem">Map View</a>
                    </div>
                </div>

                <!-- Where to Stay Dropdown -->
                <div class="nav-item">
                    <button type="button" class="nav-link-btn {{ request()->routeIs('stays*') ? 'active' : '' }}" aria-haspopup="true" aria-expanded="false">
                        Where to Stay
                        <span class="nav-chevron" aria-hidden="true">&#9662;</span>
                    </button>
                    <div class="nav-dropdown" role="menu">
                        <a href="{{ route('stays') }}" class="dropdown-link" role="menuitem">All Accommodations</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('stays', ['style' => 'Budget']) }}" class="dropdown-link" role="menuitem">Budget Lodging</a>
                        <a href="{{ route('stays', ['style' => 'Moderate']) }}" class="dropdown-link" role="menuitem">Moderate Stays</a>
                        <a href="{{ route('stays', ['style' => 'Luxury']) }}" class="dropdown-link" role="menuitem">Luxury Retreats</a>
                    </div>
                </div>

                <!-- Where to Eat Dropdown -->
                <div class="nav-item">
                    <button type="button" class="nav-link-btn {{ request()->routeIs('eat*') ? 'active' : '' }}" aria-haspopup="true" aria-expanded="false">
                        Where to Eat
                        <span class="nav-chevron" aria-hidden="true">&#9662;</span>
                    </button>
                    <div class="nav-dropdown" role="menu">
                        <a href="{{ route('eat') }}" class="dropdown-link" role="menuitem">All Restaurants & Dining</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('eat', ['price' => 'budget']) }}" class="dropdown-link" role="menuitem">Casual & Local Eats</a>
                        <a href="{{ route('eat', ['price' => 'moderate']) }}" class="dropdown-link" role="menuitem">Bistros & Cafes</a>
                        <a href="{{ route('eat', ['price' => 'fine_dining']) }}" class="dropdown-link" role="menuitem">Fine Dining</a>
                    </div>
                </div>

                <!-- Recreation & Fun Dropdown -->
                <div class="nav-item">
                    <button type="button" class="nav-link-btn {{ request()->routeIs('recreation*') ? 'active' : '' }}" aria-haspopup="true" aria-expanded="false">
                        Recreation &amp; Fun
                        <span class="nav-chevron" aria-hidden="true">&#9662;</span>
                    </button>
                    <div class="nav-dropdown" role="menu">
                        <a href="{{ route('recreation') }}" class="dropdown-link" role="menuitem">All Activities</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('recreation', ['activity_type' => 'Adventure']) }}" class="dropdown-link" role="menuitem">Adventure & Rafting</a>
                        <a href="{{ route('recreation', ['activity_type' => 'Wildlife']) }}" class="dropdown-link" role="menuitem">Wildlife Encounters</a>
                        <a href="{{ route('recreation', ['activity_type' => 'Culture']) }}" class="dropdown-link" role="menuitem">Cultural Tours</a>
                        <a href="{{ route('recreation', ['activity_type' => 'Water']) }}" class="dropdown-link" role="menuitem">Water & Boat Safaris</a>
                    </div>
                </div>

                <!-- Plan My Trip Dropdown -->
                <div class="nav-item">
                    <button type="button" class="nav-link-btn {{ request()->routeIs('plan*') || request()->routeIs('saved*') ? 'active' : '' }}" aria-haspopup="true" aria-expanded="false">
                        Plan My Trip
                        <span class="nav-chevron" aria-hidden="true">&#9662;</span>
                    </button>
                    <div class="nav-dropdown" role="menu">
                        <a href="{{ route('plan') }}" class="dropdown-link" role="menuitem">Start the Quiz</a>
                        <a href="{{ route('saved') }}" class="dropdown-link" role="menuitem">Saved Trips</a>
                    </div>
                </div>

                <!-- More Dropdown -->
                <div class="nav-item">
                    <button type="button" class="nav-link-btn" aria-haspopup="true" aria-expanded="false">
                        More
                        <span class="nav-chevron" aria-hidden="true">&#9662;</span>
                    </button>
                    <div class="nav-dropdown dropdown-right" role="menu">
                        <a href="{{ route('about') }}" class="dropdown-link" role="menuitem">About Pearl Trails</a>
                        <a href="{{ route('contact') }}" class="dropdown-link" role="menuitem">Contact Us</a>
                        <a href="{{ route('list-business') }}" class="dropdown-link" role="menuitem">List Your Business</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('privacy') }}" class="dropdown-link" role="menuitem">Privacy Policy</a>
                        <a href="{{ route('terms') }}" class="dropdown-link" role="menuitem">Terms of Service</a>
                        <div class="dropdown-divider"></div>
                        @auth
                            <a href="{{ route('dashboard') }}" class="dropdown-link" role="menuitem">My Account ({{ auth()->user()->name }})</a>
                            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                @csrf
                                <button type="submit" class="dropdown-link" style="width: 100%; text-align: left; background: none; border: none; cursor: pointer; color: inherit; font: inherit;">Log Out</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="dropdown-link" role="menuitem">Log In</a>
                        @endauth
                    </div>
                </div>
            </nav>

            <!-- Right Controls -->
            <div class="header-actions-right">
                <div class="action-pill-group">
                    <!-- Light / Dark Mode Toggle -->
                    <button type="button" class="icon-btn" id="headerThemeToggle" title="Toggle Light / Dark Mode" aria-label="Toggle Light or Dark Mode">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="themeSunIcon">
                            <circle cx="12" cy="12" r="5"></circle>
                            <line x1="12" y1="1" x2="12" y2="3"></line>
                            <line x1="12" y1="21" x2="12" y2="23"></line>
                            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                            <line x1="1" y1="12" x2="3" y2="12"></line>
                            <line x1="21" y1="12" x2="23" y2="12"></line>
                            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                        </svg>
                    </button>

                    <!-- Search Icon Button -->
                    <a href="{{ route('destinations') }}" class="icon-btn" title="Search Destinations" aria-label="Search Destinations">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </a>

                    <!-- Currency Selector -->
                    <label for="headerCurrencySelect" class="sr-only">Choose Currency</label>
                    <select id="headerCurrencySelect" class="currency-select-inline" onchange="window.location.href='/currency/' + this.value" aria-label="Select Currency">
                        @foreach(['UGX', 'USD', 'EUR', 'GBP'] as $curr)
                            <option value="{{ $curr }}" {{ (session('currency') ?? 'UGX') === $curr ? 'selected' : '' }}>
                                {{ $curr }}
                            </option>
                        @endforeach
                    </select>

                    @auth
                        <!-- User Account Shortcut Button -->
                        <a href="{{ route('dashboard') }}" class="icon-btn" title="My Account ({{ auth()->user()->name }})" aria-label="My Account ({{ auth()->user()->name }})" style="color: var(--gold);">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </a>
                    @endauth
                </div>

                <!-- Gold Pill CTA: Plan Your Trip -->
                <a href="{{ route('plan') }}" class="btn-gold-pill">
                    <span>Plan Your Trip</span>
                    <span aria-hidden="true">&rarr;</span>
                </a>

                <!-- Mobile Hamburger Toggle (<1024px) -->
                <button type="button" class="hamburger-toggle-btn" id="mobileHamburgerBtn" aria-label="Open Mobile Menu" aria-expanded="false">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Drawer -->
        <div class="mobile-nav-drawer" id="mobileNavDrawer" role="dialog" aria-label="Mobile Navigation">
            <div class="drawer-top-bar">
                <span class="brand-name" style="font-size: 1.2rem;">PEARL TRAILS</span>
                <button type="button" class="drawer-close-btn" id="drawerCloseBtn" aria-label="Close Menu">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

            <div class="mobile-nav-accordion">
                <!-- Home -->
                <div class="accordion-item">
                    <a href="{{ route('home') }}" class="accordion-trigger" style="text-decoration:none;">Home</a>
                </div>

                <!-- Destinations Accordion -->
                <div class="accordion-item">
                    <button type="button" class="accordion-trigger">
                        <span>Destinations</span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </button>
                    <div class="accordion-content">
                        <a href="{{ route('destinations') }}" class="mobile-sub-link">All Destinations</a>
                        <a href="{{ route('interest') }}" class="mobile-sub-link">Explore by Interest</a>
                        <a href="{{ route('destinations') }}#map-view" class="mobile-sub-link">Map View</a>
                    </div>
                </div>

                <!-- Where to Stay Accordion -->
                <div class="accordion-item">
                    <button type="button" class="accordion-trigger">
                        <span>Where to Stay</span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </button>
                    <div class="accordion-content">
                        <a href="{{ route('stays') }}" class="mobile-sub-link">All Accommodations</a>
                        <a href="{{ route('stays', ['style' => 'Budget']) }}" class="mobile-sub-link">Budget Lodging</a>
                        <a href="{{ route('stays', ['style' => 'Moderate']) }}" class="mobile-sub-link">Moderate Stays</a>
                        <a href="{{ route('stays', ['style' => 'Luxury']) }}" class="mobile-sub-link">Luxury Retreats</a>
                    </div>
                </div>

                <!-- Where to Eat Accordion -->
                <div class="accordion-item">
                    <button type="button" class="accordion-trigger">
                        <span>Where to Eat</span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </button>
                    <div class="accordion-content">
                        <a href="{{ route('eat') }}" class="mobile-sub-link">All Restaurants</a>
                        <a href="{{ route('eat', ['price' => 'budget']) }}" class="mobile-sub-link">Casual & Local Eats</a>
                        <a href="{{ route('eat', ['price' => 'moderate']) }}" class="mobile-sub-link">Bistros & Cafes</a>
                        <a href="{{ route('eat', ['price' => 'fine_dining']) }}" class="mobile-sub-link">Fine Dining</a>
                    </div>
                </div>

                <!-- Recreation & Fun Accordion -->
                <div class="accordion-item">
                    <button type="button" class="accordion-trigger">
                        <span>Recreation &amp; Fun</span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </button>
                    <div class="accordion-content">
                        <a href="{{ route('recreation') }}" class="mobile-sub-link">All Activities</a>
                        <a href="{{ route('recreation', ['activity_type' => 'Adventure']) }}" class="mobile-sub-link">Adventure</a>
                        <a href="{{ route('recreation', ['activity_type' => 'Wildlife']) }}" class="mobile-sub-link">Wildlife</a>
                        <a href="{{ route('recreation', ['activity_type' => 'Culture']) }}" class="mobile-sub-link">Culture</a>
                        <a href="{{ route('recreation', ['activity_type' => 'Water']) }}" class="mobile-sub-link">Water Safaris</a>
                    </div>
                </div>

                <!-- Plan My Trip Accordion -->
                <div class="accordion-item">
                    <button type="button" class="accordion-trigger">
                        <span>Plan My Trip</span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </button>
                    <div class="accordion-content">
                        <a href="{{ route('plan') }}" class="mobile-sub-link">Start the Quiz</a>
                        <a href="{{ route('saved') }}" class="mobile-sub-link">Saved Trips</a>
                    </div>
                </div>

                <!-- More Accordion -->
                <div class="accordion-item">
                    <button type="button" class="accordion-trigger">
                        <span>More</span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </button>
                    <div class="accordion-content">
                        <a href="{{ route('about') }}" class="mobile-sub-link">About Pearl Trails</a>
                        <a href="{{ route('contact') }}" class="mobile-sub-link">Contact Us</a>
                        <a href="{{ route('list-business') }}" class="mobile-sub-link">List Your Business</a>
                        <a href="{{ route('privacy') }}" class="mobile-sub-link">Privacy Policy</a>
                        <a href="{{ route('terms') }}" class="mobile-sub-link">Terms of Service</a>
                        <div style="height: 1px; background: rgba(247, 241, 227, 0.1); margin: 0.4rem 0;"></div>
                        @auth
                            <a href="{{ route('dashboard') }}" class="mobile-sub-link">My Account ({{ auth()->user()->name }})</a>
                            <form method="POST" action="{{ route('logout') }}" style="margin: 0.2rem 0 0;">
                                @csrf
                                <button type="submit" class="mobile-sub-link" style="width: 100%; text-align: left; background: none; border: none; cursor: pointer; color: inherit; font: inherit; padding: 0.4rem 0;">Log Out</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="mobile-sub-link" style="font-weight: 600;">Log In</a>
                        @endauth
                    </div>
                </div>
            </div>

            <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid rgba(247, 241, 227, 0.1);">
                <a href="{{ route('plan') }}" class="btn-gold-pill" style="width: 100%; justify-content: center;">
                    Plan Your Trip &rarr;
                </a>
            </div>
        </div>
        <div class="drawer-backdrop" id="drawerBackdrop"></div>
    </header>

    <!-- Main Content Area -->
    <main class="{{ request()->routeIs('home') ? 'main-home-flow' : 'main-internal-flow' }}">
        @yield('content')
    </main>

    <!-- 9. FOOTER (Dark Green, 4 Columns, Clean & Informative) -->
    <footer class="site-footer">
        <div class="footer-container">
            <div class="footer-columns-grid">
                <!-- Col 1: Brand & Short Description -->
                <div class="footer-col-brand">
                    <div class="footer-brand-title">
                        <svg width="28" height="28" viewBox="0 0 48 48" fill="none" aria-hidden="true">
                            <path d="M4 38L18 14L28 30L34 20L44 38H4Z" stroke="var(--gold)" stroke-width="2.5" stroke-linejoin="round"/>
                            <path d="M12 38L22 22L30 38" stroke="var(--gold-soft)" stroke-width="1.8" stroke-linejoin="round"/>
                            <circle cx="37" cy="12" r="4" fill="var(--gold)"/>
                        </svg>
                        <span>Pearl Trails</span>
                    </div>
                    <p class="footer-desc">
                        Uganda's premier travel discovery platform. Explore national parks, misty gorilla highlands, tranquil lakes, and custom itineraries crafted with honest local intelligence.
                    </p>
                </div>

                <!-- Col 2: Explore -->
                <div class="footer-col">
                    <h3 class="footer-col-title">Explore</h3>
                    <ul class="footer-links-list">
                        <li class="footer-link-item"><a href="{{ route('destinations') }}">Destinations</a></li>
                        <li class="footer-link-item"><a href="{{ route('stays') }}">Where to Stay</a></li>
                        <li class="footer-link-item"><a href="{{ route('eat') }}">Where to Eat</a></li>
                        <li class="footer-link-item"><a href="{{ route('recreation') }}">Recreation &amp; Fun</a></li>
                    </ul>
                </div>

                <!-- Col 3: Plan -->
                <div class="footer-col">
                    <h3 class="footer-col-title">Plan</h3>
                    <ul class="footer-links-list">
                        <li class="footer-link-item"><a href="{{ route('plan') }}">Trip Planning Quiz</a></li>
                        <li class="footer-link-item"><a href="{{ route('saved') }}">Saved Trips</a></li>
                        <li class="footer-link-item"><a href="{{ route('list-business') }}">List Your Business</a></li>
                    </ul>
                </div>

                <!-- Col 4: Company -->
                <div class="footer-col">
                    <h3 class="footer-col-title">Company</h3>
                    <ul class="footer-links-list">
                        <li class="footer-link-item"><a href="{{ route('about') }}">About Pearl Trails</a></li>
                        <li class="footer-link-item"><a href="{{ route('contact') }}">Contact Us</a></li>
                        <li class="footer-link-item"><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                        <li class="footer-link-item"><a href="{{ route('terms') }}">Terms of Service</a></li>
                    </ul>
                </div>
            </div>

            <!-- Footer Bottom Bar -->
            <div class="footer-bottom-bar">
                <span class="footer-disclaimer-text">
                    Prices are estimates and may change. Confirm with the provider.
                </span>
                <span class="footer-copyright">
                    &copy; {{ date('Y') }} Pearl Trails. All rights reserved.
                </span>
            </div>
        </div>
    </footer>

    <!-- Interactive Navigation Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // 1. Sticky header turns solid dark green after scrolling
            const header = document.getElementById('siteHeader');
            function checkScroll() {
                if (window.scrollY > 40) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            }
            window.addEventListener('scroll', checkScroll, { passive: true });
            checkScroll();

            // 2. Theme Toggle (Stores in localStorage, light mode is default)
            const themeBtn = document.getElementById('headerThemeToggle');
            if (themeBtn) {
                themeBtn.addEventListener('click', () => {
                    const isDark = document.documentElement.classList.toggle('dark');
                    localStorage.setItem('pt_theme', isDark ? 'dark' : 'light');
                });
            }

            // 3. Mobile Navigation Drawer & Accordions
            const hamburgerBtn = document.getElementById('mobileHamburgerBtn');
            const drawer = document.getElementById('mobileNavDrawer');
            const backdrop = document.getElementById('drawerBackdrop');
            const closeBtn = document.getElementById('drawerCloseBtn');

            function openDrawer() {
                drawer.classList.add('open');
                backdrop.classList.add('open');
                hamburgerBtn.setAttribute('aria-expanded', 'true');
                document.body.style.overflow = 'hidden';
            }

            function closeDrawer() {
                drawer.classList.remove('open');
                backdrop.classList.remove('open');
                hamburgerBtn.setAttribute('aria-expanded', 'false');
                document.body.style.overflow = '';
            }

            if (hamburgerBtn) hamburgerBtn.addEventListener('click', openDrawer);
            if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
            if (backdrop) backdrop.addEventListener('click', closeDrawer);

            // Accordion toggle
            document.querySelectorAll('.accordion-trigger').forEach(trigger => {
                trigger.addEventListener('click', () => {
                    const parent = trigger.closest('.accordion-item');
                    if (parent) {
                        parent.classList.toggle('active');
                    }
                });
            });
        });
    </script>
</body>
</html>
