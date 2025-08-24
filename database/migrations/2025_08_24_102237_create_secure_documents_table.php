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
        Schema::create('secure_documents', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('file_name');
            $table->string('file_path');
            $table->string('encrypted_path');
            $table->string('mime_type');
            $table->bigInteger('file_size');
            $table->string('file_hash'); // SHA-256 hash for integrity
            $table->boolean('is_encrypted')->default(true);
            $table->enum('classification', ['public', 'internal', 'confidential', 'highly_confidential'])->default('confidential');
            
            // Relationships
            $table->foreignId('uploaded_by')->constrained('users');
            $table->foreignId('mediation_case_id')->nullable()->constrained('mediation_cases')->onDelete('cascade');
            $table->foreignId('project_id')->nullable()->constrained('projects')->onDelete('cascade');
            
            // Access control
            $table->json('allowed_users')->nullable(); // Array of user IDs with access
            $table->json('allowed_roles')->nullable(); // Array of roles with access
            $table->dateTime('expires_at')->nullable(); // Document expiration
            
            // Versioning
            $table->integer('version')->default(1);
            $table->foreignId('parent_document_id')->nullable()->constrained('secure_documents');
            
            // Audit fields
            $table->json('access_log')->nullable(); // Track who accessed when
            $table->integer('download_count')->default(0);
            $table->dateTime('last_accessed_at')->nullable();
            $table->string('last_accessed_by')->nullable();
            
            // Status
            $table->enum('status', ['active', 'archived', 'deleted'])->default('active');
            $table->text('deletion_reason')->nullable();
            $table->dateTime('deleted_at')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index('uuid');
            $table->index('classification');
            $table->index('status');
            $table->index(['mediation_case_id', 'status']);
            $table->index(['project_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secure_documents');
    }
};