@extends('layouts.app')
@section('title', 'Verification Portal - E-Patunay')

@section('content')
<div class="min-h-screen bg-[#060e1a] bg-mesh">
    {{-- Top Bar --}}
    <header class="border-b border-[#1a3a5c]/50 backdrop-blur-xl bg-[#0a1628]/80">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between relative">
            {{-- Sign Out --}}
            <a href="{{ route('agency-login') }}" id="signOutBtn"
                class="text-sm text-red-400/80 hover:text-red-300 flex items-center gap-2 px-4 py-2.5 rounded-xl border border-red-500/20 hover:bg-red-500/10 hover:border-red-500/40 transition-all duration-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Sign Out
            </a>
            {{-- Centered Logo --}}
            <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col items-center">
                <img src="{{ asset('images/logo.png') }}" alt="e-Patunay" class="h-9 drop-shadow-[0_0_15px_rgba(6,182,212,0.15)]">
                <span class="hidden sm:block text-gray-500 text-[10px] tracking-[0.15em] uppercase font-medium mt-0.5">Document Verification Portal</span>
            </div>
            {{-- Agency Badge --}}
            <div class="glass-card rounded-xl px-4 py-2.5 flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-amber-500/20 to-orange-500/10 flex items-center justify-center border border-amber-500/20">
                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <div>
                    <p class="text-white text-xs font-semibold">Commission on Audit</p>
                    <p class="text-amber-400 text-[10px] font-semibold tracking-wider uppercase">Read-Only Access</p>
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-6 pt-10 pb-8">
        {{-- Main Content Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            {{-- Left: Verify Document --}}
            <div class="glass-card rounded-xl overflow-hidden animate-fade-in-up">
                <div class="px-6 py-5 border-b border-[#1a3a5c]/50">
                    <h2 class="text-white font-semibold flex items-center gap-2.5">
                        <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Verify Document Authenticity
                    </h2>
                    <p class="text-gray-600 text-xs mt-1">Enter a Document ID or upload a signed PDF to verify its cryptographic integrity</p>
                </div>
                <div class="p-6 space-y-5">
                    {{-- Document ID Input --}}
                    <div>
                        <label class="block text-xs text-gray-500 mb-2 font-semibold tracking-wider uppercase">Document ID</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                </svg>
                            </span>
                            <input type="text" id="docIdInput"
                                class="input-dark w-full pl-11 pr-4 py-3.5 rounded-xl text-white placeholder-gray-600 focus:outline-none text-sm font-mono"
                                placeholder="PDS-00001">
                        </div>
                    </div>

                    {{-- Divider --}}
                    <div class="flex items-center gap-3">
                        <div class="flex-1 h-px bg-gradient-to-r from-transparent via-[#1a3a5c] to-transparent"></div>
                        <span class="text-gray-600 text-[10px] font-semibold tracking-wider uppercase">or upload file</span>
                        <div class="flex-1 h-px bg-gradient-to-r from-transparent via-[#1a3a5c] to-transparent"></div>
                    </div>

                    {{-- File Upload --}}
                    <div id="dropZone"
                        class="border-2 border-dashed border-[#1a3a5c]/60 rounded-xl p-6 text-center cursor-pointer hover:border-cyan-500/30 hover:bg-cyan-500/[0.02] transition-all duration-300">
                        <div id="dropZoneContent">
                            <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-[#1a3a5c]/30 flex items-center justify-center">
                                <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                </svg>
                            </div>
                            <p class="text-gray-400 text-sm font-medium">Drag and drop a signed PDF here</p>
                            <p class="text-gray-600 text-xs mt-1">or click to browse files</p>
                        </div>
                        <input type="file" id="fileInput" accept=".pdf" class="hidden">
                    </div>

                    {{-- PDF extraction status --}}
                    <div id="extractionStatus" class="hidden"></div>

                    {{-- Verify Button --}}
                    <button id="verifyBtn"
                        class="btn-primary w-full py-3.5 text-white font-bold rounded-xl text-sm tracking-wide flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        VERIFY DOCUMENT
                    </button>
                </div>
            </div>

            {{-- Right: Verification Result --}}
            <div class="glass-card rounded-xl overflow-hidden animate-fade-in-up delay-200">
                <div class="px-6 py-5 border-b border-[#1a3a5c]/50">
                    <h2 class="text-white font-semibold flex items-center gap-2.5">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Verification Result
                    </h2>
                </div>

                {{-- Empty state --}}
                <div id="resultEmpty" class="p-12 text-center">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-[#1a3a5c]/30 flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <p class="text-gray-500 font-medium">No verification result yet</p>
                    <p class="text-gray-600 text-sm mt-1">Enter a Document ID or upload a file to verify</p>
                </div>

                {{-- Result content (hidden by default) --}}
                <div id="resultContent" class="hidden">
                    {{-- Status Banner --}}
                    <div id="resultBanner" class="mx-6 mt-6 rounded-xl p-4 flex items-center gap-3">
                        <div id="resultIcon"></div>
                        <div>
                            <p id="resultTitle" class="font-bold text-sm"></p>
                            <p id="resultSubtitle" class="text-xs mt-0.5 opacity-80"></p>
                        </div>
                    </div>

                    {{-- Document Information Section --}}
                    <div class="px-6 pt-6 pb-2">
                        <h3 class="text-[10px] font-semibold text-cyan-400 tracking-wider uppercase mb-3 flex items-center gap-2">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Document Information
                        </h3>
                        <div class="grid grid-cols-1 gap-0">
                            <div class="flex items-center justify-between py-2.5 border-b border-[#1a3a5c]/30">
                                <span class="text-gray-500 text-xs font-semibold tracking-wider uppercase">Document ID</span>
                                <span id="resultDocId" class="text-cyan-400 text-sm font-mono font-semibold"></span>
                            </div>
                            <div class="flex items-center justify-between py-2.5 border-b border-[#1a3a5c]/30">
                                <span class="text-gray-500 text-xs font-semibold tracking-wider uppercase">Document Type</span>
                                <span class="text-white text-sm font-medium">Personal Data Sheet (PDS)</span>
                            </div>
                            <div class="flex items-center justify-between py-2.5 border-b border-[#1a3a5c]/30">
                                <span class="text-gray-500 text-xs font-semibold tracking-wider uppercase">Issuing Authority</span>
                                <span class="text-white text-sm font-medium">BCRD &middot; Quezon City</span>
                            </div>
                        </div>
                    </div>

                    {{-- Cryptographic Verification Section --}}
                    <div class="px-6 pt-4 pb-6">
                        <h3 class="text-[10px] font-semibold text-cyan-400 tracking-wider uppercase mb-3 flex items-center gap-2">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Cryptographic Verification
                        </h3>
                        <div class="grid grid-cols-1 gap-0">
                            <div class="flex items-start justify-between py-2.5 border-b border-[#1a3a5c]/30">
                                <span class="text-gray-500 text-xs font-semibold tracking-wider uppercase">Signing Officer</span>
                                <div class="text-right">
                                    <span id="resultOfficer" class="text-white text-sm font-medium block"></span>
                                    <span id="resultEmployment" class="text-xs mt-0.5 block"></span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between py-2.5 border-b border-[#1a3a5c]/30">
                                <span class="text-gray-500 text-xs font-semibold tracking-wider uppercase">Signing Timestamp</span>
                                <span id="resultTimestamp" class="text-white text-sm font-medium"></span>
                            </div>
                            <div class="flex items-center justify-between py-2.5 border-b border-[#1a3a5c]/30">
                                <span class="text-gray-500 text-xs font-semibold tracking-wider uppercase">Certificate Authority</span>
                                <span id="resultCA" class="text-white text-sm font-medium"></span>
                            </div>
                            <div class="flex items-center justify-between py-2.5 border-b border-[#1a3a5c]/30">
                                <span class="text-gray-500 text-xs font-semibold tracking-wider uppercase">Certificate Status</span>
                                <span id="resultCertStatus"></span>
                            </div>
                            <div class="flex items-start justify-between py-2.5 border-b border-[#1a3a5c]/30">
                                <span class="text-gray-500 text-xs font-semibold tracking-wider uppercase">Document Hash</span>
                                <span id="resultHash" class="text-cyan-400 text-xs font-mono text-right max-w-[220px] break-all"></span>
                            </div>
                            <div class="flex items-start justify-between py-2.5">
                                <span class="text-gray-500 text-xs font-semibold tracking-wider uppercase">Audit Ledger Entry</span>
                                <span id="resultMerkle" class="text-cyan-400 text-xs font-mono text-right max-w-[220px] break-all"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Verification History Table --}}
        <div class="glass-card rounded-xl overflow-hidden animate-fade-in-up delay-400">
            <div class="px-6 py-5 border-b border-[#1a3a5c]/50 flex items-center justify-between">
                <div>
                    <h2 class="text-white font-semibold flex items-center gap-2.5">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Verification Request History (This Session)
                    </h2>
                    <p class="text-gray-600 text-xs mt-0.5">All verification queries performed during this session</p>
                </div>
                <div id="historyCount" class="hidden flex items-center gap-2 px-3 py-1.5 rounded-full bg-cyan-500/10 border border-cyan-500/20">
                    <span class="text-cyan-400 text-xs font-semibold"><span id="historyCountNum">0</span> queries</span>
                </div>
            </div>

            {{-- Empty state --}}
            <div id="historyEmpty" class="p-12 text-center">
                <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-[#1a3a5c]/30 flex items-center justify-center">
                    <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p class="text-gray-500 font-medium">No verification history yet</p>
                <p class="text-gray-600 text-sm mt-1">Your verification queries will appear here</p>
            </div>

            {{-- History table (hidden by default) --}}
            <div id="historyTable" class="hidden">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-[#1a3a5c]/50 text-left">
                            <th class="px-6 py-3.5 text-[10px] font-semibold text-gray-500 uppercase tracking-wider">Document ID</th>
                            <th class="px-6 py-3.5 text-[10px] font-semibold text-gray-500 uppercase tracking-wider">Agency</th>
                            <th class="px-6 py-3.5 text-[10px] font-semibold text-gray-500 uppercase tracking-wider">Verified At</th>
                            <th class="px-6 py-3.5 text-[10px] font-semibold text-gray-500 uppercase tracking-wider">Result</th>
                        </tr>
                    </thead>
                    <tbody id="historyBody" class="divide-y divide-[#1a3a5c]/30">
                    </tbody>
                </table>

                {{-- Audit trail notice --}}
                <div class="px-6 py-4 border-t border-[#1a3a5c]/50">
                    <p class="text-gray-600 text-[11px] flex items-center gap-1.5">
                        <svg class="w-3 h-3 text-amber-500/60 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        All verification requests are logged in the system's audit trail
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- PDF.js from CDN --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/4.4.168/pdf.min.mjs" type="module"></script>
<script type="module">
import * as pdfjsLib from 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/4.4.168/pdf.min.mjs';
pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/4.4.168/pdf.worker.min.mjs';

var docIdInput = document.getElementById('docIdInput');
var fileInput = document.getElementById('fileInput');
var dropZone = document.getElementById('dropZone');
var dropZoneContent = document.getElementById('dropZoneContent');
var extractionStatus = document.getElementById('extractionStatus');
var verifyBtn = document.getElementById('verifyBtn');
var resultEmpty = document.getElementById('resultEmpty');
var resultContent = document.getElementById('resultContent');
var resultBanner = document.getElementById('resultBanner');
var resultIcon = document.getElementById('resultIcon');
var resultTitle = document.getElementById('resultTitle');
var resultSubtitle = document.getElementById('resultSubtitle');
var resultDocId = document.getElementById('resultDocId');
var resultOfficer = document.getElementById('resultOfficer');
var resultEmployment = document.getElementById('resultEmployment');
var resultTimestamp = document.getElementById('resultTimestamp');
var resultCA = document.getElementById('resultCA');
var resultCertStatus = document.getElementById('resultCertStatus');
var resultHash = document.getElementById('resultHash');
var resultMerkle = document.getElementById('resultMerkle');
var historyEmpty = document.getElementById('historyEmpty');
var historyTable = document.getElementById('historyTable');
var historyBody = document.getElementById('historyBody');
var historyCount = document.getElementById('historyCount');
var historyCountNum = document.getElementById('historyCountNum');

var uploadedFile = null;
var extractedDocId = null;
var computedFileHash = null;
var history = [];

// Mock document database (PDS-00001 through PDS-00005)
var documents = {
    'PDS-00001': {
        valid: true,
        officer: 'Maria Elena Santos',
        employment: 'Active \u2014 District 5 Office',
        signingTimestamp: '2024-03-15T09:42:00Z',
        ca: 'e-Patunay Root CA v2',
        merkle: 'blk#4821 \u2192 0x7f3a...c9d1 (anchor: 2024-03-15T09:42:00Z)'
    },
    'PDS-00002': {
        valid: true,
        officer: 'Juan Carlos Reyes',
        employment: 'Active \u2014 District 5 Office',
        signingTimestamp: '2024-03-15T10:15:00Z',
        ca: 'e-Patunay Root CA v2',
        merkle: 'blk#4822 \u2192 0x8e4d...f5a7 (anchor: 2024-03-15T10:15:00Z)'
    },
    'PDS-00003': {
        valid: true,
        officer: 'Ana Patricia Villanueva',
        employment: 'Active \u2014 District 5 Office',
        signingTimestamp: '2024-06-22T14:33:00Z',
        ca: 'e-Patunay Root CA v2',
        merkle: 'blk#5103 \u2192 0x9f5e...a7b1 (anchor: 2024-06-22T14:33:00Z)'
    },
    'PDS-00004': {
        valid: true,
        officer: 'Roberto Dela Cruz',
        employment: 'Active \u2014 District 5 Office',
        signingTimestamp: '2024-08-10T11:20:00Z',
        ca: 'e-Patunay Root CA v2',
        merkle: 'blk#5287 \u2192 0xb3c1...e8f2 (anchor: 2024-08-10T11:20:00Z)'
    },
    'PDS-00005': {
        valid: false,
        officer: 'Ricardo Mendoza',
        employment: 'Inactive \u2014 Separated',
        signingTimestamp: '2024-01-10T08:20:00Z',
        ca: 'e-Patunay Root CA v2',
        merkle: 'blk#4650 \u2192 0x0a6f...b8c2 (anchor: 2024-01-10T08:20:00Z) [REVOKED]'
    }
};

// SHA-256 hash of file bytes using Web Crypto API
async function computeSHA256(arrayBuffer) {
    var hashBuffer = await crypto.subtle.digest('SHA-256', arrayBuffer);
    var hashArray = Array.from(new Uint8Array(hashBuffer));
    return hashArray.map(function (b) { return b.toString(16).padStart(2, '0'); }).join('');
}

// Extract text from all pages of a PDF using PDF.js
async function extractTextFromPDF(arrayBuffer) {
    var pdf = await pdfjsLib.getDocument({ data: arrayBuffer }).promise;
    var allText = '';
    for (var i = 1; i <= pdf.numPages; i++) {
        var page = await pdf.getPage(i);
        var content = await page.getTextContent();
        var pageText = content.items.map(function (item) { return item.str; }).join(' ');
        allText += pageText + '\n';
    }
    return allText;
}

// Extract Document ID from PDF text (format: PDS-XXXXX or PDS-XXXX)
function extractDocIdFromText(text) {
    var match = text.match(/PDS-\d{4,5}/);
    return match ? match[0] : null;
}

// Normalize Document ID to 5-digit format
function normalizeDocId(docId) {
    var match = docId.match(/^PDS-(\d+)$/);
    if (!match) return docId;
    return 'PDS-' + match[1].padStart(5, '0');
}

// Show extraction status message
function showExtractionStatus(type, message) {
    extractionStatus.classList.remove('hidden');
    if (type === 'success') {
        extractionStatus.innerHTML =
            '<div class="flex items-center gap-2 p-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20 animate-fade-in">' +
                '<svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">' +
                    '<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />' +
                '</svg>' +
                '<span class="text-emerald-400 text-xs font-medium">' + message + '</span>' +
            '</div>';
    } else if (type === 'error') {
        extractionStatus.innerHTML =
            '<div class="flex items-start gap-2 p-3 rounded-xl bg-red-500/10 border border-red-500/20 animate-fade-in">' +
                '<svg class="w-4 h-4 text-red-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">' +
                    '<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />' +
                '</svg>' +
                '<span class="text-red-400 text-xs font-medium">' + message + '</span>' +
            '</div>';
    } else if (type === 'loading') {
        extractionStatus.innerHTML =
            '<div class="flex items-center gap-2 p-3 rounded-xl bg-cyan-500/10 border border-cyan-500/20 animate-fade-in">' +
                '<svg class="w-4 h-4 text-cyan-400 animate-spin shrink-0" fill="none" viewBox="0 0 24 24">' +
                    '<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>' +
                    '<path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>' +
                '</svg>' +
                '<span class="text-cyan-400 text-xs font-medium">' + message + '</span>' +
            '</div>';
    }
}

function hideExtractionStatus() {
    extractionStatus.classList.add('hidden');
    extractionStatus.innerHTML = '';
}

var defaultDropZoneHTML =
    '<div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-[#1a3a5c]/30 flex items-center justify-center">' +
        '<svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">' +
            '<path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />' +
        '</svg>' +
    '</div>' +
    '<p class="text-gray-400 text-sm font-medium">Drag and drop a signed PDF here</p>' +
    '<p class="text-gray-600 text-xs mt-1">or click to browse files</p>';

var verifyBtnDefaultHTML =
    '<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">' +
        '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />' +
    '</svg>' +
    'VERIFY DOCUMENT';

// Sign out — clear session state and redirect
document.getElementById('signOutBtn').addEventListener('click', function (e) {
    e.preventDefault();
    history = [];
    uploadedFile = null;
    extractedDocId = null;
    computedFileHash = null;
    window.location.href = this.href;
});

// File upload handling
dropZone.addEventListener('click', function () {
    fileInput.click();
});

dropZone.addEventListener('dragover', function (e) {
    e.preventDefault();
    dropZone.classList.add('border-cyan-500/40', 'bg-cyan-500/[0.04]');
});

dropZone.addEventListener('dragleave', function () {
    dropZone.classList.remove('border-cyan-500/40', 'bg-cyan-500/[0.04]');
});

dropZone.addEventListener('drop', function (e) {
    e.preventDefault();
    dropZone.classList.remove('border-cyan-500/40', 'bg-cyan-500/[0.04]');
    var files = e.dataTransfer.files;
    if (files.length && files[0].type === 'application/pdf') {
        handleFile(files[0]);
    }
});

fileInput.addEventListener('change', function () {
    if (fileInput.files.length) {
        handleFile(fileInput.files[0]);
    }
});

async function handleFile(file) {
    uploadedFile = file;
    extractedDocId = null;
    computedFileHash = null;

    // Show file info in drop zone
    dropZoneContent.innerHTML =
        '<div class="flex items-center justify-center gap-3">' +
            '<div class="w-10 h-10 rounded-xl bg-cyan-500/15 flex items-center justify-center">' +
                '<svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">' +
                    '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />' +
                '</svg>' +
            '</div>' +
            '<div class="text-left">' +
                '<p class="text-white text-sm font-medium">' + file.name + '</p>' +
                '<p class="text-gray-500 text-xs">' + (file.size / 1024).toFixed(1) + ' KB</p>' +
            '</div>' +
        '</div>';

    // Parse the PDF
    showExtractionStatus('loading', 'Reading PDF and extracting Document ID...');

    try {
        var arrayBuffer = await file.arrayBuffer();

        // Compute SHA-256 hash of the raw file bytes
        computedFileHash = await computeSHA256(arrayBuffer);

        // Extract text from PDF
        var text = await extractTextFromPDF(arrayBuffer);

        // Extract Document ID
        var rawDocId = extractDocIdFromText(text);

        if (rawDocId) {
            extractedDocId = normalizeDocId(rawDocId);
            docIdInput.value = extractedDocId;
            showExtractionStatus('success', 'Document ID extracted: ' + extractedDocId);
        } else {
            showExtractionStatus('error', 'Unable to extract Document ID from the uploaded file. Please ensure you are uploading a valid e-Patunay PDS document.');
        }
    } catch (err) {
        showExtractionStatus('error', 'Unable to extract Document ID from the uploaded file. Please ensure you are uploading a valid e-Patunay PDS document.');
    }
}

// Format ISO timestamp for display
function formatTimestamp(iso) {
    var d = new Date(iso);
    return d.toLocaleString('en-US', { month: 'short', day: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true });
}

// Verify button
verifyBtn.addEventListener('click', function () {
    var docId = docIdInput.value.trim().toUpperCase();

    // Normalize the input to 5-digit format
    if (docId) {
        docId = normalizeDocId(docId);
    }

    if (!docId) return;

    // Show loading state
    verifyBtn.disabled = true;
    verifyBtn.innerHTML =
        '<svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">' +
            '<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>' +
            '<path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>' +
        '</svg>' +
        'VERIFYING...';

    setTimeout(function () {
        var doc = documents[docId];
        var now = new Date();
        var timestamp = now.toLocaleString('en-US', { month: 'short', day: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true });

        // The file hash to display: use computed hash from uploaded file, or a dash for manual ID entry
        var displayHash = computedFileHash || '\u2014';

        // Show result
        resultEmpty.classList.add('hidden');
        resultContent.classList.remove('hidden');
        resultContent.classList.add('animate-fade-in');

        // Set Document ID in result panel
        resultDocId.textContent = docId;

        if (doc && doc.valid) {
            // VALID
            resultBanner.className = 'mx-6 mt-6 rounded-xl p-4 flex items-center gap-3 bg-emerald-500/10 border border-emerald-500/20';
            resultIcon.innerHTML =
                '<div class="w-10 h-10 rounded-xl bg-emerald-500/20 flex items-center justify-center">' +
                    '<svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">' +
                        '<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />' +
                    '</svg>' +
                '</div>';
            resultTitle.className = 'font-bold text-sm text-emerald-400';
            resultTitle.textContent = 'DOCUMENT VERIFIED';
            resultSubtitle.className = 'text-xs mt-0.5 text-white';
            resultSubtitle.textContent = 'Digital signature is VALID. File integrity intact.';

            resultOfficer.textContent = doc.officer;
            resultEmployment.className = 'text-emerald-400 text-xs mt-0.5 block';
            resultEmployment.textContent = doc.employment;
            resultTimestamp.textContent = formatTimestamp(doc.signingTimestamp);
            resultCA.textContent = doc.ca;
            resultCertStatus.innerHTML = '<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[11px] font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20"><span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>Valid</span>';
            resultHash.textContent = displayHash;
            resultMerkle.textContent = doc.merkle;
        } else if (doc && !doc.valid) {
            // REVOKED
            resultBanner.className = 'mx-6 mt-6 rounded-xl p-4 flex items-center gap-3 bg-red-500/10 border border-red-500/20';
            resultIcon.innerHTML =
                '<div class="w-10 h-10 rounded-xl bg-red-500/20 flex items-center justify-center">' +
                    '<svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">' +
                        '<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />' +
                    '</svg>' +
                '</div>';
            resultTitle.className = 'font-bold text-sm text-red-400';
            resultTitle.textContent = 'CERTIFICATE REVOKED';
            resultSubtitle.className = 'text-xs mt-0.5 text-white';
            resultSubtitle.textContent = 'This document has been revoked. Contact BCRD for more information.';

            resultOfficer.textContent = doc.officer;
            resultEmployment.className = 'text-red-400 text-xs mt-0.5 block';
            resultEmployment.textContent = doc.employment;
            resultTimestamp.textContent = formatTimestamp(doc.signingTimestamp);
            resultCA.textContent = doc.ca;
            resultCertStatus.innerHTML = '<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[11px] font-semibold bg-red-500/10 text-red-400 border border-red-500/20"><span class="w-1.5 h-1.5 rounded-full bg-red-400"></span>Revoked</span>';
            resultHash.textContent = displayHash;
            resultMerkle.textContent = doc.merkle;
        } else {
            // NOT FOUND
            resultBanner.className = 'mx-6 mt-6 rounded-xl p-4 flex items-center gap-3 bg-red-500/10 border border-red-500/20';
            resultIcon.innerHTML =
                '<div class="w-10 h-10 rounded-xl bg-red-500/20 flex items-center justify-center">' +
                    '<svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">' +
                        '<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />' +
                    '</svg>' +
                '</div>';
            resultTitle.className = 'font-bold text-sm text-red-400';
            resultTitle.textContent = 'DOCUMENT NOT FOUND';
            resultSubtitle.className = 'text-xs mt-0.5 text-white';
            resultSubtitle.textContent = 'Document ID not found in the system. This document may be unregistered or tampered.';

            resultOfficer.textContent = '\u2014';
            resultEmployment.className = 'text-gray-600 text-xs mt-0.5 block';
            resultEmployment.textContent = '';
            resultTimestamp.textContent = '\u2014';
            resultCA.textContent = '\u2014';
            resultCertStatus.innerHTML = '<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[11px] font-semibold bg-gray-500/10 text-gray-500 border border-gray-500/20">N/A</span>';
            resultHash.textContent = displayHash;
            resultMerkle.textContent = '\u2014';
        }

        // Add to history
        var status = doc ? (doc.valid ? 'valid' : 'revoked') : 'not-found';
        history.unshift({ docId: docId, timestamp: timestamp, status: status });
        renderHistory();

        // Reset button
        verifyBtn.disabled = false;
        verifyBtn.innerHTML = verifyBtnDefaultHTML;

        // Reset file state
        uploadedFile = null;
        extractedDocId = null;
        computedFileHash = null;
        fileInput.value = '';
        dropZoneContent.innerHTML = defaultDropZoneHTML;
        hideExtractionStatus();
    }, 1200);
});

function renderHistory() {
    if (history.length === 0) return;

    historyEmpty.classList.add('hidden');
    historyTable.classList.remove('hidden');
    historyCount.classList.remove('hidden');
    historyCount.classList.add('flex');
    historyCountNum.textContent = history.length;

    historyBody.innerHTML = '';
    history.forEach(function (entry) {
        var statusBadge;
        var rowClass = 'table-row-hover';
        if (entry.status === 'valid') {
            statusBadge = '<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[11px] font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20"><span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>Valid</span>';
        } else if (entry.status === 'revoked') {
            statusBadge = '<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[11px] font-semibold bg-red-500/10 text-red-400 border border-red-500/20"><span class="w-1.5 h-1.5 rounded-full bg-red-400"></span>Revoked</span>';
            rowClass = 'table-row-hover bg-red-500/[0.03]';
        } else {
            statusBadge = '<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[11px] font-semibold bg-gray-500/10 text-gray-400 border border-gray-500/20"><span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>Not Found</span>';
        }

        var tr = document.createElement('tr');
        tr.className = rowClass;
        tr.innerHTML =
            '<td class="px-6 py-4"><span class="text-cyan-400 font-mono text-xs font-semibold">' + entry.docId + '</span></td>' +
            '<td class="px-6 py-4 text-gray-400 text-xs">Commission on Audit</td>' +
            '<td class="px-6 py-4 text-gray-500 text-xs">' + entry.timestamp + '</td>' +
            '<td class="px-6 py-4">' + statusBadge + '</td>';

        historyBody.appendChild(tr);
    });
}
</script>
@endsection
