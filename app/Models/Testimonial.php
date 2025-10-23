<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'client_role',
        'content',
        'rating',
        'image',
        'featured'
    ];

    protected $casts = [
        'featured' => 'boolean',
        'rating' => 'integer'
    ];

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }
}
