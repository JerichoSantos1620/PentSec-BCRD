@extends('layouts.admin')
@section('title', 'Document Queue - E-Patunay Admin')

@section('content')
    <div class="p-8">
        {{-- Header --}}
        <div class="mb-8 animate-fade-in-up flex items-start justify-between">
            <div>
                <h1 class="text-2xl font-bold text-white">Document Queue</h1>
                <p class="text-gray-500 text-sm mt-1">Review and manage submitted Personal Data Sheets</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/20">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                    <span class="text-emerald-400 text-xs font-semibold">{{ $users->filter(fn($u) => $u->personalDataForm)->count() }} submitted</span>
                </div>
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/20">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                    <span class="text-amber-400 text-xs font-semibold">{{ $users->filter(fn($u) => !$u->personalDataForm)->count() }} pending</span>
                </div>
            </div>
        </div>

        {{-- Queue Table --}}
        <div class="glass-card rounded-xl overflow-hidden animate-fade-in-up delay-200">
            <div class="px-6 py-5 border-b border-[#1a3a5c]/50 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-blue-500/15 rounded-xl flex items-center justify-center">
                        <svg class="w-[18px] h-[18px] text-blue-400" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-white font-semibold">All Document Submissions</h2>
                        <p class="text-gray-600 text-xs mt-0.5">Personal Data Sheet records from registered users</p>
                    </div>
                </div>
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-cyan-500/10 border border-cyan-500/20">
                    <span class="text-cyan-400 text-xs font-semibold">{{ $users->count() }} total</span>
                </div>
            </div>

            @if($users->isEmpty())
                <div class="p-12 text-center">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-[#1a3a5c]/30 flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <p class="text-gray-500 font-medium">No documents in queue</p>
                    <p class="text-gray-600 text-sm mt-1">Documents will appear here once users submit their Personal Data Sheets</p>
                </div>
            @else
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-[#1a3a5c]/50 text-left">
                            <th class="px-6 py-3.5 text-[10px] font-semibold text-gray-500 uppercase tracking-wider">Document ID</th>
                            <th class="px-6 py-3.5 text-[10px] font-semibold text-gray-500 uppercase tracking-wider">Submitted By</th>
                            <th class="px-6 py-3.5 text-[10px] font-semibold text-gray-500 uppercase tracking-wider">Document Type</th>
                            <th class="px-6 py-3.5 text-[10px] font-semibold text-gray-500 uppercase tracking-wider">Date Submitted</th>
                            <th class="px-6 py-3.5 text-[10px] font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3.5 text-[10px] font-semibold text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#1a3a5c]/30">
                        @foreach ($users as $user)
                            <tr class="table-row-hover">
                                {{-- Document ID --}}
                                <td class="px-6 py-4">
                                    @if ($user->personalDataForm)
                                        <span class="text-cyan-400 font-mono text-xs font-semibold">PDS-{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</span>
                                    @else
                                        <span class="text-gray-600 font-mono text-xs">&mdash;</span>
                                    @endif
                                </td>

                                {{-- Submitted By --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 bg-gradient-to-br from-cyan-500/20 to-blue-600/20 rounded-xl flex items-center justify-center border border-cyan-500/10">
                                            <span class="text-cyan-400 text-sm font-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                        </div>
                                        <div>
                                            <span class="text-white text-sm font-medium block">{{ $user->name }}</span>
                                            <span class="text-gray-500 font-mono text-[11px]">{{ $user->email }}</span>
                                        </div>
                                    </div>
                                </td>

                                {{-- Document Type --}}
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[11px] font-semibold bg-blue-500/10 text-blue-400 border border-blue-500/20">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        Personal Data Sheet
                                    </span>
                                </td>

                                {{-- Date Submitted --}}
                                <td class="px-6 py-4">
                                    @if ($user->personalDataForm)
                                        <div>
                                            <span class="text-gray-400 text-xs block">{{ $user->personalDataForm->created_at->format('M d, Y') }}</span>
                                            <span class="text-gray-600 text-[11px]">{{ $user->personalDataForm->created_at->format('h:i A') }}</span>
                                        </div>
                                    @else
                                        <span class="text-gray-600 text-xs">&mdash;</span>
                                    @endif
                                </td>

                                {{-- Status --}}
                                <td class="px-6 py-4">
                                    @if ($user->personalDataForm)
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[11px] font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                            Submitted
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[11px] font-semibold bg-amber-500/10 text-amber-400 border border-amber-500/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                                            Pending
                                        </span>
                                    @endif
                                </td>

                                {{-- Action --}}
                                <td class="px-6 py-4">
                                    @if ($user->personalDataForm)
                                        <a href="{{ route('admin.document-preview', $user->id) }}"
                                            class="group relative inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-cyan-500/10 to-blue-500/10 border border-cyan-500/20 text-cyan-400 hover:from-cyan-500/20 hover:to-blue-500/20 hover:text-cyan-300 hover:border-cyan-400/40 hover:shadow-[0_0_20px_rgba(6,182,212,0.15)] transition-all duration-300 text-[11px] font-bold tracking-wide overflow-hidden uppercase">
                                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-cyan-400/10 to-transparent translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700 ease-in-out"></div>
                                            <svg class="w-4 h-4 relative z-10 group-hover:rotate-6 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            <span class="relative z-10">Review</span>
                                        </a>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-gray-500/5 border border-gray-500/10 text-gray-500 text-[11px] font-semibold tracking-wide uppercase">
                                            <svg class="w-3.5 h-3.5 opacity-70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Awaiting
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
