<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'images',
        'tech_stack',
        'github_url',
        'live_url',
        'is_featured',
    ];

    protected $casts = [
        'images' => 'array',
        'tech_stack' => 'array',
        'is_featured' => 'boolean',
    ];
}
