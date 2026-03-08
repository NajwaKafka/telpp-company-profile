<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'name',
        'url',
        'is_actived',
        'parent_id',
    ];

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('id', 'asc');
    }

    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }
}
