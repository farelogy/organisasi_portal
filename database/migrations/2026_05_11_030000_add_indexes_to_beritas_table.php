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
        Schema::table('beritas', function (Blueprint $table) {
            // Add composite index for common query patterns
            $table->index(['is_active', 'published_at'], 'beritas_active_published_idx');
            $table->index(['category', 'is_active', 'published_at'], 'beritas_category_active_published_idx');
            
            // Single column indexes for filtering
            $table->index('category', 'beritas_category_idx');
            $table->index('is_active', 'beritas_is_active_idx');
            $table->index('published_at', 'beritas_published_at_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('beritas', function (Blueprint $table) {
            $table->dropIndex('beritas_active_published_idx');
            $table->dropIndex('beritas_category_active_published_idx');
            $table->dropIndex('beritas_category_idx');
            $table->dropIndex('beritas_is_active_idx');
            $table->dropIndex('beritas_published_at_idx');
        });
    }
};
