<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sejarah extends Model
{
    protected $fillable = [
        'title',
        'content',
        'image',
        'image_path',
        'period',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
