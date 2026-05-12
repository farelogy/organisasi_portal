<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('struktur_organisasis', function (Blueprint $table) {
            $table->dropColumn(['name', 'position', 'description', 'photo', 'order']);
        });
    }

    public function down(): void
    {
        Schema::table('struktur_organisasis', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->string('position')->nullable();
            $table->text('description')->nullable();
            $table->string('photo')->nullable();
            $table->integer('order')->default(0);
        });
    }
};
