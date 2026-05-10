<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kemitraan extends Model
{
    protected $fillable = [
        'name',
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
}
