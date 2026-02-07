<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'content', // JSON or text for topics
        'duration',
        'price',
        'image',
        'icon',
        'is_active',
        'order'
    ];

    protected $casts = [
        'content' => 'array',
        'is_active' => 'boolean',
        'price' => 'decimal:2'
    ];

    public function registrations()
    {
        return $this->hasMany(CourseRegistration::class);
    }
}
