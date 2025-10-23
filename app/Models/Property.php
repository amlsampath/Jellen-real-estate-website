<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'property_type',
        'price',
        'location',
        'bedrooms',
        'bathrooms',
        'area',
        'featured_image',
        'gallery_images',
        'status',
        'featured'
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'featured' => 'boolean',
        'price' => 'decimal:2',
        'area' => 'decimal:2'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeForSale($query)
    {
        return $query->where('property_type', 'sale');
    }

    public function scopeForRent($query)
    {
        return $query->where('property_type', 'rent');
    }

    public function scopeForLease($query)
    {
        return $query->where('property_type', 'lease');
    }
}
