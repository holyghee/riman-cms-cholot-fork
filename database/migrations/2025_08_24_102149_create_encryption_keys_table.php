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
        Schema::create('encryption_keys', function (Blueprint $table) {
            $table->id();
            $table->string('file_path')->unique();
            $table->text('encryption_key');
            $table->timestamps();
            
            $table->index('file_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encryption_keys');
    }
};