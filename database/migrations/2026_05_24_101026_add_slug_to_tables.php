<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add slug column to tables
        Schema::table('beritas', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique();
        });

        Schema::table('events', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique();
        });

        Schema::table('kemitraans', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique();
        });

        // Populate existing Beritas
        $beritas = DB::table('beritas')->get();
        foreach ($beritas as $row) {
            $baseSlug = Str::slug($row->title ?: 'berita');
            if (empty($baseSlug)) {
                $baseSlug = 'berita-' . $row->id;
            }
            $slug = $baseSlug;
            $count = 1;
            while (DB::table('beritas')->where('slug', $slug)->where('id', '!=', $row->id)->exists()) {
                $slug = $baseSlug . '-' . $count;
                $count++;
            }
            DB::table('beritas')->where('id', $row->id)->update(['slug' => $slug]);
        }

        // Populate existing Events
        $events = DB::table('events')->get();
        foreach ($events as $row) {
            $baseSlug = Str::slug($row->title ?: 'event');
            if (empty($baseSlug)) {
                $baseSlug = 'event-' . $row->id;
            }
            $slug = $baseSlug;
            $count = 1;
            while (DB::table('events')->where('slug', $slug)->where('id', '!=', $row->id)->exists()) {
                $slug = $baseSlug . '-' . $count;
                $count++;
            }
            DB::table('events')->where('id', $row->id)->update(['slug' => $slug]);
        }

        // Populate existing Kemitraans
        $kemitraans = DB::table('kemitraans')->get();
        foreach ($kemitraans as $row) {
            $baseSlug = Str::slug($row->name ?: 'mitra');
            if (empty($baseSlug)) {
                $baseSlug = 'mitra-' . $row->id;
            }
            $slug = $baseSlug;
            $count = 1;
            while (DB::table('kemitraans')->where('slug', $slug)->where('id', '!=', $row->id)->exists()) {
                $slug = $baseSlug . '-' . $count;
                $count++;
            }
            DB::table('kemitraans')->where('id', $row->id)->update(['slug' => $slug]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('beritas', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('kemitraans', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
