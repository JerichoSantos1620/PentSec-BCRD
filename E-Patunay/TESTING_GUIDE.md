# E-Patunay 30% Implementation - Testing Guide

## Quick Start

### 1. Database Setup
```bash
cd C:\Claude\E-Patunay
php artisan migrate --force
```

### 2. Create Test Accounts
The system comes with basic auth. You can use existing accounts or create new ones through `/register`.

**Test User (Regular)**:
- Email: `user@example.com`
- Role: Document submitter

**Test Admin**:
- Email: `admin@example.com`
- Role: Document reviewer (has `is_admin=1`)

---

## Feature Demonstrations

### 📄 Feature 1: Document Submission

**For Regular Users**:

1. Login with user account
2. Navigate to **Submit Document** (or go to `/submit-document`)
3. Fill out the form:
   - Select Document Type (PDS, SALN, Barangay Resolution, Subpoena)
   - Enter Official Name
   - Enter Position (e.g., "Barangay Captain")
   - Select Submission Date
   - Upload a PDF file (max 50MB)
4. Click "Submit Document"
5. System generates:
   - Unique tracking reference (DOC-2026-000001)
   - SHA-256 hash of the PDF
   - Audit log entry recording the submission

**What to Notice**:
- ✅ Tracking reference is displayed
- ✅ PDF validation (try uploading a non-PDF file to see error)
- ✅ File size validation (try a file >50MB)
- ✅ Metadata storage in JSON format

---

### 📊 Feature 2: Submission Status Tracking

**For Regular Users**:

1. After submitting a document, user is redirected to `/submissions`
2. View the **My Submissions** tracker showing:
   - Tracking Reference (clickable)
   - Document Type
   - Current Status (with color coding)
   - Submission Date
3. Click on a tracking reference to view details:
   - Full document information
   - Workflow History timeline
   - Reviewer notes (if any)
   - Document hash

**What to Notice**:
- ✅ Status badge shows: "Submitted" (blue)
- ✅ Workflow History shows submission event with timestamp
- ✅ Document hash displayed for verification
- ✅ Pagination for multiple submissions

---

### ⚙️ Feature 3: Admin Review Queue

**For Admin Users**:

1. Login with admin account
2. Navigate to **Admin > Review Queue** (or go to `/admin/review-queue`)
3. View table of pending documents showing:
   - Tracking Reference
   - Document Type
   - Submitter Name
   - Status (Submitted/Returned)
   - Submission Date
4. Click "Review" button on any document
5. A modal appears with three action options:
   - **Approve**: Document moves to "Approved" status
   - **Return for Changes**: Document status becomes "Returned" with notes
   - **Reject**: Document status becomes "Rejected" with notes
6. Optional: Add reviewer notes explaining the decision
7. Click "Submit Review"

**What to Observe**:
- ✅ Only admins can see pending documents
- ✅ Document status updates immediately after review
- ✅ Reviewer name and date recorded in audit logs
- ✅ The document moves to processed queue
- ✅ If returned/rejected, user sees reviewer notes in submission details

---

### 📈 Feature 4: Analytics Dashboard

**For Admin Users**:

1. Login with admin account
2. Navigate to **Admin > Analytics** (or go to `/admin/analytics`)
3. View four KPI cards:
   - **Total Submissions**: Count of all submitted documents
   - **Approval Rate**: Percentage of approved documents
   - **Avg Processing**: Average hours from submission to approval
   - **Pending Review**: Documents awaiting action

4. Scroll down to see:
   - **Submissions by Document Type**: Bar chart showing distribution
   - **Status Distribution**: Count of documents in each status
   - **Monthly Submission Trend**: Historical trend line

**What to Notice**:
- ✅ KPIs update in real-time as documents are submitted/reviewed
- ✅ Approval rate shows as percentage
- ✅ Charts update based on current data
- ✅ Color-coded status distribution with counts

---

## Test Scenarios

### Scenario 1: Complete Document Workflow
1. ✅ User submits PDS document
2. ✅ Document appears in submissions list with "Submitted" status
3. ✅ Admin reviews and approves the document
4. ✅ User sees status changed to "Approved"
5. ✅ Admin analytics show increased approval metrics
6. ✅ Audit log shows all events with timestamps and hashes

### Scenario 2: Document Return & Resubmission
1. ✅ User submits SALN document
2. ✅ Admin reviews and returns with notes (e.g., "Missing signature")
3. ✅ User sees status as "Returned" with reviewer notes
4. ✅ User can resubmit corrected document
5. ✅ System generates new tracking for resubmission
6. ✅ Admin sees resubmitted document in review queue

### Scenario 3: Document Rejection
1. ✅ User submits Barangay Resolution
2. ✅ Admin reviews and rejects with reason
3. ✅ User sees "Rejected" status with notes
4. ✅ No further actions permitted on rejected document
5. ✅ Rejection recorded in audit log

---

## Database Verification

### Check Document Records
```sql
SELECT * FROM documents;
-- Shows: ID, user_id, document_type, status, tracking_reference, file_hash
```

### Check Audit Logs
```sql
SELECT * FROM audit_logs ORDER BY timestamp DESC;
-- Shows: event_type, timestamp, user_id, document_id, document_hash
```

### Verify File Storage
```
Check: storage/app/documents/2026/03/
-- PDF files stored in organized directory structure
```

---

## File Upload Testing

### Valid Test Cases
✅ Valid PDF (any size ≤ 50MB)
✅ Different document types in same submission
✅ Multiple submissions by same user

### Invalid Test Cases (Should Error)
❌ Non-PDF files (try .docx, .txt, .png)
❌ File size > 50MB
❌ Missing required form fields
❌ Invalid document type

---

## Performance Notes

- Pagination: 10 items per page for submissions list, 15 for review queue
- Hash calculation: Immediate (SHA-256 on upload)
- Audit logs: Automatic, no manual entry needed
- Analytics: Real-time calculations from database

---

## Known Limitations (30% Implementation)

- ❌ No certificate signing (PKI module not implemented)
- ❌ No public verification portal (Module 5 not implemented)
- ❌ No cloud storage integration (Module 7 not implemented)
- ❌ No Merkle tree consolidation (Module 3 advanced features)
- ❌ No MFA step-up authentication for approvals
- ❌ No real-time tamper detection on hash mismatch

---

## Troubleshooting

**Problem**: Migration fails
**Solution**: Ensure database exists and credentials in `.env` are correct

**Problem**: File upload fails
**Solution**: Check `storage/app` is writable and `php.ini` upload limit is > 50MB

**Problem**: Hash not calculating
**Solution**: Check PHP hash() function is available (standard in PHP 7.4+)

**Problem**: Admin can't see review queue
**Solution**: Verify user has `is_admin=1` in database

---

## Code Review Highlights

### SHA-256 Hashing Implementation
```php
$fileHash = hash_file('sha256', $file->getRealPath());
// Stored in documents.file_hash (CHAR 64)
```

### Audit Log Creation
```php
AuditLog::create([
    'event_type' => 'submission',
    'timestamp' => time(),
    'user_id' => $user->id,
    'document_id' => $document->id,
    'document_hash' => $fileHash,
    'event_details' => json_encode([...])
]);
```

### Document State Transitions
```php
// Status enum values: submitted, under_review, approved, rejected, returned
$document->update(['status' => 'approved']);
```

---

## Presentation Points

When presenting to your professor, highlight:

1. **Complete Workflow**: Show submission → review → approval process
2. **Data Integrity**: Point out SHA-256 hash storage and verification
3. **Audit Trail**: Show chronological audit logs with all events
4. **Analytics Dashboard**: Demonstrate real-time KPI calculations
5. **User-Friendly UI**: Show clean, intuitive interface for document tracking
6. **Professional Implementation**: Reference FRS requirements met in documentation

---

## Files Modified/Created

**New Models**:
- `app/Models/Document.php`
- `app/Models/AuditLog.php`

**New Controllers**:
- `app/Http/Controllers/DocumentController.php`
- Modified `app/Http/Controllers/AdminController.php`

**New Views**:
- `resources/views/documents/submit.blade.php`
- `resources/views/documents/submissions.blade.php`
- `resources/views/documents/view-submission.blade.php`
- `resources/views/admin/review-queue.blade.php`
- `resources/views/admin/analytics.blade.php`

**Database Migrations**:
- `2026_03_24_141016_create_documents_table.php`
- `2026_03_24_141017_create_audit_logs_table.php`

**Updated Routes**:
- `routes/web.php` - Added 7 new routes

---

**Ready to demonstrate! Good luck with your presentation!** 🎓
