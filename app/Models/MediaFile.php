<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MediaFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
        'original_filename',
        'path',
        'storage_type',
        'file_type',
        'file_size',
        'mime_type',
        'uploaded_by',
    ];

    protected $casts = [
        'file_size' => 'integer',
    ];

    // Relationships
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'uploaded_by');
    }

    // Accessor for full file path
    public function getFullPathAttribute()
    {
        if ($this->storage_type === 'public') {
            return asset($this->path);
        }
        return storage_path('app/' . $this->path);
    }

    // Accessor for file URL
    public function getUrlAttribute()
    {
        if ($this->storage_type === 'public') {
            return asset($this->path);
        }
        return asset('storage/' . $this->path);
    }
}
