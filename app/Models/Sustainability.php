<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sustainability extends Model
{
    protected $fillable = [
        'category',
        'title',
        'slug',
        'description',
        'cover_image',
        'icon',
        'order',
        'is_active',
    ];

    public function images()
    {
        return $this->hasMany(SustainabilityImage::class);
    }
}
