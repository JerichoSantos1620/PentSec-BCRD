<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('document_type'); // PDS, SALN, Barangay Resolution, Subpoena
            $table->enum('status', ['submitted', 'under_review', 'approved', 'rejected', 'returned'])->default('submitted');
            $table->string('tracking_reference')->unique(); // Auto-generated
            $table->text('file_path'); // Path to uploaded PDF
            $table->char('file_hash', 64); // SHA-256 hash
            $table->text('metadata')->nullable(); // JSON metadata
            $table->text('reviewer_notes')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users');
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
            $table->index('user_id');
            $table->index('status');
            $table->index('document_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
