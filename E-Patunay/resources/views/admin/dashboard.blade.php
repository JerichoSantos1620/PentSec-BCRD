@extends('layouts.admin')
@section('title', 'Dashboard - E-Patunay Admin')

@section('content')
    <div class="p-8">
        {{-- Header --}}
        <div class="mb-8 animate-fade-in-up">
            <h1 class="text-2xl font-bold text-white">Dashboard Overview</h1>
            <p class="text-gray-500 text-sm mt-1">Cryptographic-Assurance Governance System &middot; Real-time monitoring
            </p>
        </div>

        {{-- Stats cards --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-8">
            <div class="stat-card glass-card rounded-xl p-6 animate-fade-in-up delay-100">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-11 h-11 bg-amber-500/15 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span
                        class="text-amber-400/60 text-[10px] font-semibold tracking-wider uppercase px-2 py-1 rounded-full bg-amber-500/10">Pending</span>
                </div>
                <p class="text-3xl font-extrabold text-white">{{ $pending }}</p>
                <p class="text-gray-500 text-sm mt-1">Pending Submissions</p>
            </div>
            <div class="stat-card glass-card rounded-xl p-6 animate-fade-in-up delay-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-11 h-11 bg-blue-500/15 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <span
                        class="text-blue-400/60 text-[10px] font-semibold tracking-wider uppercase px-2 py-1 rounded-full bg-blue-500/10">Forms</span>
                </div>
                <p class="text-3xl font-extrabold text-white">{{ $submitted }}</p>
                <p class="text-gray-500 text-sm mt-1">Submitted Forms</p>
            </div>
            <div class="stat-card glass-card rounded-xl p-6 animate-fade-in-up delay-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-11 h-11 bg-emerald-500/15 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <span
                        class="text-emerald-400/60 text-[10px] font-semibold tracking-wider uppercase px-2 py-1 rounded-full bg-emerald-500/10">Users</span>
                </div>
                <p class="text-3xl font-extrabold text-white">{{ $totalUsers }}</p>
                <p class="text-gray-500 text-sm mt-1">Total Users</p>
            </div>
            <div class="stat-card glass-card rounded-xl p-6 animate-fade-in-up delay-400">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-11 h-11 bg-red-500/15 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                    <span
                        class="text-red-400/60 text-[10px] font-semibold tracking-wider uppercase px-2 py-1 rounded-full bg-red-500/10">Alerts</span>
                </div>
                <p class="text-3xl font-extrabold text-white">0</p>
                <p class="text-gray-500 text-sm mt-1">Compliance Alerts</p>
            </div>
        </div>

        {{-- Pending Document Queue --}}
        <div class="glass-card rounded-xl overflow-hidden animate-fade-in-up delay-500">
            <div class="px-6 py-5 border-b border-[#1a3a5c]/50 flex items-center justify-between">
                <div>
                    <h2 class="text-white font-semibold">Pending Document Queue</h2>
                    <p class="text-gray-600 text-xs mt-0.5">All registered user submissions</p>
                </div>
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-cyan-500/10 border border-cyan-500/20">
                    <span class="text-cyan-400 text-xs font-semibold">{{ $totalUsers }} users</span>
                </div>
            </div>

            @if($users->isEmpty())
                <div class="p-12 text-center">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-[#1a3a5c]/30 flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                        </svg>
                    </div>
                    <p class="text-gray-500 font-medium">No users registered yet</p>
                    <p class="text-gray-600 text-sm mt-1">Users will appear here once they create an account</p>
                </div>
            @else
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-[#1a3a5c]/50 text-left">
                            <th class="px-6 py-3.5 text-[10px] font-semibold text-gray-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3.5 text-[10px] font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3.5 text-[10px] font-semibold text-gray-500 uppercase tracking-wider">Registered
                            </th>
                            <th class="px-6 py-3.5 text-[10px] font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3.5 text-[10px] font-semibold text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#1a3a5c]/30">
                        @foreach ($users as $user)
                            <tr class="table-row-hover">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-9 h-9 bg-gradient-to-br from-cyan-500/20 to-blue-600/20 rounded-xl flex items-center justify-center border border-cyan-500/10">
                                            <span
                                                class="text-cyan-400 text-sm font-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                        </div>
                                        <span class="text-white text-sm font-medium">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-400 text-sm font-mono text-xs">{{ $user->email }}</td>
                                <td class="px-6 py-4 text-gray-500 text-xs">{{ $user->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4">
                                    @if ($user->personalDataForm)
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[11px] font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                            Submitted
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[11px] font-semibold bg-amber-500/10 text-amber-400 border border-amber-500/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                                            Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if ($user->personalDataForm)
                                        <a href="{{ route('admin.document-queue') }}"
                                            class="group relative inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-cyan-500/10 to-blue-500/10 border border-cyan-500/20 text-cyan-400 hover:from-cyan-500/20 hover:to-blue-500/20 hover:text-cyan-300 hover:border-cyan-400/40 hover:shadow-[0_0_20px_rgba(6,182,212,0.15)] transition-all duration-300 text-[11px] font-bold tracking-wide overflow-hidden uppercase">
                                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-cyan-400/10 to-transparent translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700 ease-in-out"></div>
                                            <svg class="w-4 h-4 relative z-10 group-hover:rotate-6 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <span class="relative z-10">Review Form</span>
                                        </a>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-gray-500/5 border border-gray-500/10 text-gray-500 text-[11px] font-semibold tracking-wide uppercase">
                                            <svg class="w-3.5 h-3.5 opacity-70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Awaiting Submission
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