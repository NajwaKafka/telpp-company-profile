<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    protected $fillable = [
        'history_title',
        'history_description',
        'creed_statement',
    ];
}
