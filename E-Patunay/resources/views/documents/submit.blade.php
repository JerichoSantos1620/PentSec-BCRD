@extends('layouts.app')
@section('title', 'Submit Document - E-Patunay')

@section('content')
<div class="min-h-screen bg-[#060e1a] bg-mesh py-12 px-4">
    <div class="max-w-2xl mx-auto">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <img src="{{ asset('images/logo.png') }}" alt="e-Patunay" class="h-10 mb-1">
                <p class="text-gray-500 text-sm font-medium">Document Submission</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm text-red-400/80 hover:text-red-300 flex items-center gap-2 px-4 py-2.5 rounded-xl border border-red-500/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Sign Out
                </button>
            </form>
        </div>

        {{-- Form card --}}
        <div class="glass-card rounded-2xl p-8 shadow-2xl">
            <h2 class="text-2xl font-bold text-white mb-6">Submit Document</h2>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-xl">
                    @foreach ($errors->all() as $error)
                        <p class="text-red-400 text-sm">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('documents.store') }}" enctype="multipart/form-data" class="space-y-5">
                @csrf

                {{-- Document Type --}}
                <div>
                    <label for="document_type" class="block text-xs text-gray-500 mb-2 font-semibold uppercase">Document Type</label>
                    <select id="document_type" name="document_type" required class="input-dark w-full pl-4 pr-4 py-3.5 rounded-xl text-white">
                        <option value="">Select Document Type</option>
                        @foreach ($documentTypes as $key => $label)
                            <option value="{{ $key }}" {{ old('document_type') == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Official Name --}}
                <div>
                    <label for="official_name" class="block text-xs text-gray-500 mb-2 font-semibold uppercase">Official Name</label>
                    <input type="text" id="official_name" name="official_name" value="{{ old('official_name', Auth::user()->name) }}" required
                           class="input-dark w-full pl-4 pr-4 py-3.5 rounded-xl text-white">
                </div>

                {{-- Position --}}
                <div>
                    <label for="position" class="block text-xs text-gray-500 mb-2 font-semibold uppercase">Position</label>
                    <input type="text" id="position" name="position" value="{{ old('position') }}" required
                           class="input-dark w-full pl-4 pr-4 py-3.5 rounded-xl text-white" placeholder="e.g., Barangay Captain">
                </div>

                {{-- Submission Date --}}
                <div>
                    <label for="submission_date" class="block text-xs text-gray-500 mb-2 font-semibold uppercase">Submission Date</label>
                    <input type="date" id="submission_date" name="submission_date" value="{{ old('submission_date', date('Y-m-d')) }}" required
                           class="input-dark w-full pl-4 pr-4 py-3.5 rounded-xl text-white">
                </div>

                {{-- Document File --}}
                <div>
                    <label for="document_file" class="block text-xs text-gray-500 mb-2 font-semibold uppercase">Upload PDF (Max 50MB)</label>
                    <div class="relative">
                        <input type="file" id="document_file" name="document_file" accept=".pdf" required
                               class="input-dark w-full pl-4 pr-4 py-3.5 rounded-xl text-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-500/20 file:text-cyan-300">
                    </div>
                    <p class="text-gray-500 text-xs mt-1">Only PDF files are accepted. Maximum size: 50MB</p>
                </div>

                {{-- Submit Button --}}
                <div class="pt-4">
                    <button type="submit" class="btn-primary w-full py-3.5 text-white font-bold rounded-xl text-sm">
                        Submit Document
                    </button>
                </div>
            </form>

            {{-- Link back to submissions --}}
            <div class="mt-6 pt-6 border-t border-gray-700">
                <a href="{{ route('documents.submissions') }}" class="text-cyan-400 hover:text-cyan-300 text-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    View My Submissions
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
