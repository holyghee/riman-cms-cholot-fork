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
        Schema::create('mediation_cases', function (Blueprint $table) {
            $table->id();
            $table->string('case_number')->unique();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('status', ['open', 'in_progress', 'resolved', 'closed', 'cancelled'])->default('open');
            $table->enum('type', ['baumediation', 'vertragsmediation', 'nachbarschaftsmediation', 'praeventive_mediation', 'online_mediation'])->default('baumediation');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            $table->foreignId('mediator_id')->nullable()->constrained('users')->onDelete('set null');
            $table->json('participants')->nullable(); // Store participant information
            $table->json('documents')->nullable(); // Store document references
            $table->text('notes')->nullable();
            $table->decimal('estimated_value', 12, 2)->nullable();
            $table->date('deadline')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            
            $table->index(['status', 'mediator_id']);
            $table->index('case_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mediation_cases');
    }
};
