<x-guest-layout>
    <x-slot name="title">Sign Up</x-slot>

    <div class="auth-header-text">
        <h2>Create an Account</h2>
        <p>Join Pearl Trails to craft custom itineraries, save lodges, and unlock Uganda travel tools.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="auth-form">
        @csrf

        <!-- Name -->
        <div class="auth-field">
            <label for="name" class="auth-label">Full Name</label>
            <div class="auth-input-wrapper">
                <span class="auth-input-icon" aria-hidden="true">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </span>
                <input id="name" 
                       class="auth-input auth-input-with-icon @error('name') auth-input-error @enderror" 
                       type="text" 
                       name="name" 
                       value="{{ old('name') }}" 
                       required 
                       autofocus 
                       autocomplete="name" 
                       placeholder="e.g. Sarah Namubiru" />
            </div>
            <x-input-error :messages="$errors->get('name')" />
        </div>

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
                       autocomplete="username" 
                       placeholder="e.g. sarah@example.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div class="auth-field">
            <label for="password" class="auth-label">Password</label>
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
                       autocomplete="new-password" 
                       placeholder="At least 8 characters" />
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

        <!-- Confirm Password -->
        <div class="auth-field">
            <label for="password_confirmation" class="auth-label">Confirm Password</label>
            <div class="auth-input-wrapper">
                <span class="auth-input-icon" aria-hidden="true">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                </span>
                <input id="password_confirmation" 
                       class="auth-input auth-input-with-icon auth-input-has-toggle @error('password_confirmation') auth-input-error @enderror"
                       type="password"
                       name="password_confirmation" 
                       required 
                       autocomplete="new-password" 
                       placeholder="Repeat your password" />
                <button type="button" class="auth-pw-toggle" onclick="togglePasswordVisibility('password_confirmation', this)" aria-label="Toggle password visibility">
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
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <!-- Terms note -->
        <p class="auth-terms-note">
            By creating an account, you agree to our <a href="{{ route('terms') }}" target="_blank">Terms</a> and <a href="{{ route('privacy') }}" target="_blank">Privacy Policy</a>.
        </p>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-gold btn-block auth-submit-btn">
            Create Pearl Trails Account
        </button>

        <!-- Footer Link -->
        <div class="auth-footer-prompt">
            <span>Already registered?</span>
            <a href="{{ route('login') }}" class="auth-action-link">Log In</a>
        </div>
    </form>
</x-guest-layout>
