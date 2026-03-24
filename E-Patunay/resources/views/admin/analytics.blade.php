@extends('layouts.app')
@section('title', 'Analytics Dashboard - E-Patunay Admin')

@section('content')
<div class="min-h-screen bg-[#060e1a] bg-mesh py-12 px-4">
    <div class="max-w-7xl mx-auto">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <img src="{{ asset('images/logo.png') }}" alt="e-Patunay" class="h-10 mb-1">
                <p class="text-gray-500 text-sm font-medium">Governance Analytics Dashboard</p>
            </div>
            <a href="{{ route('admin.review-queue') }}" class="text-cyan-400 hover:text-cyan-300 text-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Review Queue
            </a>
        </div>

        {{-- KPI Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            {{-- Total Submissions --}}
            <div class="glass-card rounded-xl p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-semibold uppercase">Total Submissions</p>
                        <p class="text-white text-3xl font-bold mt-2">{{ $totalSubmissions }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-cyan-500/20 flex items-center justify-center">
                        <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Approval Rate --}}
            <div class="glass-card rounded-xl p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-semibold uppercase">Approval Rate</p>
                        <p class="text-white text-3xl font-bold mt-2">{{ $approvalRate }}%</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-emerald-500/20 flex items-center justify-center">
                        <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Avg Processing Time --}}
            <div class="glass-card rounded-xl p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-semibold uppercase">Avg Processing</p>
                        <p class="text-white text-3xl font-bold mt-2">{{ round($avgProcessingTime, 1) }}<span class="text-lg">h</span></p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-orange-500/20 flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Status Breakdown --}}
            <div class="glass-card rounded-xl p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-semibold uppercase">Pending Review</p>
                        <p class="text-white text-3xl font-bold mt-2">
                            @php
                                $pendingCount = ($documentsByStatus['submitted'] ?? 0) + ($documentsByStatus['returned'] ?? 0);
                            @endphp
                            {{ $pendingCount }}
                        </p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-blue-500/20 flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Documents by Type Chart --}}
            <div class="glass-card rounded-2xl p-8">
                <h3 class="text-white font-bold text-lg mb-6">Submissions by Document Type</h3>
                <div class="space-y-4">
                    @forelse ($documentsByType as $type => $count)
                        @php
                            $total = $documentsByType->sum();
                            $percentage = ($count / $total) * 100;
                        @endphp
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-gray-300">{{ $type }}</span>
                                <span class="text-white font-semibold">{{ $count }} ({{ round($percentage, 1) }}%)</span>
                            </div>
                            <div class="w-full h-2 bg-gray-700 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-cyan-500 to-cyan-400" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-400 text-center py-4">No data available</p>
                    @endforelse
                </div>
            </div>

            {{-- Document Status Distribution --}}
            <div class="glass-card rounded-2xl p-8">
                <h3 class="text-white font-bold text-lg mb-6">Status Distribution</h3>
                <div class="space-y-3">
                    @php
                        $statuses = ['submitted' => 'Submitted', 'under_review' => 'Under Review', 'approved' => 'Approved', 'rejected' => 'Rejected', 'returned' => 'Returned'];
                    @endphp
                    @foreach ($statuses as $key => $label)
                        @php $count = $documentsByStatus[$key] ?? 0; @endphp
                        <div class="flex items-center justify-between p-3 rounded-lg bg-gray-800/30">
                            <span class="text-gray-300">{{ $label }}</span>
                            <span class="px-3 py-1 rounded-full text-sm font-semibold
                                @if ($key === 'submitted') bg-blue-500/20 text-blue-300
                                @elseif ($key === 'under_review') bg-yellow-500/20 text-yellow-300
                                @elseif ($key === 'approved') bg-emerald-500/20 text-emerald-300
                                @elseif ($key === 'rejected') bg-red-500/20 text-red-300
                                @elseif ($key === 'returned') bg-orange-500/20 text-orange-300
                                @endif">
                                {{ $count }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Monthly Submissions Trend --}}
        <div class="glass-card rounded-2xl p-8 mt-6">
            <h3 class="text-white font-bold text-lg mb-6">Monthly Submission Trend</h3>
            <div class="space-y-4">
                @if ($monthlySubmissions->count() > 0)
                    @php
                        $maxCount = $monthlySubmissions->max();
                    @endphp
                    @foreach ($monthlySubmissions as $month => $count)
                        @php
                            $percentage = ($count / $maxCount) * 100;
                        @endphp
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-gray-300 text-sm">{{ \Carbon\Carbon::parse($month)->format('M Y') }}</span>
                                <span class="text-white font-semibold">{{ $count }}</span>
                            </div>
                            <div class="w-full h-3 bg-gray-700 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-cyan-500 to-blue-500" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-400 text-center py-8">No data available</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
