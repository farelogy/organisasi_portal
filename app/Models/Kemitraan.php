<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kemitraan extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'type',
        'description',
        'content',
        'logo',
        'link',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Generate a unique slug for Kemitraan.
     */
    public static function generateUniqueSlug(string $name, ?int $excludeId = null): string
    {
        $slug = \Illuminate\Support\Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        while (static::where('slug', $slug)->when($excludeId, function ($query, $excludeId) {
            return $query->where('id', '!=', $excludeId);
        })->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
