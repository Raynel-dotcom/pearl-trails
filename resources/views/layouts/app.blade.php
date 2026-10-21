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
                <span class="logo-emblem">🇺🇬</span>
                <span class="logo-title">Pearl Trails</span>
            </a>

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

            <!-- Prominent "Plan My Trip" Button (Always Visible in Header) -->
            <a href="{{ route('plan') }}" class="btn-plan-trip-header">
                ✨ Plan My Trip
            </a>

            <!-- Hamburger Button (☰, changes to ✕ when open; visible <900px, hidden >=900px) -->
            <button class="hamburger-btn" id="hamburgerBtn" aria-label="Toggle Navigation Menu" aria-expanded="false">
                <span id="hamburgerIcon">☰</span>
            </button>

            <!-- Navigation Links Container -->
            <nav class="nav-container" id="navContainer">
                <ul class="nav-menu" id="navMenu">
                    <li><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ route('destinations') }}" class="nav-link {{ request()->routeIs('destinations*') ? 'active' : '' }}">Destinations</a></li>
                    <li><a href="{{ route('plan') }}" class="nav-link {{ request()->routeIs('plan*') ? 'active' : '' }}">Plan My Trip</a></li>
                    <li><a href="{{ route('interest') }}" class="nav-link {{ request()->routeIs('interest*') ? 'active' : '' }}">Explore by Interest</a></li>
                    <li><a href="{{ route('stays') }}" class="nav-link {{ request()->routeIs('stays*') ? 'active' : '' }}">Stays</a></li>
                    <li><a href="{{ route('eat') }}" class="nav-link {{ request()->routeIs('eat*') ? 'active' : '' }}">Eat</a></li>
                    <li><a href="{{ route('recreation') }}" class="nav-link {{ request()->routeIs('recreation*') ? 'active' : '' }}">Recreation</a></li>
                    <li><a href="{{ route('saved') }}" class="nav-link {{ request()->routeIs('saved*') ? 'active' : '' }}">Saved Trips</a></li>
                    <li><a href="{{ route('list-business') }}" class="nav-link {{ request()->routeIs('list-business*') ? 'active' : '' }}">List Your Business</a></li>
                    <li><a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about*') ? 'active' : '' }}">About</a></li>
                    
                    @auth
                        @if(auth()->user()->isAdmin())
                            <li><a href="{{ route('admin.listings') }}" class="nav-link {{ request()->routeIs('admin*') ? 'active' : '' }}">Admin</a></li>
                        @elseif(auth()->user()->isVendor())
                            <li><a href="{{ route('vendor.listings') }}" class="nav-link {{ request()->routeIs('vendor*') ? 'active' : '' }}">Dashboard</a></li>
                        @endif
                        <li>
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="nav-link nav-logout-btn">Log Out</button>
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}" class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}">Login</a></li>
                    @endauth
                </ul>
            </nav>

            <!-- Theme Toggle Button -->
            <button class="theme-toggle-btn" id="themeToggleBtn" title="Toggle Light / Dark Theme" aria-label="Toggle Theme">
                🌙
            </button>
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
                    <h3>Pearl Trails 🇺🇬</h3>
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
        function updateThemeIcon() {
            themeToggleBtn.textContent = document.documentElement.classList.contains('dark') ? '☀️' : '🌙';
        }
        themeToggleBtn.addEventListener('click', () => {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            updateThemeIcon();
        });
        updateThemeIcon();

        // Hamburger Navigation (<900px)
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const hamburgerIcon = document.getElementById('hamburgerIcon');
        const navContainer = document.getElementById('navContainer');

        function toggleMenu() {
            const isOpen = navContainer.classList.toggle('open');
            hamburgerBtn.setAttribute('aria-expanded', isOpen);
            hamburgerIcon.textContent = isOpen ? '✕' : '☰';
        }

        hamburgerBtn.addEventListener('click', toggleMenu);

        // Closes when any nav link is tapped on mobile
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 900 && navContainer.classList.contains('open')) {
                    toggleMenu();
                }
            });
        });
    </script>
</body>
</html>
