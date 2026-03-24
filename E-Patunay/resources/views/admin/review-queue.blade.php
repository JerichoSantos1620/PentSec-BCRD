@extends('layouts.app')
@section('title', 'Document Review Queue - E-Patunay Admin')

@section('content')
<div class="min-h-screen bg-[#060e1a] bg-mesh py-12 px-4">
    <div class="max-w-7xl mx-auto">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <img src="{{ asset('images/logo.png') }}" alt="e-Patunay" class="h-10 mb-1">
                <p class="text-gray-500 text-sm font-medium">Document Review Queue</p>
            </div>
            <a href="{{ route('admin.analytics') }}" class="text-cyan-400 hover:text-cyan-300 text-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                Analytics
            </a>
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-xl text-emerald-400 text-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Documents Table --}}
        <div class="glass-card rounded-2xl p-8 shadow-2xl">
            <h2 class="text-2xl font-bold text-white mb-6">Pending Documents for Review</h2>

            @if ($pendingDocuments->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-700">
                                <th class="text-left py-3 px-4 text-gray-400 font-semibold">Tracking Ref</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-semibold">Type</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-semibold">Submitter</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-semibold">Status</th>
                                <th class="text-left py-3 px-4 text-gray-400 font-semibold">Submitted</th>
                                <th class="text-center py-3 px-4 text-gray-400 font-semibold">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pendingDocuments as $doc)
                                <tr class="border-b border-gray-700/50 hover:bg-gray-800/30 transition">
                                    <td class="py-3 px-4 text-white font-mono text-xs">{{ $doc->tracking_reference }}</td>
                                    <td class="py-3 px-4 text-gray-300">{{ $doc->document_type }}</td>
                                    <td class="py-3 px-4 text-gray-300">{{ $doc->user->name }}</td>
                                    <td class="py-3 px-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                                            @if ($doc->status === 'submitted') bg-blue-500/20 text-blue-300
                                            @elseif ($doc->status === 'returned') bg-orange-500/20 text-orange-300
                                            @endif">
                                            {{ ucfirst(str_replace('_', ' ', $doc->status)) }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-gray-400 text-xs">{{ $doc->created_at->format('M d, Y') }}</td>
                                    <td class="py-3 px-4 text-center">
                                        <form method="POST" action="{{ route('admin.review-document', $doc->id) }}" class="inline" onclick="return showReviewModal(event, {{ $doc->id }})">
                                            @csrf
                                            <button type="button" class="text-cyan-400 hover:text-cyan-300 text-sm">Review</button>
                                        </form>
                                    </td>
                                </tr>

                                {{-- Modal for review actions --}}
                                <div id="reviewModal{{ $doc->id }}" class="hidden fixed inset-0 flex items-center justify-center z-50 p-4" style="background-color: rgba(6, 14, 26, 0.85);">
                                    <div class="rounded-2xl p-8 max-w-md w-full border border-gray-600" style="background-color: #0a1120;">
                                        <h3 class="text-white font-bold text-lg mb-4">Review Document: {{ $doc->tracking_reference }}</h3>
                                        <form method="POST" action="{{ route('admin.review-document', $doc->id) }}" class="space-y-4">
                                            @csrf
                                            <div>
                                                <label class="block text-gray-400 text-sm mb-2">Action</label>
                                                <div class="space-y-2">
                                                    <label class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-700/20 cursor-pointer">
                                                        <input type="radio" name="action" value="approve" class="w-4 h-4" checked>
                                                        <span class="text-white">Approve</span>
                                                    </label>
                                                    <label class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-700/20 cursor-pointer">
                                                        <input type="radio" name="action" value="return" class="w-4 h-4">
                                                        <span class="text-white">Return for Changes</span>
                                                    </label>
                                                    <label class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-700/20 cursor-pointer">
                                                        <input type="radio" name="action" value="reject" class="w-4 h-4">
                                                        <span class="text-white">Reject</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <label for="notes{{ $doc->id }}" class="block text-gray-400 text-sm mb-2">Notes (optional)</label>
                                                <textarea id="notes{{ $doc->id }}" name="reviewer_notes" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white text-sm" rows="3" placeholder="Add notes for the submitter..."></textarea>
                                            </div>
                                            <div class="flex gap-3">
                                                <button type="button" onclick="closeReviewModal({{ $doc->id }})" class="flex-1 px-4 py-2 rounded-lg bg-gray-600 text-gray-100 font-semibold hover:bg-gray-700">Cancel</button>
                                                <button type="submit" class="flex-1 px-4 py-2 rounded-lg bg-cyan-600 text-white font-semibold hover:bg-cyan-700">Submit Review</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-8 px-4 text-center text-gray-400">
                                        No pending documents for review
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if ($pendingDocuments->hasPages())
                    <div class="mt-6">
                        {{ $pendingDocuments->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-12">
                    <p class="text-gray-400">All documents have been reviewed</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
function showReviewModal(e, docId) {
    e.preventDefault();
    document.getElementById('reviewModal' + docId).classList.remove('hidden');
    return false;
}

function closeReviewModal(docId) {
    document.getElementById('reviewModal' + docId).classList.add('hidden');
}
</script>
@endsection
