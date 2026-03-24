@extends('layouts.app')
@section('title', 'Agency Login - E-Patunay')

@section('content')
    <div class="min-h-screen flex bg-[#060e1a] bg-mesh">
        {{-- Left: Branding --}}
        <div class="hidden lg:flex lg:w-1/2 items-center justify-center relative overflow-hidden">
            {{-- Decorative background elements --}}
            <div class="absolute inset-0">
                <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-amber-500/5 rounded-full blur-3xl"></div>
                <div class="absolute bottom-1/3 right-1/4 w-48 h-48 bg-orange-500/5 rounded-full blur-3xl"></div>
                <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-cyan-500/3 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
            </div>

            <div class="text-center animate-fade-in-up relative z-10 max-w-sm">
                {{-- Logo --}}
                <div class="animate-float mb-8">
                    <img src="{{ asset('images/logo.png') }}" alt="e-Patunay"
                        class="h-20 mx-auto drop-shadow-[0_0_25px_rgba(6,182,212,0.15)]">
                </div>
                <p class="text-gray-500 text-sm tracking-[0.3em] uppercase font-medium animate-fade-in delay-300">
                    External Agency Verification</p>
            </div>

            {{-- Divider line --}}
            <div class="absolute right-0 top-0 bottom-0 login-divider"></div>
        </div>

        {{-- Right: Agency Login form --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md animate-fade-in-up delay-100">
                {{-- Mobile logo --}}
                <div class="lg:hidden text-center mb-8">
                    <img src="{{ asset('images/logo.png') }}" alt="e-Patunay" class="h-12 mx-auto mb-3">
                    <p class="text-gray-600 text-[10px] tracking-[0.2em] uppercase">External Agency Verification</p>
                </div>

                <div class="glass-card rounded-2xl p-8 shadow-2xl shadow-black/30 animate-pulse-glow">
                    {{-- Agency badge --}}
                    <div class="flex items-center justify-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500/20 to-orange-500/10 flex items-center justify-center border border-amber-500/20">
                            <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-white text-sm font-semibold">Commission on Audit</p>
                            <p class="text-amber-400 text-[10px] font-semibold tracking-wider uppercase">External Agency Access</p>
                        </div>
                    </div>

                    {{-- Header --}}
                    <h2 class="text-2xl font-bold text-white text-center mb-1">Agency Sign In</h2>
                    <p class="text-gray-500 text-sm text-center mb-8">Authorized external agency personnel only</p>

                    {{-- Error message --}}
                    <div id="agencyError" class="hidden mb-5 p-4 bg-red-500/10 border border-red-500/20 rounded-xl animate-scale-in">
                        <p class="text-red-400 text-sm flex items-center gap-2">
                            <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            Invalid credentials. Access is restricted to authorized external agencies only.
                        </p>
                    </div>

                    {{-- Login Form --}}
                    <form id="agencyLoginForm" class="space-y-5">
                        <div class="animate-fade-in-up delay-200">
                            <label for="agencyEmail"
                                class="block text-xs text-gray-500 mb-2 font-semibold tracking-wider uppercase">Username</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </span>
                                <input type="email" id="agencyEmail" required autofocus
                                    class="input-dark w-full pl-11 pr-4 py-3.5 rounded-xl text-white placeholder-gray-600 focus:outline-none text-sm"
                                    placeholder="Enter your agency email">
                            </div>
                        </div>

                        <div class="animate-fade-in-up delay-300">
                            <label for="agencyPassword"
                                class="block text-xs text-gray-500 mb-2 font-semibold tracking-wider uppercase">Password</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </span>
                                <input type="password" id="agencyPassword" required
                                    class="input-dark w-full pl-11 pr-4 py-3.5 rounded-xl text-white placeholder-gray-600 focus:outline-none text-sm"
                                    placeholder="Enter your password">
                            </div>
                        </div>

                        <div class="animate-fade-in-up delay-400">
                            <button type="submit"
                                class="btn-primary w-full py-3.5 text-white font-bold rounded-xl text-sm tracking-wide flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                SIGN IN TO PORTAL
                            </button>
                        </div>
                    </form>

                    {{-- Back to main login --}}
                    <div class="mt-6 text-center animate-fade-in delay-600">
                        <p class="text-gray-600 text-sm">
                            Not an external agency?
                            <a href="{{ route('login') }}"
                                class="text-cyan-400 hover:text-cyan-300 font-semibold transition-colors duration-200">
                                Back to Main Login
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
                            256-bit TLS Encrypted &middot; Read-Only Verification Access
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('agencyLoginForm');
    var emailInput = document.getElementById('agencyEmail');
    var passwordInput = document.getElementById('agencyPassword');
    var errorDiv = document.getElementById('agencyError');

    // Hide error when user starts typing
    emailInput.addEventListener('input', function () {
        errorDiv.classList.add('hidden');
    });
    passwordInput.addEventListener('input', function () {
        errorDiv.classList.add('hidden');
    });

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        var email = emailInput.value.trim();
        var password = passwordInput.value;

        if (email === 'admin@coa.com' && password === 'password') {
            window.location.href = '{{ route("verification-portal") }}';
        } else {
            errorDiv.classList.remove('hidden');
        }
    });
});
</script>
@endsection
