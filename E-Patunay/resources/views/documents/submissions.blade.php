@extends('layouts.app')
@section('title', 'My Submissions - E-Patunay')

@section('content')
<div class="min-h-screen bg-[#060e1a] bg-mesh py-12 px-4">
    <div class="max-w-6xl mx-auto">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <img src="{{ asset('images/logo.png') }}" alt="e-Patunay" class="h-10 mb-1">
                <p class="text-gray-500 text-sm font-medium">Submission Tracker</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('documents.submit') }}" class="text-sm text-cyan-400/80 hover:text-cyan-300 flex items-center gap-2 px-4 py-2.5 rounded-xl border border-cyan-500/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    New Submission
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-red-400/80 hover:text-red-300 flex items-center gap-2 px-4 py-2.5 rounded-xl border border-red-500/20">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Sign Out
                    </button>
                </form>
            </div>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-xl text-emerald-400 text-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Submissions Table --}}
        <div class="glass-card rounded-2xl p-8 shadow-2xl">
            <h2 class="text-2xl font-bold text-white mb-6">My Submissions</h2>

            @if ($documents->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-700">
                                <th class="text-left py-3 px-4 text-gray-400 font-semibold">Tracking Reference</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-semibold">Document Type</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-semibold">Status</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-semibold">Submitted</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-semibold">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($documents as $document)
                                <tr class="border-b border-gray-700/50 hover:bg-gray-800/30 transition">
                                    <td class="py-3 px-4 text-white font-mono text-xs">{{ $document->tracking_reference }}</td>
                                    <td class="py-3 px-4 text-gray-300">{{ $document->document_type }}</td>
                                    <td class="py-3 px-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                                            @if ($document->status === 'submitted') bg-blue-500/20 text-blue-300
                                            @elseif ($document->status === 'under_review') bg-yellow-500/20 text-yellow-300
                                            @elseif ($document->status === 'approved') bg-emerald-500/20 text-emerald-300
                                            @elseif ($document->status === 'rejected') bg-red-500/20 text-red-300
                                            @elseif ($document->status === 'returned') bg-orange-500/20 text-orange-300
                                            @endif">
                                            {{ ucfirst(str_replace('_', ' ', $document->status)) }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-gray-400 text-xs">{{ $document->created_at->format('M d, Y') }}</td>
                                    <td class="py-3 px-4">
                                        <a href="{{ route('documents.view', $document->id) }}" class="text-cyan-400 hover:text-cyan-300 text-sm">View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-8 px-4 text-center text-gray-400">
                                        <p>No submissions yet. <a href="{{ route('documents.submit') }}" class="text-cyan-400 hover:text-cyan-300">Submit your first document</a></p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if ($documents->hasPages())
                    <div class="mt-6">
                        {{ $documents->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <p class="text-gray-400 mb-4">You haven't submitted any documents yet</p>
                    <a href="{{ route('documents.submit') }}" class="btn-primary px-6 py-2 rounded-lg text-sm">Submit Document</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
