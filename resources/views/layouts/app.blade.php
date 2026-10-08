<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'Pearl Trails')) - Pearl Trails</title>
    <meta name="description" content="Explore Uganda - Discover the Pearl of Africa with Pearl Trails tourism experience.">

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
    <!-- Site Header & Navigation -->
    <header class="site-header">
        <div class="container nav-wrapper">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="brand-logo">
                <div class="logo-icon">??</div>
                <span>Pearl Trails</span>
            </a>

            <!-- Mobile Toggle -->
            <button class="mobile-nav-toggle" id="mobileMenuBtn" aria-label="Toggle Navigation">
                ?
            </button>

            <!-- Navigation Links -->
            <nav>
                <ul class="nav-menu" id="navMenu">
                    <li><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ route('destinations') }}" class="nav-link {{ request()->routeIs('destinations') ? 'active' : '' }}">Destinations</a></li>
                    <li><a href="{{ route('plan') }}" class="nav-link {{ request()->routeIs('plan') ? 'active' : '' }}">Plan My Trip</a></li>
                    <li><a href="{{ route('interest', ['interest' => 'wildlife']) }}" class="nav-link {{ request()->routeIs('interest') ? 'active' : '' }}">Explore by Interest</a></li>
                    <li><a href="{{ route('saved') }}" class="nav-link {{ request()->routeIs('saved') ? 'active' : '' }}">Saved Trips</a></li>
                    <li><a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
                </ul>
            </nav>

            <!-- Action Controls (Plan My Trip CTA & Dark Mode Toggle) -->
            <div class="header-actions">
                <button class="theme-toggle-btn" id="themeToggleBtn" title="Toggle Light/Dark Theme">
                    ??
                </button>
                <a href="{{ route('plan') }}" class="btn-plan-trip">
                    <span>? Plan My Trip</span>
                </a>
            </div>
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
                    <h3>Pearl Trails ??</h3>
                    <p>Discover the breathtaking landscapes, rare wildlife, and rich culture of Uganda - the Pearl of Africa.</p>
                </div>
                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('destinations') }}">Destinations</a></li>
                        <li><a href="{{ route('plan') }}">Plan My Trip</a></li>
                        <li><a href="{{ route('interest', ['interest' => 'wildlife']) }}">Explore by Interest</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Explore Uganda</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('saved') }}">Saved Trips</a></li>
                        <li><a href="{{ route('about') }}">About Pearl Trails</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} {{ config('app.name', 'Pearl Trails') }}. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Theme & Mobile Nav Scripts -->
    <script>
        // Theme toggle handler
        const themeToggleBtn = document.getElementById('themeToggleBtn');
        themeToggleBtn.addEventListener('click', () => {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            themeToggleBtn.textContent = isDark ? '??' : '??';
        });
        if (document.documentElement.classList.contains('dark')) {
            themeToggleBtn.textContent = '??';
        }

        // Mobile menu toggle handler
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const navMenu = document.getElementById('navMenu');
        mobileMenuBtn.addEventListener('click', () => {
            navMenu.classList.toggle('open');
        });
    </script>
</body>
</html>
