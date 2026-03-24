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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->string('event_type'); // submission, review, approval, rejection, etc.
            $table->bigInteger('timestamp'); // Unix timestamp
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('document_id')->nullable()->constrained()->cascadeOnDelete();
            $table->char('document_hash', 64); // SHA-256 hash at time of event
            $table->char('previous_hash', 64)->nullable(); // Hash chaining
            $table->text('event_details')->nullable(); // Additional details
            $table->timestamps();
            $table->index('event_type');
            $table->index('document_id');
            $table->index('user_id');
            $table->index('timestamp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
