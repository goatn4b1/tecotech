<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{
    protected $fillable = ['type', 'name', 'data', 'order', 'is_active'];

    protected $casts = [
        'data' => 'array',
        'is_active' => 'boolean',
    ];
}
