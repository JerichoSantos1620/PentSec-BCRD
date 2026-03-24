@extends('layouts.app')
@section('title', 'View Submission - E-Patunay')

@section('content')
<div class="min-h-screen bg-[#060e1a] bg-mesh py-12 px-4">
    <div class="max-w-4xl mx-auto">
        {{-- Header --}}
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('documents.submissions') }}" class="text-gray-400 hover:text-gray-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <img src="{{ asset('images/logo.png') }}" alt="e-Patunay" class="h-10 mb-1">
                <p class="text-gray-500 text-sm font-medium">Submission Details</p>
            </div>
        </div>

        {{-- Document Info Card --}}
        <div class="glass-card rounded-2xl p-8 shadow-2xl mb-6">
            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <p class="text-gray-500 text-sm uppercase mb-1">Tracking Reference</p>
                    <p class="text-white font-mono font-bold text-lg">{{ $document->tracking_reference }}</p>
                </div>
                <div>
                    <p class="text-gray-500 text-sm uppercase mb-1">Status</p>
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                        @if ($document->status === 'submitted') bg-blue-500/20 text-blue-300
                        @elseif ($document->status === 'under_review') bg-yellow-500/20 text-yellow-300
                        @elseif ($document->status === 'approved') bg-emerald-500/20 text-emerald-300
                        @elseif ($document->status === 'rejected') bg-red-500/20 text-red-300
                        @elseif ($document->status === 'returned') bg-orange-500/20 text-orange-300
                        @endif">
                        {{ ucfirst(str_replace('_', ' ', $document->status)) }}
                    </span>
                </div>
                <div>
                    <p class="text-gray-500 text-sm uppercase mb-1">Document Type</p>
                    <p class="text-white">{{ $document->document_type }}</p>
                </div>
                <div>
                    <p class="text-gray-500 text-sm uppercase mb-1">Submitted On</p>
                    <p class="text-white">{{ $document->created_at->format('M d, Y \a\t g:i A') }}</p>
                </div>
            </div>

            {{-- Metadata --}}
            @if ($document->metadata)
                <div class="border-t border-gray-700 pt-6">
                    <h3 class="text-white font-semibold mb-4">Document Information</h3>
                    @php $metadata = json_decode($document->metadata, true); @endphp
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-gray-500">Official Name</p>
                            <p class="text-gray-300">{{ $metadata['official_name'] ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Position</p>
                            <p class="text-gray-300">{{ $metadata['position'] ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">File Name</p>
                            <p class="text-gray-300 text-xs">{{ $metadata['file_name'] ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">File Size</p>
                            <p class="text-gray-300">{{ number_format($metadata['file_size'] ?? 0 / 1024 / 1024, 2) }} MB</p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Reviewer Notes (if rejected or returned) --}}
            @if ($document->reviewer_notes && in_array($document->status, ['rejected', 'returned']))
                <div class="border-t border-gray-700 pt-6 mt-6">
                    <h3 class="text-white font-semibold mb-2">Reviewer Notes</h3>
                    <div class="bg-red-500/10 border border-red-500/20 rounded-lg p-4">
                        <p class="text-red-300 text-sm">{{ $document->reviewer_notes }}</p>
                    </div>
                </div>
            @endif
        </div>

        {{-- Chain of Custody Timeline --}}
        <div class="glass-card rounded-2xl p-8 shadow-2xl">
            <h3 class="text-white font-bold text-lg mb-6">Workflow History</h3>

            @if ($auditLogs->count() > 0)
                <div class="space-y-4">
                    @foreach ($auditLogs as $log)
                        @php $details = json_decode($log->event_details, true) ?? []; @endphp
                        <div class="flex gap-4 pb-4 border-b border-gray-700 last:border-b-0">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full bg-cyan-500/20 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-cyan-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-grow">
                                <div class="flex justify-between items-start mb-1">
                                    <p class="text-white font-semibold capitalize">{{ str_replace('_', ' ', $log->event_type) }}</p>
                                    <p class="text-gray-500 text-xs">{{ \Carbon\Carbon::createFromTimestamp($log->timestamp)->format('M d, Y g:i A') }}</p>
                                </div>
                                @if ($log->user)
                                    <p class="text-gray-400 text-sm">By: {{ $log->user->name }}</p>
                                @endif
                                @if (isset($details['action']))
                                    <p class="text-gray-400 text-sm mt-1">{{ $details['action'] }}</p>
                                @endif
                                <div class="mt-2 text-xs text-gray-500 font-mono">
                                    Hash: <span class="text-gray-600">{{ substr($log->document_hash, 0, 32) }}...</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-400 text-center py-8">No history recorded yet</p>
            @endif
        </div>
    </div>
</div>
@endsection
