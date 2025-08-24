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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_number')->unique();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('type', ['rueckbaumanagement', 'altlastensanierung', 'schadstoff_management', 'sicherheitskoordination', 'beratung'])->default('rueckbaumanagement');
            $table->enum('status', ['planning', 'active', 'on_hold', 'completed', 'cancelled'])->default('planning');
            $table->json('client_info')->nullable(); // Client information
            $table->json('location_data')->nullable(); // Project location data
            $table->decimal('budget', 12, 2)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('deadline')->nullable();
            $table->foreignId('project_manager_id')->nullable()->constrained('users')->onDelete('set null');
            $table->json('team_members')->nullable(); // Team member IDs
            $table->json('documents')->nullable(); // Project documents
            $table->text('notes')->nullable();
            $table->integer('progress_percentage')->default(0);
            $table->timestamps();
            
            $table->index(['status', 'project_manager_id']);
            $table->index('project_number');
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
