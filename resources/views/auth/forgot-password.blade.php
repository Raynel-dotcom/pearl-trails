<x-guest-layout>
    <x-slot name="title">Reset Password</x-slot>

    <div class="auth-header-text">
        <h2>Reset Password</h2>
        <p>Enter the email associated with your account, and we'll send you a password reset link.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="auth-form">
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
                       placeholder="e.g. explorer@pearltrails.ug" />
            </div>
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <button type="submit" class="btn btn-gold btn-block auth-submit-btn">
            Email Password Reset Link
        </button>

        <div class="auth-footer-prompt">
            <span>Remembered your password?</span>
            <a href="{{ route('login') }}" class="auth-action-link">Back to Log In</a>
        </div>
    </form>
</x-guest-layout>
