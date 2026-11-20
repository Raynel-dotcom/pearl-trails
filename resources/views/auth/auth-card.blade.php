@php
    $defaultMode = $defaultMode ?? 'login';
    if ($errors->has('name') || $errors->has('password_confirmation') || old('_form') === 'register' || request('mode') === 'register') {
        $activeMode = 'register';
    } elseif ($errors->any() || old('_form') === 'login' || request('mode') === 'login') {
        $activeMode = 'login';
    } else {
        $activeMode = $defaultMode;
    }
@endphp

<div class="auth-page-wrapper">
    <div class="auth-card">
        <!-- Brand Header -->
        <div class="auth-header">
            <a href="{{ route('home') }}" class="auth-brand-mark" aria-label="Pearl Trails Home">
                <svg width="28" height="28" viewBox="0 0 48 48" fill="none" aria-hidden="true">
                    <path d="M4 38L18 14L28 30L34 20L44 38H4Z" stroke="var(--gold)" stroke-width="2.5" stroke-linejoin="round"/>
                    <path d="M12 38L22 22L30 38" stroke="var(--gold-soft)" stroke-width="1.8" stroke-linejoin="round"/>
                    <circle cx="37" cy="12" r="4" fill="var(--gold)"/>
                </svg>
            </a>
            <span class="auth-kicker">Member Access</span>
            <h1 class="auth-title">Welcome to Pearl Trails</h1>
            <p class="auth-subtitle">Sign in to access your saved itineraries or create a new account in seconds.</p>
        </div>

        <!-- Session Status (e.g. password reset confirmation) -->
        @if(session('status'))
            <div class="alert-success-banner" style="margin-bottom: 1.5rem;">
                <span>{{ session('status') }}</span>
            </div>
        @endif

        <!-- Pill Switcher Tabs -->
        <div class="auth-tab-switch" role="tablist" aria-label="Authentication Options">
            <button type="button" 
                    class="auth-tab-btn {{ $activeMode === 'login' ? 'active' : '' }}" 
                    id="tabBtnLogin" 
                    role="tab" 
                    aria-selected="{{ $activeMode === 'login' ? 'true' : 'false' }}" 
                    aria-controls="panelLogin"
                    onclick="setAuthTab('login')">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                    <polyline points="10 17 15 12 10 7"></polyline>
                    <line x1="15" y1="12" x2="3" y2="12"></line>
                </svg>
                Sign In
            </button>
            <button type="button" 
                    class="auth-tab-btn {{ $activeMode === 'register' ? 'active' : '' }}" 
                    id="tabBtnRegister" 
                    role="tab" 
                    aria-selected="{{ $activeMode === 'register' ? 'true' : 'false' }}" 
                    aria-controls="panelRegister"
                    onclick="setAuthTab('register')">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="8.5" cy="7" r="4"></circle>
                    <line x1="20" y1="8" x2="20" y2="14"></line>
                    <line x1="23" y1="11" x2="17" y2="11"></line>
                </svg>
                Create Account
            </button>
        </div>

        <!-- ================= PANEL 1: SIGN IN ================= -->
        <div class="auth-panel {{ $activeMode === 'login' ? 'active' : '' }}" id="panelLogin" role="tabpanel" aria-labelledby="tabBtnLogin">
            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf
                <input type="hidden" name="_form" value="login">
                @if(request('redirect_to') || old('redirect_to'))
                    <input type="hidden" name="redirect_to" value="{{ old('redirect_to', request('redirect_to')) }}">
                @endif

                <!-- Email -->
                <div class="auth-field-group">
                    <label for="login_email" class="auth-field-label">Email Address</label>
                    <div class="auth-input-wrapper">
                        <input type="email" 
                               name="email" 
                               id="login_email" 
                               class="auth-input" 
                               value="{{ old('_form') === 'login' ? old('email') : (old('_form') !== 'register' ? old('email') : '') }}" 
                               required 
                               autocomplete="username" 
                               placeholder="you@example.com">
                        <span class="auth-input-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                        </span>
                    </div>
                    @if(old('_form') === 'login' || !old('_form'))
                        @error('email')
                            <span class="auth-error-msg">{{ $message }}</span>
                        @enderror
                    @endif
                </div>

                <!-- Password -->
                <div class="auth-field-group">
                    <label for="login_password" class="auth-field-label">Password</label>
                    <div class="auth-input-wrapper">
                        <input type="password" 
                               name="password" 
                               id="login_password" 
                               class="auth-input" 
                               required 
                               autocomplete="current-password" 
                               placeholder="Enter your password">
                        <span class="auth-input-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                        </span>
                        <button type="button" 
                                class="auth-toggle-pwd-btn" 
                                aria-label="Toggle password visibility" 
                                onclick="togglePasswordVisibility('login_password', this)">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </div>
                    @if(old('_form') === 'login' || !old('_form'))
                        @error('password')
                            <span class="auth-error-msg">{{ $message }}</span>
                        @enderror
                    @endif
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="auth-meta-row">
                    <label for="remember_me" class="auth-remember-label">
                        <input id="remember_me" type="checkbox" name="remember">
                        <span>Remember me</span>
                    </label>

                    @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="auth-forgot-link">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-gold auth-submit-btn">
                    <span>Sign In to Pearl Trails</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </button>

                <!-- Seamless Switcher Prompt -->
                <div class="auth-switch-prompt">
                    <span>Don't have login credentials yet?</span>
                    <button type="button" class="auth-switch-action-btn" onclick="setAuthTab('register')">
                        Create an account for free &rarr;
                    </button>
                </div>
            </form>
        </div>

        <!-- ================= PANEL 2: CREATE ACCOUNT ================= -->
        <div class="auth-panel {{ $activeMode === 'register' ? 'active' : '' }}" id="panelRegister" role="tabpanel" aria-labelledby="tabBtnRegister">
            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf
                <input type="hidden" name="_form" value="register">
                @if(request('redirect_to') || old('redirect_to'))
                    <input type="hidden" name="redirect_to" value="{{ old('redirect_to', request('redirect_to')) }}">
                @endif
                @if(request('role') || old('role'))
                    <input type="hidden" name="role" value="{{ old('role', request('role')) }}">
                @endif

                <!-- Full Name -->
                <div class="auth-field-group">
                    <label for="register_name" class="auth-field-label">Full Name</label>
                    <div class="auth-input-wrapper">
                        <input type="text" 
                               name="name" 
                               id="register_name" 
                               class="auth-input" 
                               value="{{ old('name') }}" 
                               required 
                               autocomplete="name" 
                               placeholder="e.g. Sarah Namubiru">
                        <span class="auth-input-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </span>
                    </div>
                    @error('name')
                        <span class="auth-error-msg">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="auth-field-group">
                    <label for="register_email" class="auth-field-label">Email Address</label>
                    <div class="auth-input-wrapper">
                        <input type="email" 
                               name="email" 
                               id="register_email" 
                               class="auth-input" 
                               value="{{ old('_form') === 'register' ? old('email') : '' }}" 
                               required 
                               autocomplete="username" 
                               placeholder="you@example.com">
                        <span class="auth-input-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                        </span>
                    </div>
                    @if(old('_form') === 'register')
                        @error('email')
                            <span class="auth-error-msg">{{ $message }}</span>
                        @enderror
                    @endif
                </div>

                <!-- Password -->
                <div class="auth-field-group">
                    <label for="register_password" class="auth-field-label">Password</label>
                    <div class="auth-input-wrapper">
                        <input type="password" 
                               name="password" 
                               id="register_password" 
                               class="auth-input" 
                               required 
                               autocomplete="new-password" 
                               placeholder="Minimum 8 characters">
                        <span class="auth-input-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                        </span>
                        <button type="button" 
                                class="auth-toggle-pwd-btn" 
                                aria-label="Toggle password visibility" 
                                onclick="togglePasswordVisibility('register_password', this)">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </div>
                    @if(old('_form') === 'register')
                        @error('password')
                            <span class="auth-error-msg">{{ $message }}</span>
                        @enderror
                    @endif
                </div>

                <!-- Confirm Password -->
                <div class="auth-field-group">
                    <label for="register_password_confirmation" class="auth-field-label">Confirm Password</label>
                    <div class="auth-input-wrapper">
                        <input type="password" 
                               name="password_confirmation" 
                               id="register_password_confirmation" 
                               class="auth-input" 
                               required 
                               autocomplete="new-password" 
                               placeholder="Re-enter your password">
                        <span class="auth-input-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            </svg>
                        </span>
                        <button type="button" 
                                class="auth-toggle-pwd-btn" 
                                aria-label="Toggle password visibility" 
                                onclick="togglePasswordVisibility('register_password_confirmation', this)">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <span class="auth-error-msg">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-gold auth-submit-btn">
                    <span>Create Your Free Account</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </button>

                <!-- Seamless Switcher Prompt -->
                <div class="auth-switch-prompt">
                    <span>Already have an account?</span>
                    <button type="button" class="auth-switch-action-btn" onclick="setAuthTab('login')">
                        Sign in to your account &rarr;
                    </button>
                </div>
            </form>
        </div>

        <!-- Trust Features Strip -->
        <div class="auth-trust-strip">
            <div class="auth-trust-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <span>Save custom itineraries</span>
            </div>
            <div class="auth-trust-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <span>Verified local vendors</span>
            </div>
            <div class="auth-trust-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <span>100% free access</span>
            </div>
        </div>
    </div>
</div>

<script>
    function setAuthTab(tab, updateHash = true) {
        const btnLogin = document.getElementById('tabBtnLogin');
        const btnRegister = document.getElementById('tabBtnRegister');
        const panelLogin = document.getElementById('panelLogin');
        const panelRegister = document.getElementById('panelRegister');

        if (!btnLogin || !btnRegister || !panelLogin || !panelRegister) return;

        if (tab === 'register') {
            btnLogin.classList.remove('active');
            btnLogin.setAttribute('aria-selected', 'false');
            panelLogin.classList.remove('active');

            btnRegister.classList.add('active');
            btnRegister.setAttribute('aria-selected', 'true');
            panelRegister.classList.add('active');

            if (updateHash && window.history && window.history.replaceState) {
                window.history.replaceState(null, null, '#register');
            }

            const nameInput = document.getElementById('register_name');
            if (nameInput) setTimeout(() => nameInput.focus(), 80);
        } else {
            btnRegister.classList.remove('active');
            btnRegister.setAttribute('aria-selected', 'false');
            panelRegister.classList.remove('active');

            btnLogin.classList.add('active');
            btnLogin.setAttribute('aria-selected', 'true');
            panelLogin.classList.add('active');

            if (updateHash && window.history && window.history.replaceState) {
                window.history.replaceState(null, null, '#login');
            }

            const emailInput = document.getElementById('login_email');
            if (emailInput) setTimeout(() => emailInput.focus(), 80);
        }
    }

    function togglePasswordVisibility(inputId, btn) {
        const input = document.getElementById(inputId);
        if (!input) return;

        if (input.type === 'password') {
            input.type = 'text';
            btn.innerHTML = `
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                    <line x1="1" y1="1" x2="23" y2="23"></line>
                </svg>
            `;
            btn.setAttribute('aria-label', 'Hide password');
        } else {
            input.type = 'password';
            btn.innerHTML = `
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                </svg>
            `;
            btn.setAttribute('aria-label', 'Show password');
        }
    }

    // Auto-detect hash or query param on page load
    document.addEventListener('DOMContentLoaded', function () {
        const hash = window.location.hash;
        if (hash === '#register') {
            setAuthTab('register', false);
        } else if (hash === '#login') {
            setAuthTab('login', false);
        }
    });
</script>
