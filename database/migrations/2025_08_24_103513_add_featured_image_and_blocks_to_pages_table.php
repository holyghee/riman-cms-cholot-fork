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
            // Featured image
            $table->string('featured_image')->nullable()->after('excerpt');
            $table->string('featured_image_alt')->nullable()->after('featured_image');
            
            // Hero section
            $table->string('hero_title')->nullable()->after('featured_image_alt');
            $table->text('hero_subtitle')->nullable()->after('hero_title');
            $table->string('hero_image')->nullable()->after('hero_subtitle');
            $table->json('hero_buttons')->nullable()->after('hero_image');
            
            // Page blocks (for page builder)
            $table->json('blocks')->nullable()->after('content_blocks');
            
            // Gallery
            $table->json('gallery_images')->nullable()->after('blocks');
            
            // Additional SEO
            $table->string('og_image')->nullable()->after('meta_keywords');
            
            // Layout options
            $table->string('layout')->default('default')->after('template');
            $table->boolean('show_hero')->default(true)->after('layout');
            $table->boolean('show_sidebar')->default(false)->after('show_hero');
            $table->string('sidebar_position')->default('right')->after('show_sidebar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn([
                'featured_image',
                'featured_image_alt',
                'hero_title',
                'hero_subtitle',
                'hero_image',
                'hero_buttons',
                'blocks',
                'gallery_images',
                'og_image',
                'layout',
                'show_hero',
                'show_sidebar',
                'sidebar_position',
            ]);
        });
    }
};