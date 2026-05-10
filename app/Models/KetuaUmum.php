<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KetuaUmum extends Model
{
    protected $fillable = [
        'name',
        'image',
        'image_path',
        'period',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
