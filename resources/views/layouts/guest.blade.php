<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Account' }} - {{ config('app.name', 'Pearl Trails') }}</title>
    <meta name="description" content="Sign in or register for Pearl Trails, Uganda's premier tourism decision assistant.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

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
<body class="auth-body">
    <div class="auth-page-wrapper">
        <!-- Top Navigation Bar -->
        <header class="auth-top-bar">
            <a href="{{ route('home') }}" class="auth-back-link" title="Return to Pearl Trails homepage">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                <span>Back to Pearl Trails</span>
            </a>

            <div class="auth-top-actions">
                <button class="theme-toggle-btn" id="themeToggleBtn" title="Toggle Light / Dark Theme" aria-label="Toggle Theme">
                    <svg class="theme-svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                    </svg>
                </button>
            </div>
        </header>

        <!-- Main Card Section -->
        <main class="auth-main">
            <div class="auth-card-wrapper">
                <div class="auth-card">
                    <!-- Brand Heading -->
                    <div class="auth-brand-header">
                        <a href="{{ route('home') }}" class="brand-logo" aria-label="Pearl Trails Home">
                            <span class="logo-emblem-svg" aria-hidden="true">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon>
                                </svg>
                            </span>
                            <span class="logo-title">Pearl Trails</span>
                        </a>
                        <span class="auth-brand-subtitle">Uganda Tourism Decision Assistant</span>
                    </div>

                    <!-- Page-specific auth content -->
                    {{ $slot }}
                </div>

                <!-- Trust / Security Micro-Footer -->
                <div class="auth-trust-bar">
                    <span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        Secure Encrypted Authentication
                    </span>
                    <span class="auth-trust-dot">•</span>
                    <span>Curate Uganda Safaris & Stays</span>
                </div>
            </div>
        </main>
    </div>

    <!-- Theme Toggle Interaction Script -->
    <script>
        const themeBtn = document.getElementById('themeToggleBtn');
        if (themeBtn) {
            themeBtn.addEventListener('click', () => {
                const isDark = document.documentElement.classList.toggle('dark');
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
            });
        }

        // Helper for password visibility toggle
        function togglePasswordVisibility(fieldId, btn) {
            const input = document.getElementById(fieldId);
            if (!input) return;
            const eyeOpen = btn.querySelector('.eye-open');
            const eyeClosed = btn.querySelector('.eye-closed');

            if (input.type === 'password') {
                input.type = 'text';
                if (eyeOpen) eyeOpen.style.display = 'none';
                if (eyeClosed) eyeClosed.style.display = 'block';
            } else {
                input.type = 'password';
                if (eyeOpen) eyeOpen.style.display = 'block';
                if (eyeClosed) eyeClosed.style.display = 'none';
            }
        }
    </script>
</body>
</html>
