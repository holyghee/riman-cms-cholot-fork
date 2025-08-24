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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('room_name')->unique(); // LiveKit room name
            $table->enum('type', ['mediation', 'consultation', 'team_meeting', 'client_meeting'])->default('mediation');
            $table->enum('status', ['scheduled', 'active', 'completed', 'cancelled'])->default('scheduled');
            $table->foreignId('organizer_id')->constrained('users')->onDelete('cascade');
            $table->json('participants')->nullable(); // Participant information
            $table->json('livekit_config')->nullable(); // LiveKit specific configuration
            $table->datetime('scheduled_at');
            $table->datetime('started_at')->nullable();
            $table->datetime('ended_at')->nullable();
            $table->integer('duration_minutes')->nullable();
            $table->text('agenda')->nullable();
            $table->text('notes')->nullable();
            $table->json('recordings')->nullable(); // Recording information
            $table->boolean('is_recorded')->default(false);
            $table->boolean('is_public')->default(false);
            $table->string('access_token')->nullable(); // For meeting access
            $table->foreignId('mediation_case_id')->nullable()->constrained('mediation_cases')->onDelete('set null');
            $table->foreignId('project_id')->nullable()->constrained('projects')->onDelete('set null');
            $table->timestamps();
            
            $table->index(['status', 'scheduled_at']);
            $table->index('room_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
