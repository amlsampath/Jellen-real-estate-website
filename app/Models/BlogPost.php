<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'author',
        'tags',
        'category',
        'is_published',
        'views',
        'reading_time',
        'meta_title',
        'meta_description',
        'created_by'
    ];

    protected $casts = [
        'tags' => 'array',
        'is_published' => 'boolean',
        'views' => 'integer',
        'reading_time' => 'integer'
    ];

    // Auto-generate slug from title
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($blogPost) {
            if (empty($blogPost->slug)) {
                $blogPost->slug = Str::slug($blogPost->title);
            }
        });
    }

    // Get reading time from content
    public function getReadingTimeAttribute()
    {
        $wordCount = str_word_count(strip_tags($this->content));
        return max(1, round($wordCount / 200)); // 200 words per minute
    }

    // Scope for published posts
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    // Scope for recent posts
    public function scopeRecent($query, $limit = 3)
    {
        return $query->orderBy('created_at', 'desc')->limit($limit);
    }

    // Relationships
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }
}
