<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Creed extends Model
{
    protected $fillable = [
        'title_jp',
        'title_en',
        'tagline',
        'description',
        'order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
