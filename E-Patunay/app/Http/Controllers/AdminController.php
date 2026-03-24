<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Document;
use App\Models\AuditLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::where('is_admin', false)
            ->with('personalDataForm')
            ->get();

        $totalUsers = $users->count();
        $submitted = $users->filter(fn ($u) => $u->personalDataForm !== null)->count();
        $pending = $totalUsers - $submitted;

        return view('admin.dashboard', compact('users', 'totalUsers', 'submitted', 'pending'));
    }

    public function documentQueue()
    {
        $users = User::where('is_admin', false)
            ->with('personalDataForm')
            ->latest()
            ->get();

        return view('admin.document-queue', compact('users'));
    }

    public function documentPreview(int $userId)
    {
        $user = User::where('is_admin', false)
            ->with('personalDataForm')
            ->findOrFail($userId);

        return view('admin.document-preview', compact('user'));
    }

    // Review Queue for submitted documents
    public function reviewQueue()
    {
        $pendingDocuments = Document::whereIn('status', ['submitted', 'returned'])
            ->with('user')
            ->latest()
            ->paginate(15);

        return view('admin.review-queue', compact('pendingDocuments'));
    }

    // Approve/Reject document
    public function reviewDocument(Request $request, int $id)
    {
        $document = Document::findOrFail($id);

        $validated = $request->validate([
            'action' => 'required|in:approve,reject,return',
            'reviewer_notes' => 'nullable|string|max:1000'
        ]);

        $user = Auth::user();

        if ($validated['action'] === 'approve') {
            $document->update([
                'status' => 'approved',
                'reviewed_by' => $user->id,
                'reviewed_at' => now()
            ]);

            AuditLog::create([
                'event_type' => 'approval',
                'timestamp' => time(),
                'user_id' => $user->id,
                'document_id' => $document->id,
                'document_hash' => $document->file_hash,
                'event_details' => json_encode(['action' => 'Document approved'])
            ]);

            return redirect()->back()->with('success', "Document {$document->tracking_reference} approved");

        } elseif ($validated['action'] === 'reject') {
            $document->update([
                'status' => 'rejected',
                'reviewer_notes' => $validated['reviewer_notes'],
                'reviewed_by' => $user->id,
                'reviewed_at' => now()
            ]);

            AuditLog::create([
                'event_type' => 'rejection',
                'timestamp' => time(),
                'user_id' => $user->id,
                'document_id' => $document->id,
                'document_hash' => $document->file_hash,
                'event_details' => json_encode(['action' => 'Document rejected'])
            ]);

            return redirect()->back()->with('success', "Document {$document->tracking_reference} rejected");

        } else { // return
            $document->update([
                'status' => 'returned',
                'reviewer_notes' => $validated['reviewer_notes'],
                'reviewed_by' => $user->id,
                'reviewed_at' => now()
            ]);

            AuditLog::create([
                'event_type' => 'return',
                'timestamp' => time(),
                'user_id' => $user->id,
                'document_id' => $document->id,
                'document_hash' => $document->file_hash,
                'event_details' => json_encode(['action' => 'Document returned to submitter'])
            ]);

            return redirect()->back()->with('success', "Document {$document->tracking_reference} returned");
        }
    }

    // Analytics Dashboard
    public function analytics()
    {
        // KPI Calculations
        $totalSubmissions = Document::count();
        $approvedCount = Document::where('status', 'approved')->count();
        $approvalRate = $totalSubmissions > 0 ? round(($approvedCount / $totalSubmissions) * 100, 1) : 0;

        // Average processing time (in hours)
        $avgProcessingTime = Document::where('status', 'approved')
            ->selectRaw('AVG(UNIX_TIMESTAMP(reviewed_at) - UNIX_TIMESTAMP(created_at)) / 3600 as avg_hours')
            ->value('avg_hours') ?? 0;

        // Documents by type (for chart)
        $documentsByType = Document::groupBy('document_type')
            ->selectRaw('document_type, COUNT(*) as count')
            ->pluck('count', 'document_type');

        // Documents by status
        $documentsByStatus = Document::groupBy('status')
            ->selectRaw('status, COUNT(*) as count')
            ->pluck('count', 'status');

        // Monthly submission trend
        $monthlySubmissions = Document::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->pluck('count', 'month');

        return view('admin.analytics', compact(
            'totalSubmissions',
            'approvalRate',
            'avgProcessingTime',
            'documentsByType',
            'documentsByStatus',
            'monthlySubmissions'
        ));
    }
}
