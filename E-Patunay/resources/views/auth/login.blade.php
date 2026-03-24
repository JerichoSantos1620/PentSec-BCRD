@extends('layouts.app')
@section('title', 'Login - E-Patunay')

@section('content')
    <div class="min-h-screen flex bg-[#060e1a] bg-mesh">
        {{-- Left: Branding --}}
        <div class="hidden lg:flex lg:w-1/2 items-center justify-center relative overflow-hidden">
            {{-- Decorative background elements --}}
            <div class="absolute inset-0">
                <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-cyan-500/5 rounded-full blur-3xl"></div>
                <div class="absolute bottom-1/3 right-1/4 w-48 h-48 bg-purple-500/5 rounded-full blur-3xl"></div>
                <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-teal-500/3 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
            </div>

            <div class="text-center animate-fade-in-up relative z-10 max-w-sm">
                {{-- Logo --}}
                <div class="animate-float mb-8">
                    <img src="{{ asset('images/logo.png') }}" alt="e-Patunay"
                        class="h-20 mx-auto drop-shadow-[0_0_25px_rgba(6,182,212,0.15)]">
                </div>
                <p class="text-gray-500 text-sm tracking-[0.3em] uppercase font-medium animate-fade-in delay-300">
                    Cryptographic Assurance Governance System</p>
            </div>

            {{-- Divider line --}}
            <div class="absolute right-0 top-0 bottom-0 login-divider"></div>
        </div>

        {{-- Right: Login form --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md animate-fade-in-up delay-100">
                {{-- Mobile logo --}}
                <div class="lg:hidden text-center mb-8">
                    <img src="{{ asset('images/logo.png') }}" alt="e-Patunay" class="h-12 mx-auto mb-3">
                    <p class="text-gray-600 text-[10px] tracking-[0.2em] uppercase">Cryptographic Assurance Governance</p>
                </div>

                <div class="glass-card rounded-2xl p-8 shadow-2xl shadow-black/30 animate-pulse-glow">
                    {{-- Step indicator --}}
                    <div class="flex items-center justify-center gap-2 mb-6">
                        <div class="step-dot active" id="stepDot1"></div>
                        <div class="step-line" id="stepLine"></div>
                        <div class="step-dot" id="stepDot2"></div>
                    </div>

                    {{-- Login step header --}}
                    <div id="loginHeader">
                        <h2 class="text-2xl font-bold text-white text-center mb-1">Welcome Back</h2>
                        <p class="text-gray-500 text-sm text-center mb-8">Sign in to access your secure account</p>
                    </div>

                    {{-- MFA step header (hidden by default) --}}
                    <div id="mfaHeader" class="hidden">
                        <div class="flex flex-col items-center mb-6">
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-500/20 to-orange-500/10 flex items-center justify-center border border-amber-500/20 mb-4">
                                <svg class="w-7 h-7 text-amber-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-white text-center">Verification Required</h2>
                            <p class="text-gray-500 text-sm text-center mt-1">Enter the 6-digit code sent to your device</p>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="mb-5 p-4 bg-red-500/10 border border-red-500/20 rounded-xl animate-scale-in">
                            @foreach ($errors->all() as $error)
                                <p class="text-red-400 text-sm flex items-center gap-2">
                                    <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ $error }}
                                </p>
                            @endforeach
                        </div>
                    @endif

                    {{-- Login Form --}}
                    <form method="POST" action="{{ route('login.submit') }}" id="loginForm" class="space-y-5">
                        @csrf
                        <input type="hidden" name="otp" id="otpHidden" value="">

                        <div class="animate-fade-in-up delay-200">
                            <label for="email"
                                class="block text-xs text-gray-500 mb-2 font-semibold tracking-wider uppercase">Email
                                Address</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </span>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                                    class="input-dark w-full pl-11 pr-4 py-3.5 rounded-xl text-white placeholder-gray-600 focus:outline-none text-sm"
                                    placeholder="Enter your email">
                            </div>
                        </div>

                        <div class="animate-fade-in-up delay-300">
                            <label for="password"
                                class="block text-xs text-gray-500 mb-2 font-semibold tracking-wider uppercase">Password</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </span>
                                <input type="password" id="password" name="password" required
                                    class="input-dark w-full pl-11 pr-4 py-3.5 rounded-xl text-white placeholder-gray-600 focus:outline-none text-sm"
                                    placeholder="Enter your password">
                            </div>
                        </div>

                        <div class="animate-fade-in-up delay-400">
                            <button type="submit"
                                class="btn-primary w-full py-3.5 text-white font-bold rounded-xl text-sm tracking-wide flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                SIGN IN SECURELY
                            </button>
                        </div>
                    </form>

                    {{-- MFA Screen (hidden by default, shown after Sign In) --}}
                    <div id="mfaScreen" class="hidden">
                        <div class="space-y-5">
                            <div>
                                <label class="block text-xs text-gray-500 mb-3 font-semibold tracking-wider uppercase">Verification Code</label>
                                <div class="flex gap-2.5 justify-between" id="otpContainer" role="group" aria-label="Verification code">
                                    @for ($i = 0; $i < 6; $i++)
                                        <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]"
                                            aria-label="Digit {{ $i + 1 }} of 6"
                                            class="otp-input w-full aspect-square max-w-[50px] text-center text-xl font-bold text-white rounded-xl input-dark focus:outline-none transition-all duration-200"
                                            data-index="{{ $i }}" autocomplete="off">
                                    @endfor
                                </div>
                            </div>

                            <div id="mfaStatus" class="flex items-center justify-center gap-2 py-2" aria-live="polite">
                                <div class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-pulse"></div>
                                <span class="text-gray-500 text-xs">Waiting for verification code...</span>
                            </div>

                            {{-- Resend timer --}}
                            <div class="text-center">
                                <p class="text-gray-600 text-xs">
                                    Didn't receive a code?
                                    <button type="button" id="resendBtn" class="text-gray-600 cursor-not-allowed" disabled>
                                        Resend in <span id="resendTimer">30</span>s
                                    </button>
                                </p>
                            </div>

                            {{-- Back to login --}}
                            <button type="button" id="backToLogin" class="w-full flex items-center justify-center gap-2 text-gray-500 hover:text-gray-300 text-sm transition-colors duration-200 py-2">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Back to sign in
                            </button>
                        </div>
                    </div>

                    {{-- Create Account link --}}
                    <div class="mt-6 text-center animate-fade-in delay-600" id="createAccountLink">
                        <p class="text-gray-600 text-sm">
                            Don't have an account?
                            <a href="{{ route('register') }}"
                                class="text-cyan-400 hover:text-cyan-300 font-semibold transition-colors duration-200">
                                Create Account
                            </a>
                        </p>
                    </div>

                    <div class="mt-5 pt-5 border-t border-[#1a3a5c]/30">
                        <p class="text-center text-gray-600 text-[11px] flex items-center justify-center gap-1.5">
                            <svg class="w-3 h-3 text-emerald-500/60" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            256-bit TLS Encrypted &middot; Multi-Factor Certificate (MFC)
                        </p>
                    </div>
                </div>

                {{-- Verification Portal Link --}}
                <div class="mt-5 text-center animate-fade-in delay-600">
                    <a href="{{ route('agency-login') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-[#1a3a5c]/60 bg-[#0a1628]/50 text-gray-400 hover:text-cyan-400 hover:border-cyan-500/30 hover:bg-cyan-500/5 transition-all duration-300 text-xs font-semibold tracking-wide uppercase group">
                        <svg class="w-4 h-4 text-gray-500 group-hover:text-cyan-400 transition-colors duration-300" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        External Agency Verification Portal
                        <svg class="w-3 h-3 opacity-50 group-hover:opacity-100 group-hover:translate-x-0.5 transition-all duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const TRANSITION_MS = 300;

    const form = document.getElementById('loginForm');
    const otpHidden = document.getElementById('otpHidden');
    const mfaScreen = document.getElementById('mfaScreen');
    const mfaStatus = document.getElementById('mfaStatus');
    const inputs = document.querySelectorAll('.otp-input');
    const loginHeader = document.getElementById('loginHeader');
    const mfaHeader = document.getElementById('mfaHeader');
    const stepDot2 = document.getElementById('stepDot2');
    const stepLine = document.getElementById('stepLine');
    const createAccountLink = document.getElementById('createAccountLink');
    const backToLogin = document.getElementById('backToLogin');
    const resendBtn = document.getElementById('resendBtn');
    const resendTimerEl = document.getElementById('resendTimer');
    const passwordInput = document.getElementById('password');
    let resendInterval = null;

    // -- Helpers --

    function resetOtpInputs() {
        inputs.forEach(function (i) {
            i.value = '';
            i.disabled = false;
            i.classList.remove('filled', 'complete');
        });
        otpHidden.value = '';
    }

    function slideOut(elements, callback) {
        elements.forEach(function (el) { el.classList.add('animate-step-exit'); });
        setTimeout(callback, TRANSITION_MS);
    }

    function slideIn(elements) {
        elements.forEach(function (el) {
            el.classList.remove('hidden');
            el.classList.add('animate-step-enter');
        });
    }

    function cleanAnimations(elements) {
        elements.forEach(function (el) {
            el.classList.remove('animate-step-exit', 'animate-step-enter');
        });
    }

    // -- Step 1: Sign In → show MFA --

    form.addEventListener('submit', function (e) {
        const email = document.getElementById('email');
        if (!email.value || !passwordInput.value) return;

        e.preventDefault();

        slideOut([form, loginHeader], function () {
            form.style.display = 'none';
            loginHeader.classList.add('hidden');
            createAccountLink.style.display = 'none';

            slideIn([mfaHeader, mfaScreen]);

            stepDot2.classList.add('active');
            stepLine.classList.add('active');

            setTimeout(function () { inputs[0].focus(); }, 150);
            startResendTimer();
        });
    });

    // -- Back to login --

    backToLogin.addEventListener('click', function () {
        slideOut([mfaScreen, mfaHeader], function () {
            mfaScreen.classList.add('hidden');
            mfaHeader.classList.add('hidden');
            cleanAnimations([mfaScreen, mfaHeader]);

            form.style.display = '';
            cleanAnimations([form, loginHeader]);
            loginHeader.classList.remove('hidden');
            slideIn([form, loginHeader]);
            createAccountLink.style.display = '';

            stepDot2.classList.remove('active');
            stepLine.classList.remove('active');

            resetOtpInputs();
            if (resendInterval) clearInterval(resendInterval);
        });
    });

    // -- OTP input handling --

    inputs.forEach(function (input, idx) {
        input.addEventListener('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');

            if (this.value) {
                this.classList.add('filled');
                if (idx < inputs.length - 1) {
                    inputs[idx + 1].focus();
                }
            } else {
                this.classList.remove('filled');
            }
            checkComplete();
        });

        input.addEventListener('keydown', function (e) {
            if (e.key === 'Backspace' && !this.value && idx > 0) {
                inputs[idx - 1].focus();
                inputs[idx - 1].value = '';
                inputs[idx - 1].classList.remove('filled');
            }
        });

        input.addEventListener('focus', function () {
            this.select();
        });

        input.addEventListener('paste', function (e) {
            e.preventDefault();
            const paste = (e.clipboardData || window.clipboardData).getData('text').replace(/[^0-9]/g, '');
            for (let i = 0; i < Math.min(paste.length, inputs.length - idx); i++) {
                inputs[idx + i].value = paste[i];
                inputs[idx + i].classList.add('filled');
            }
            const nextEmpty = Math.min(idx + paste.length, inputs.length - 1);
            inputs[nextEmpty].focus();
            checkComplete();
        });
    });

    function checkComplete() {
        let code = '';
        for (let i = 0; i < inputs.length; i++) {
            if (!inputs[i].value) return;
            code += inputs[i].value;
        }

        // All 6 digits filled
        inputs.forEach(function (i) { i.classList.add('complete'); i.classList.remove('filled'); });

        mfaStatus.innerHTML =
            '<svg class="w-4 h-4 text-emerald-400 animate-spin" fill="none" viewBox="0 0 24 24">' +
                '<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>' +
                '<path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>' +
            '</svg>' +
            '<span class="text-emerald-400 text-xs font-semibold">Verifying code...</span>';

        inputs.forEach(function (i) { i.disabled = true; });

        // Set OTP value and submit form directly
        otpHidden.value = code;
        form.submit();
    }

    // -- Resend timer --

    function startResendTimer() {
        let seconds = 30;
        resendTimerEl.textContent = seconds;
        resendBtn.disabled = true;
        resendBtn.className = 'text-gray-600 cursor-not-allowed';

        if (resendInterval) clearInterval(resendInterval);
        resendInterval = setInterval(function () {
            seconds--;
            resendTimerEl.textContent = seconds;
            if (seconds <= 0) {
                clearInterval(resendInterval);
                resendBtn.disabled = false;
                resendBtn.className = 'text-cyan-400 hover:text-cyan-300 font-semibold transition-colors duration-200 cursor-pointer';
                resendBtn.innerHTML = 'Resend Code';
            }
        }, 1000);
    }

    resendBtn.addEventListener('click', function () {
        if (!this.disabled) {
            startResendTimer();
            resetOtpInputs();
            inputs[0].focus();
            mfaStatus.innerHTML =
                '<div class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-pulse"></div>' +
                '<span class="text-gray-500 text-xs">A new code has been sent</span>';
        }
    });
});
</script>
@endsection
