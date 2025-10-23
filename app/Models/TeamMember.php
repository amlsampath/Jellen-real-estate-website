<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'bio',
        'image',
        'social_links',
        'order',
        'featured'
    ];

    protected $casts = [
        'social_links' => 'array',
        'featured' => 'boolean',
        'order' => 'integer'
    ];

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
