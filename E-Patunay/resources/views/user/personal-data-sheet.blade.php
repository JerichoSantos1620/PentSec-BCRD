@extends('layouts.app')
@section('title', 'Personal Data Sheet - E-Patunay')

@section('content')
<div class="min-h-screen bg-[#060e1a] bg-mesh py-12 px-4">
    <div class="max-w-2xl mx-auto">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-8 animate-fade-in-up">
            <div>
                <img src="{{ asset('images/logo.png') }}" alt="e-Patunay" class="h-10 mb-1">
                <p class="text-gray-500 text-sm font-medium">Personal Data Sheet</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm text-red-400/80 hover:text-red-300 flex items-center gap-2 px-4 py-2.5 rounded-xl border border-red-500/20 hover:bg-red-500/10 hover:border-red-500/40 transition-all duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Sign Out
                </button>
            </form>
        </div>

        {{-- Welcome bar --}}
        <div class="glass-card rounded-xl p-4 mb-6 flex items-center gap-3 animate-fade-in-up delay-100">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center text-white text-sm font-bold shadow-lg shadow-cyan-500/20">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div>
                <p class="text-white text-sm font-semibold">Welcome, {{ Auth::user()->name }}</p>
                <p class="text-gray-500 text-xs">Complete your Personal Data Sheet below</p>
            </div>
            @if ($form)
                <div class="ml-auto flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/20">
                    <svg class="w-3.5 h-3.5 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    <span class="text-emerald-400 text-xs font-medium">Submitted</span>
                </div>
            @endif
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-xl text-emerald-400 text-sm flex items-center gap-3 animate-scale-in">
                <div class="w-8 h-8 rounded-lg bg-emerald-500/20 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                </div>
                {{ session('success') }}
            </div>
        @endif

        {{-- Form card --}}
        <div class="glass-card rounded-2xl p-8 shadow-2xl shadow-black/20 animate-fade-in-up delay-200">
            <div class="text-center mb-8">
                <p class="text-gray-600 text-[11px] uppercase tracking-[0.25em] font-semibold">Republic of the Philippines</p>
                <p class="text-gray-600 text-[11px]">Civil Service Commission</p>
                <h2 class="text-xl font-bold text-white mt-3 tracking-wide">PERSONAL <span class="text-cyan-400">DATA SHEET</span></h2>
                <div class="w-16 h-0.5 bg-gradient-to-r from-cyan-500 to-teal-500 mx-auto mt-3 rounded-full"></div>
            </div>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-xl animate-scale-in">
                    @foreach ($errors->all() as $error)
                        <p class="text-red-400 text-sm flex items-center gap-2">
                            <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $error }}
                        </p>
                    @endforeach
                </div>
            @endif

            @if ($isLocked)
                {{-- Read-only display when locked --}}
                <div class="space-y-5">
                    <div class="animate-fade-in-up delay-300">
                        <label class="block text-xs text-gray-500 mb-2 font-semibold tracking-wider uppercase">Full Name</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </span>
                            <div class="input-dark w-full pl-11 pr-4 py-3.5 rounded-xl text-white text-sm opacity-70">{{ $form->full_name }}</div>
                        </div>
                    </div>

                    <div class="animate-fade-in-up delay-400">
                        <label class="block text-xs text-gray-500 mb-2 font-semibold tracking-wider uppercase">Age</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </span>
                            <div class="input-dark w-full pl-11 pr-4 py-3.5 rounded-xl text-white text-sm opacity-70">{{ $form->age }}</div>
                        </div>
                    </div>

                    <div class="animate-fade-in-up delay-500">
                        <label class="block text-xs text-gray-500 mb-2 font-semibold tracking-wider uppercase">Address</label>
                        <div class="relative">
                            <span class="absolute left-4 top-3.5 text-gray-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </span>
                            <div class="input-dark w-full pl-11 pr-4 py-3.5 rounded-xl text-white text-sm opacity-70">{{ $form->address }}</div>
                        </div>
                    </div>

                    <div class="animate-fade-in-up delay-600">
                        <label class="block text-xs text-gray-500 mb-2 font-semibold tracking-wider uppercase">Email Address</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </span>
                            <div class="input-dark w-full pl-11 pr-4 py-3.5 rounded-xl text-white text-sm opacity-70">{{ $form->email_address }}</div>
                        </div>
                    </div>

                    {{-- 12-month lock notice --}}
                    <div class="mt-4 p-4 bg-amber-500/8 border border-amber-500/20 rounded-xl animate-fade-in-up">
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-lg bg-amber-500/15 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4.5 h-4.5 text-amber-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-amber-400 text-sm font-semibold">Submission Locked</p>
                                <p class="text-amber-400/60 text-xs mt-1 leading-relaxed">
                                    Your Personal Data Sheet can only be updated once every 12 months.
                                    Your next available update is on <span class="font-semibold text-amber-400">{{ $nextUpdateDate->format('F d, Y') }}</span>.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Download PDF button --}}
                    <div class="pt-4">
                        <a href="{{ route('user.personal-data-sheet.download') }}"
                           class="btn-primary w-full py-3.5 text-white font-bold rounded-xl text-sm tracking-wide flex items-center justify-center gap-2 shadow-lg shadow-cyan-500/20">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Download as PDF
                        </a>
                    </div>
                </div>
            @else
                {{-- Editable form (new submission or lock expired) --}}
                <form method="POST" action="{{ route('user.personal-data-sheet.store') }}" class="space-y-5">
                    @csrf

                    <div class="animate-fade-in-up delay-300">
                        <label for="full_name" class="block text-xs text-gray-500 mb-2 font-semibold tracking-wider uppercase">Full Name</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </span>
                            <input type="text" id="full_name" name="full_name"
                                   value="{{ old('full_name', $form->full_name ?? '') }}" required
                                   class="input-dark w-full pl-11 pr-4 py-3.5 rounded-xl text-white placeholder-gray-600 focus:outline-none text-sm"
                                   placeholder="e.g. Juan Dela Cruz">
                        </div>
                    </div>

                    <div class="animate-fade-in-up delay-400">
                        <label for="age" class="block text-xs text-gray-500 mb-2 font-semibold tracking-wider uppercase">Age</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </span>
                            <input type="number" id="age" name="age"
                                   value="{{ old('age', $form->age ?? '') }}" required min="1" max="150"
                                   class="input-dark w-full pl-11 pr-4 py-3.5 rounded-xl text-white placeholder-gray-600 focus:outline-none text-sm"
                                   placeholder="e.g. 25">
                        </div>
                    </div>

                    <div class="animate-fade-in-up delay-500">
                        <label for="address" class="block text-xs text-gray-500 mb-2 font-semibold tracking-wider uppercase">Address</label>
                        <div class="relative">
                            <span class="absolute left-4 top-3.5 text-gray-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </span>
                            <input type="text" id="address" name="address"
                                   value="{{ old('address', $form->address ?? '') }}" required
                                   class="input-dark w-full pl-11 pr-4 py-3.5 rounded-xl text-white placeholder-gray-600 focus:outline-none text-sm"
                                   placeholder="e.g. Brgy. Commonwealth, District 5, Quezon City">
                        </div>
                    </div>

                    <div class="animate-fade-in-up delay-600">
                        <label for="email_address" class="block text-xs text-gray-500 mb-2 font-semibold tracking-wider uppercase">Email Address</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </span>
                            <input type="email" id="email_address" name="email_address"
                                   value="{{ old('email_address', $form->email_address ?? '') }}" required
                                   class="input-dark w-full pl-11 pr-4 py-3.5 rounded-xl text-white placeholder-gray-600 focus:outline-none text-sm"
                                   placeholder="e.g. juan@example.com">
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="btn-primary w-full py-3.5 text-white font-bold rounded-xl text-sm tracking-wide">
                            Submit Personal Data Sheet
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
