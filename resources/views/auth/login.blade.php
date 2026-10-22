<x-guest-layout>
    <x-slot name="title">Log In</x-slot>

    <div class="auth-header-text">
        <h2>Welcome Back</h2>
        <p>Sign in to continue planning, save your favorite Uganda destinations, or manage listings.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf

        <!-- Email Address -->
        <div class="auth-field">
            <label for="email" class="auth-label">Email Address</label>
            <div class="auth-input-wrapper">
                <span class="auth-input-icon" aria-hidden="true">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                </span>
                <input id="email" 
                       class="auth-input auth-input-with-icon @error('email') auth-input-error @enderror" 
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       autofocus 
                       autocomplete="username" 
                       placeholder="e.g. explorer@pearltrails.ug" />
            </div>
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div class="auth-field">
            <div class="auth-label-row">
                <label for="password" class="auth-label">Password</label>
                @if (Route::has('password.request'))
                    <a class="auth-link-subtle" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>
            <div class="auth-input-wrapper">
                <span class="auth-input-icon" aria-hidden="true">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                </span>
                <input id="password" 
                       class="auth-input auth-input-with-icon auth-input-has-toggle @error('password') auth-input-error @enderror"
                       type="password"
                       name="password"
                       required 
                       autocomplete="current-password" 
                       placeholder="••••••••" />
                <button type="button" class="auth-pw-toggle" onclick="togglePasswordVisibility('password', this)" aria-label="Toggle password visibility">
                    <svg class="eye-open" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    <svg class="eye-closed" style="display: none;" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                        <line x1="1" y1="1" x2="23" y2="23"></line>
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Remember Me -->
        <div class="auth-remember-row">
            <label for="remember_me" class="auth-checkbox-label">
                <input id="remember_me" type="checkbox" class="auth-checkbox" name="remember">
                <span>Keep me signed in</span>
            </label>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-gold btn-block auth-submit-btn">
            Log In to Pearl Trails
        </button>

        <!-- Footer Link -->
        <div class="auth-footer-prompt">
            <span>Don't have an account yet?</span>
            <a href="{{ route('register') }}" class="auth-action-link">Create Account</a>
        </div>
    </form>
</x-guest-layout>
