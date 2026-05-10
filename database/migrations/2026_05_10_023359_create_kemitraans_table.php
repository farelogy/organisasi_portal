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
        Schema::create('kemitraans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type'); // kerjasama_kampus, kerjasama_industri, program_pemerintah
            $table->text('description');
            $table->longText('content')->nullable();
            $table->string('logo')->nullable();
            $table->string('link')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kemitraans');
    }
};
