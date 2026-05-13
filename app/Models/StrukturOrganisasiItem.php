<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasiItem extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'link',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
