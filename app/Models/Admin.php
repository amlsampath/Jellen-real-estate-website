<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'username',
        'password',
        'name',
        'email',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // Relationships
    public function properties()
    {
        return $this->hasMany(Property::class, 'created_by');
    }

    public function blogPosts()
    {
        return $this->hasMany(BlogPost::class, 'created_by');
    }

    public function mediaFiles()
    {
        return $this->hasMany(MediaFile::class, 'uploaded_by');
    }
}
