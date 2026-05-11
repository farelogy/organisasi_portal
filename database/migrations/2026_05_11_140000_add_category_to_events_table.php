<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('category')->nullable()->after('type');
            $table->string('sub_category')->nullable()->after('category');
            $table->text('description')->nullable()->change();
            $table->string('location')->nullable()->change();
            $table->dateTime('event_date')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['category', 'sub_category']);
        });
    }
};
