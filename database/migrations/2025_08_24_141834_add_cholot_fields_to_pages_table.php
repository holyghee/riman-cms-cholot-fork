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
        Schema::table('pages', function (Blueprint $table) {
            // Hero section fields
            $table->text('hero_description')->nullable()->after('hero_subtitle');
            $table->json('hero_background')->nullable()->after('hero_description');
            $table->string('hero_cta_text')->nullable()->after('hero_background');
            $table->string('hero_cta_link')->nullable()->after('hero_cta_text');
            $table->string('hero_secondary_cta_text')->nullable()->after('hero_cta_link');
            $table->string('hero_secondary_cta_link')->nullable()->after('hero_secondary_cta_text');
            
            // Services section
            $table->json('services')->nullable()->after('hero_buttons');
            
            // Design settings
            $table->string('primary_color')->nullable()->after('template');
            $table->boolean('use_custom_colors')->default(false)->after('primary_color');
            $table->string('heading_font')->nullable()->after('use_custom_colors');
            $table->string('body_font')->nullable()->after('heading_font');
            $table->boolean('senior_mode')->default(true)->after('body_font');
            
            // Published flag
            $table->boolean('is_published')->default(true)->after('template');
            
            // Change content_blocks to JSON if it's not already
            $table->json('content_blocks')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn([
                'hero_description',
                'hero_background',
                'hero_cta_text',
                'hero_cta_link',
                'hero_secondary_cta_text',
                'hero_secondary_cta_link',
                'services',
                'primary_color',
                'use_custom_colors',
                'heading_font',
                'body_font',
                'senior_mode',
                'is_published',
            ]);
        });
    }
};
