<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'user_id',
        'document_type',
        'status',
        'tracking_reference',
        'file_path',
        'file_hash',
        'metadata',
        'reviewer_notes',
        'reviewed_by',
        'reviewed_at'
    ];

    protected $casts = [
        'metadata' => 'json',
        'reviewed_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }
}
