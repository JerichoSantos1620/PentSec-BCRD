<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function submitDocument()
    {
        $documentTypes = ['PDS' => 'Personal Data Sheet', 'SALN' => 'Statement of Assets, Liabilities & Net Worth', 'BR' => 'Barangay Resolution', 'SP' => 'Subpoena'];
        return view('documents.submit', compact('documentTypes'));
    }

    public function storeDocument(Request $request)
    {
        $validated = $request->validate([
            'document_type' => 'required|in:PDS,SALN,BR,SP',
            'document_file' => 'required|file|mimes:pdf|max:51200',
            'official_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'submission_date' => 'required|date'
        ], [
            'document_file.max' => 'File size must not exceed 50MB.',
            'document_file.mimes' => 'File must be in PDF format.'
        ]);

        try {
            $user = Auth::user();
            $file = $request->file('document_file');

            $trackingRef = 'DOC-' . date('Y') . '-' . str_pad(Document::count() + 1, 6, '0', STR_PAD_LEFT);

            $filePath = $file->store('documents/' . date('Y/m'), 'local');

            $fileHash = hash_file('sha256', $file->getRealPath());

            $document = Document::create([
                'user_id' => $user->id,
                'document_type' => $validated['document_type'],
                'status' => 'submitted',
                'tracking_reference' => $trackingRef,
                'file_path' => $filePath,
                'file_hash' => $fileHash,
                'metadata' => json_encode([
                    'official_name' => $validated['official_name'],
                    'position' => $validated['position'],
                    'submission_date' => $validated['submission_date'],
                    'file_size' => $file->getSize(),
                    'file_name' => $file->getClientOriginalName()
                ])
            ]);

            AuditLog::create([
                'event_type' => 'submission',
                'timestamp' => time(),
                'user_id' => $user->id,
                'document_id' => $document->id,
                'document_hash' => $fileHash,
                'event_details' => json_encode(['action' => 'Document submitted', 'document_type' => $validated['document_type']])
            ]);

            return redirect('/submissions')->with('success', "Document submitted successfully! Tracking reference: {$trackingRef}");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to submit document: ' . $e->getMessage()]);
        }
    }

    public function submissions()
    {
        $user = Auth::user();
        $documents = $user->documents()->latest()->paginate(10);
        return view('documents.submissions', compact('documents'));
    }

    public function viewSubmission($id)
    {
        $document = Document::findOrFail($id);

        if ($document->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $auditLogs = $document->auditLogs()->orderBy('timestamp', 'desc')->get();
        return view('documents.view-submission', compact('document', 'auditLogs'));
    }
}
