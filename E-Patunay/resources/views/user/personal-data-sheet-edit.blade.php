@extends('layouts.app')
@section('title', 'Edit Personal Data Sheet - E-Patunay')

@section('content')
<div class="min-h-screen bg-[#060e1a] bg-mesh py-12 px-4">
    <div class="max-w-2xl mx-auto">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-8 animate-fade-in-up">
            <div>
                <img src="{{ asset('images/logo.png') }}" alt="e-Patunay" class="h-10 mb-1">
                <p class="text-gray-500 text-sm font-medium">Edit Personal Data Sheet</p>
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
                <p class="text-gray-500 text-xs">Update your Personal Data Sheet</p>
            </div>
        </div>

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

            {{-- Edit form --}}
            <form method="POST" action="{{ route('user.personal-data-sheet.update', $form->id) }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="animate-fade-in-up delay-300">
                    <label for="full_name" class="block text-xs text-gray-500 mb-2 font-semibold tracking-wider uppercase">Full Name</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </span>
                        <input type="text" id="full_name" name="full_name"
                               value="{{ old('full_name', $form->full_name) }}" required
                               class="input-dark w-full pl-11 pr-4 py-3.5 rounded-xl text-white placeholder-gray-600 focus:outline-none text-sm"
                               placeholder="e.g. Juan Dela Cruz">
                    </div>
                    @error('full_name')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="animate-fade-in-up delay-400">
                    <label for="age" class="block text-xs text-gray-500 mb-2 font-semibold tracking-wider uppercase">Age</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </span>
                        <input type="number" id="age" name="age"
                               value="{{ old('age', $form->age) }}" required min="1" max="150"
                               class="input-dark w-full pl-11 pr-4 py-3.5 rounded-xl text-white placeholder-gray-600 focus:outline-none text-sm"
                               placeholder="e.g. 25">
                    </div>
                    @error('age')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="animate-fade-in-up delay-500">
                    <label for="address" class="block text-xs text-gray-500 mb-2 font-semibold tracking-wider uppercase">Address</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3.5 text-gray-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </span>
                        <input type="text" id="address" name="address"
                               value="{{ old('address', $form->address) }}" required
                               class="input-dark w-full pl-11 pr-4 py-3.5 rounded-xl text-white placeholder-gray-600 focus:outline-none text-sm"
                               placeholder="e.g. Brgy. Commonwealth, District 5, Quezon City">
                    </div>
                    @error('address')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="animate-fade-in-up delay-600">
                    <label for="email_address" class="block text-xs text-gray-500 mb-2 font-semibold tracking-wider uppercase">Email Address</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </span>
                        <input type="email" id="email_address" name="email_address"
                               value="{{ old('email_address', $form->email_address) }}" required
                               class="input-dark w-full pl-11 pr-4 py-3.5 rounded-xl text-white placeholder-gray-600 focus:outline-none text-sm"
                               placeholder="e.g. juan@example.com">
                    </div>
                    @error('email_address')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-2 flex gap-3">
                    <a href="{{ route('user.personal-data-sheet') }}"
                       class="flex-1 py-3.5 text-gray-400 font-bold rounded-xl text-sm tracking-wide flex items-center justify-center border border-slate-600/50 hover:bg-slate-800/50 transition-all duration-300">
                        Cancel
                    </a>
                    <button type="submit" class="flex-1 btn-primary py-3.5 text-white font-bold rounded-xl text-sm tracking-wide">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
