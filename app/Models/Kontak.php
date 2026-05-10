<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    protected $fillable = [
        'address',
        'phone',
        'email',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'youtube',
        'map_url',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
