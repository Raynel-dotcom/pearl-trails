<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'Pearl Trails')) - Pearl of Africa</title>
    <meta name="description" content="A comprehensive tourism decision assistant for Uganda. Explore destinations, costs, lodges, and custom itineraries across the Pearl of Africa.">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    <script>
        // Check for saved dark mode preference
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body>
    <!-- 4. SITE HEADER (Sticky with hamburger <900px, normal row >=900px) -->
    <header class="site-header">
        <div class="container nav-wrapper">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="brand-logo">
                <span class="logo-emblem-svg" aria-hidden="true">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon>
                    </svg>
                </span>
                <span class="logo-title">Pearl Trails</span>
            </a>

            <!-- Primary Navigation Links (Clean, compact desktop row) -->
            <nav class="nav-primary-desktop" aria-label="Main Navigation">
                <a href="{{ route('destinations') }}" class="nav-link {{ request()->routeIs('destinations*') ? 'active' : '' }}">Destinations</a>
                <a href="{{ route('stays') }}" class="nav-link {{ request()->routeIs('stays*') ? 'active' : '' }}">Stays</a>
                <a href="{{ route('eat') }}" class="nav-link {{ request()->routeIs('eat*') ? 'active' : '' }}">Eat</a>
                <a href="{{ route('recreation') }}" class="nav-link {{ request()->routeIs('recreation*') ? 'active' : '' }}">Recreation</a>
            </nav>

            <!-- Header Right Controls -->
            <div class="nav-actions-right">
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

                <!-- Prominent "Plan My Trip" Button -->
                <a href="{{ route('plan') }}" class="btn-plan-trip-header">
                    Plan My Trip
                </a>

                <!-- Theme Toggle Button -->
                <button class="theme-toggle-btn" id="themeToggleBtn" title="Toggle Light / Dark Theme" aria-label="Toggle Theme">
                    <svg class="theme-svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
                </button>

                <!-- Hamburger Menu Button -->
                <button class="hamburger-btn" id="hamburgerBtn" aria-label="Toggle Navigation Menu" aria-expanded="false">
                    <span id="hamburgerIcon" aria-hidden="true">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                    </span>
                    <span class="hamburger-label">Menu</span>
                </button>
            </div>

            <!-- Hamburger Drawer Menu (Secondary links on desktop, all links on mobile) -->
            <div class="nav-drawer" id="navDrawer" role="dialog" aria-label="Site Navigation">
                <div class="drawer-header">
                    <div class="drawer-brand">
                        <span class="logo-emblem-svg" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon>
                            </svg>
                        </span>
                        <span>Pearl Trails Menu</span>
                    </div>
                    <button class="drawer-close-btn" id="drawerCloseBtn" aria-label="Close Navigation Menu">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <div class="drawer-content">
                    <!-- Mobile-only Explore links -->
                    <div class="drawer-section mobile-only-section">
                        <span class="drawer-section-title">Explore</span>
                        <a href="{{ route('home') }}" class="drawer-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                        <a href="{{ route('destinations') }}" class="drawer-link {{ request()->routeIs('destinations*') ? 'active' : '' }}">Destinations</a>
                        <a href="{{ route('stays') }}" class="drawer-link {{ request()->routeIs('stays*') ? 'active' : '' }}">Where to Stay</a>
                        <a href="{{ route('eat') }}" class="drawer-link {{ request()->routeIs('eat*') ? 'active' : '' }}">Where to Eat</a>
                        <a href="{{ route('recreation') }}" class="drawer-link {{ request()->routeIs('recreation*') ? 'active' : '' }}">Recreation & Fun</a>
                    </div>

                    <!-- Planning & Tools -->
                    <div class="drawer-section">
                        <span class="drawer-section-title">Planning Tools</span>
                        <a href="{{ route('plan') }}" class="drawer-link {{ request()->routeIs('plan*') ? 'active' : '' }}">Plan My Trip Wizard</a>
                        <a href="{{ route('interest') }}" class="drawer-link {{ request()->routeIs('interest*') ? 'active' : '' }}">Explore by Interest</a>
                        <a href="{{ route('saved') }}" class="drawer-link {{ request()->routeIs('saved*') ? 'active' : '' }}">Saved Trips</a>
                    </div>

                    <!-- Business & Information -->
                    <div class="drawer-section">
                        <span class="drawer-section-title">Partners & Info</span>
                        <a href="{{ route('list-your-business') }}" class="drawer-link {{ request()->routeIs('list-your-business*') || request()->routeIs('list-business*') ? 'active' : '' }}">List Your Business</a>
                        <a href="{{ route('about') }}" class="drawer-link {{ request()->routeIs('about*') ? 'active' : '' }}">About Pearl Trails</a>
                        <a href="{{ route('contact') }}" class="drawer-link {{ request()->routeIs('contact*') ? 'active' : '' }}">Contact Us</a>
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
                                <a href="{{ route('register') }}" class="btn btn-gold btn-sm">Sign Up</a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Backdrop Overlay -->
            <div class="drawer-backdrop" id="drawerBackdrop"></div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="main-content">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Site Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <h3>Pearl Trails</h3>
                    <p>The intelligent tourism decision assistant for Uganda. Discover national parks, gorillas, crater lakes, and custom itineraries tailored to your budget and travel style.</p>
                    <p class="footer-disclaimer">Prices are always labelled as estimates at approximate rates.</p>
                </div>

                <div class="footer-section">
                    <h4>Explore Uganda</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('destinations') }}">Destinations</a></li>
                        <li><a href="{{ route('plan') }}">Plan My Trip</a></li>
                        <li><a href="{{ route('interest') }}">Explore by Interest</a></li>
                        <li><a href="{{ route('stays') }}">Stays & Lodges</a></li>
                        <li><a href="{{ route('eat') }}">Where to Eat</a></li>
                        <li><a href="{{ route('recreation') }}">Recreation & Fun</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Platform & Legal</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('about') }}">About</a></li>
                        <li><a href="{{ route('destinations') }}">Destinations</a></li>
                        <li><a href="{{ route('plan') }}">Plan My Trip</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                        <li><a href="{{ route('privacy') }}">Privacy</a></li>
                        <li><a href="{{ route('terms') }}">Terms</a></li>
                        <li><a href="{{ route('list-business') }}">List Your Business</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} {{ config('app.name', 'Pearl Trails') }}. All rights reserved.</p>
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

        // Drawer & Hamburger Navigation
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const hamburgerIcon = document.getElementById('hamburgerIcon');
        const navDrawer = document.getElementById('navDrawer');
        const drawerBackdrop = document.getElementById('drawerBackdrop');
        const drawerCloseBtn = document.getElementById('drawerCloseBtn');

        const hamburgerSvg = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>`;
        const closeSvg = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>`;

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
