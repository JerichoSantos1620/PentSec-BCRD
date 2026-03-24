@extends('layouts.admin')
@section('title', 'Document Preview - E-Patunay Admin')

@section('content')
<div class="p-8">
    {{-- Breadcrumb --}}
    <div class="mb-6 animate-fade-in">
        <nav class="flex items-center gap-2 text-sm">
            <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-300 transition-colors duration-200">Dashboard</a>
            <svg class="w-3.5 h-3.5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            <span class="text-gray-500">Document Queue</span>
            <svg class="w-3.5 h-3.5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            <span class="text-cyan-400 font-medium">Review: PDS-{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</span>
        </nav>
        <p class="text-gray-600 text-xs mt-1.5">Submitted by {{ $user->name }} &middot; {{ $user->personalDataForm?->updated_at?->format('M d, Y \\a\\t g:i A') }}</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Document Preview (left 2/3) --}}
        <div class="lg:col-span-2 animate-fade-in-up delay-100">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-xl font-bold text-white">Document Preview</h1>
                @if ($user->personalDataForm)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Integrity Verified
                    </span>
                @endif
            </div>

            @if ($user->personalDataForm)
                @php $form = $user->personalDataForm; @endphp
                <div class="bg-white rounded-2xl p-10 shadow-2xl shadow-black/20 border border-gray-200/50">
                    {{-- Document header --}}
                    <div class="text-center mb-10 pb-6 border-b-2 border-gray-100">
                        <p class="text-[11px] text-gray-400 uppercase tracking-[0.3em] font-bold">Republic of the Philippines</p>
                        <p class="text-[11px] text-gray-400 mt-0.5">Civil Service Commission &middot; Quezon City</p>
                        <h2 class="text-xl font-extrabold text-gray-900 mt-3 tracking-wide">PERSONAL <span class="text-blue-600">DATA SHEET</span></h2>
                        <div class="w-12 h-0.5 bg-gradient-to-r from-blue-500 to-cyan-500 mx-auto mt-3 rounded-full"></div>
                    </div>

                    {{-- Fields --}}
                    <div class="space-y-8">
                        <div class="grid grid-cols-2 gap-8">
                            <div>
                                <p class="text-[9px] text-gray-400 uppercase tracking-[0.2em] font-bold mb-1.5">Full Name</p>
                                <p class="text-sm font-semibold text-gray-900 border-b-2 border-gray-200 pb-2">{{ $form->full_name }}</p>
                            </div>
                            <div>
                                <p class="text-[9px] text-gray-400 uppercase tracking-[0.2em] font-bold mb-1.5">Age</p>
                                <p class="text-sm font-semibold text-gray-900 border-b-2 border-gray-200 pb-2">{{ $form->age }}</p>
                            </div>
                        </div>

                        <div>
                            <p class="text-[9px] text-gray-400 uppercase tracking-[0.2em] font-bold mb-1.5">Address</p>
                            <p class="text-sm font-semibold text-gray-900 border-b-2 border-gray-200 pb-2">{{ $form->address }}</p>
                        </div>

                        <div>
                            <p class="text-[9px] text-gray-400 uppercase tracking-[0.2em] font-bold mb-1.5">Email Address</p>
                            <p class="text-sm font-semibold text-gray-900 border-b-2 border-gray-200 pb-2">{{ $form->email_address }}</p>
                        </div>
                    </div>

                    {{-- Attestation --}}
                    <div class="mt-10 pt-6 border-t-2 border-gray-100">
                        <p class="text-[9px] text-gray-400 uppercase tracking-[0.2em] font-bold mb-2">Attestation</p>
                        <p class="text-xs text-gray-500 italic leading-relaxed">I hereby certify that the answers given above are true and correct to the best of my knowledge and belief. I understand that any falsification of information shall be subject to the applicable provisions of law.</p>
                    </div>

                    {{-- Signature placeholder --}}
                    <div class="mt-8 p-5 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-gray-200/80 flex items-center justify-center">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Awaiting Digital Signature</p>
                                <p class="text-[10px] text-gray-400 mt-0.5">District Officer's PKI Certificate</p>
                            </div>
                        </div>
                    </div>

                    {{-- Hash footer --}}
                    <div class="mt-6 p-4 bg-gradient-to-r from-gray-50 to-blue-50/30 rounded-xl border border-gray-100">
                        <p class="text-[9px] text-gray-400 font-mono break-all leading-relaxed">
                            <span class="font-bold text-gray-500">SHA-256:</span> {{ hash('sha256', json_encode($form->toArray())) }}
                        </p>
                    </div>
                </div>
            @else
                <div class="glass-card rounded-2xl p-16 text-center">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-[#1a3a5c]/30 flex items-center justify-center">
                        <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <p class="text-gray-400 font-medium">No submission yet</p>
                    <p class="text-gray-600 text-sm mt-1">This user has not submitted their Personal Data Sheet</p>
                </div>
            @endif
        </div>

        {{-- Review Actions (right 1/3) --}}
        <div class="space-y-5 animate-slide-right delay-200">
            {{-- Document Metadata --}}
            <div class="glass-card rounded-xl p-6">
                <h3 class="text-white font-semibold mb-1">Review Actions</h3>
                <p class="text-gray-600 text-xs mb-4">Document metadata & verification</p>
                <div class="space-y-3.5">
                    <div class="flex items-center justify-between py-2 border-b border-[#1a3a5c]/30">
                        <span class="text-gray-500 text-[10px] uppercase tracking-wider font-semibold">Document ID</span>
                        <span class="text-white text-sm font-mono font-semibold">PDS-{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-[#1a3a5c]/30">
                        <span class="text-gray-500 text-[10px] uppercase tracking-wider font-semibold">Submitter</span>
                        <span class="text-white text-sm">{{ $user->name }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-[#1a3a5c]/30">
                        <span class="text-gray-500 text-[10px] uppercase tracking-wider font-semibold">Document Type</span>
                        <span class="text-white text-sm">Personal Data Sheet</span>
                    </div>
                    <div class="flex items-center justify-between py-2">
                        <span class="text-gray-500 text-[10px] uppercase tracking-wider font-semibold">Integrity Check</span>
                        @if ($user->personalDataForm)
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[11px] font-bold bg-emerald-500/15 text-emerald-400 border border-emerald-500/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                SHA-256 OK
                            </span>
                        @else
                            <span class="text-gray-600 text-xs">N/A</span>
                        @endif
                    </div>
                </div>
            </div>

            @if ($user->personalDataForm)
                {{-- Action buttons --}}
                <div class="glass-card rounded-xl p-6 space-y-4">
                    <div class="bg-amber-500/8 border border-amber-500/20 rounded-xl p-4">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-amber-500/20 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </div>
                            <div>
                                <p class="text-amber-400 text-sm font-bold">Signing requires TOTP re-authentication</p>
                                <p class="text-amber-400/60 text-xs mt-1 leading-relaxed">You will be prompted for your authenticator code before digital signature is applied.</p>
                            </div>
                        </div>
                    </div>

                    <button class="w-full py-3.5 bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-500 hover:to-green-500 text-white font-bold rounded-xl transition-all duration-300 shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/30 hover:-translate-y-0.5 text-sm tracking-wide flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        APPROVE & DIGITALLY SIGN
                    </button>
                    <div class="grid grid-cols-2 gap-3">
                        <button class="py-2.5 border border-[#1a3a5c]/60 text-gray-400 hover:text-white hover:border-gray-500 hover:bg-white/[0.03] rounded-xl text-sm transition-all duration-200 flex items-center justify-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/></svg>
                            Revision
                        </button>
                        <button class="py-2.5 border border-red-500/20 text-red-400/80 hover:text-red-300 hover:border-red-500/40 hover:bg-red-500/5 rounded-xl text-sm transition-all duration-200 flex items-center justify-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                            Reject
                        </button>
                    </div>
                </div>

                {{-- Document Chain of Custody --}}
                <div class="glass-card rounded-xl p-6">
                    <h3 class="text-white font-semibold mb-1">Document Chain of Custody</h3>
                    <p class="text-gray-600 text-xs mb-5">Immutable audit trail</p>
                    <div class="space-y-0">
                        {{-- Submitted --}}
                        <div class="flex gap-4 pb-5">
                            <div class="flex flex-col items-center">
                                <div class="w-8 h-8 rounded-lg bg-emerald-500/20 flex items-center justify-center border border-emerald-500/30">
                                    <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </div>
                                <div class="w-0.5 flex-1 bg-gradient-to-b from-emerald-500/40 to-cyan-500/40 mt-1.5"></div>
                            </div>
                            <div class="pb-1">
                                <p class="text-emerald-400 text-sm font-semibold">Submitted</p>
                                <p class="text-gray-500 text-xs mt-0.5">{{ $user->personalDataForm->created_at->format('M d, Y \\a\\t g:i A') }}</p>
                                <p class="text-gray-600 text-xs">by {{ $user->name }}</p>
                            </div>
                        </div>
                        {{-- Under Review --}}
                        <div class="flex gap-4 pb-5">
                            <div class="flex flex-col items-center">
                                <div class="w-8 h-8 rounded-lg bg-cyan-500/20 flex items-center justify-center border border-cyan-500/30 animate-pulse">
                                    <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </div>
                                <div class="w-0.5 flex-1 bg-gradient-to-b from-cyan-500/40 to-gray-700/20 mt-1.5"></div>
                            </div>
                            <div class="pb-1">
                                <p class="text-cyan-400 text-sm font-semibold">Under Review</p>
                                <p class="text-gray-500 text-xs mt-0.5">Awaiting admin action</p>
                            </div>
                        </div>
                        {{-- Pending steps --}}
                        <div class="flex gap-4 pb-5">
                            <div class="flex flex-col items-center">
                                <div class="w-8 h-8 rounded-lg bg-gray-700/30 flex items-center justify-center border border-gray-700/30">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                </div>
                                <div class="w-0.5 flex-1 bg-gray-800/50 mt-1.5"></div>
                            </div>
                            <div class="pb-1">
                                <p class="text-gray-600 text-sm font-medium">Digital Signing</p>
                                <p class="text-gray-700 text-xs mt-0.5">Pending</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-8 h-8 rounded-lg bg-gray-700/30 flex items-center justify-center border border-gray-700/30">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
                                </div>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Approved & Archived</p>
                                <p class="text-gray-700 text-xs mt-0.5">Pending</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
