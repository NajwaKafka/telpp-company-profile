<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SustainabilityImage extends Model
{
    protected $fillable = [
        'sustainability_id',
        'image_path',
    ];

    public function sustainability()
    {
        return $this->belongsTo(Sustainability::class);
    }
}
