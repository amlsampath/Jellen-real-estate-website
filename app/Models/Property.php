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
        'property_category',
        'listing_type',
        'slug',
        'price',
        'price_currency',
        'location',
        'bedrooms',
        'bathrooms',
        'area',
        'parking_spaces',
        'amenities',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'postal_code',
        'country',
        'featured_image',
        'gallery_images',
        'status',
        'featured',
        'is_active',
        'approved',
        'created_by'
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'amenities' => 'array',
        'featured' => 'boolean',
        'is_active' => 'boolean',
        'approved' => 'boolean',
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

    // Relationships
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }


    // Auto-generate slug from title
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($property) {
            if (empty($property->slug)) {
                $property->slug = static::generateUniqueSlug($property->title);
            }
        });
        
        static::updating(function ($property) {
            if ($property->isDirty('title')) {
                $property->slug = static::generateUniqueSlug($property->title, $property->id);
            }
        });
    }
    
    // Use slug for route model binding
    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    // Generate unique slug
    public static function generateUniqueSlug($title, $excludeId = null)
    {
        $slug = \Illuminate\Support\Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;
        
        while (static::where('slug', $slug)->when($excludeId, function($query) use ($excludeId) {
            return $query->where('id', '!=', $excludeId);
        })->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        
        return $slug;
    }

    // Get the correct image URL (handles both old and new paths)
    public function getFeaturedImageUrlAttribute()
    {
        if (!$this->featured_image) {
            return null;
        }
        
        // Check if it's a new uploaded image (stored in storage)
        if (file_exists(storage_path('app/public/images/properties/' . $this->featured_image))) {
            return asset('storage/images/properties/' . $this->featured_image);
        }
        
        // Check if it's an existing image in public directory
        if (file_exists(public_path('images/properties/' . $this->featured_image))) {
            return asset('images/properties/' . $this->featured_image);
        }
        
        // If image doesn't exist, return a placeholder
        return asset('images/placeholder-property.jpg');
    }

    // Get gallery image URLs
    public function getGalleryImageUrlsAttribute()
    {
        if (!$this->gallery_images) {
            return [];
        }
        
        $urls = [];
        foreach ($this->gallery_images as $image) {
            // Check if it's a new uploaded image (stored in storage)
            if (file_exists(storage_path('app/public/images/properties/' . $image))) {
                $urls[] = asset('storage/images/properties/' . $image);
            }
            // Check if it's an existing image in public directory
            elseif (file_exists(public_path('images/properties/' . $image))) {
                $urls[] = asset('images/properties/' . $image);
            }
            // If image doesn't exist, skip it (don't show placeholder for gallery)
        }
        
        return $urls;
    }
}
