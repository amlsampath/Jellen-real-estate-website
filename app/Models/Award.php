<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Award extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'year',
        'category',
        'image',
        'order'
    ];

    protected $casts = [
        'year' => 'integer',
        'order' => 'integer'
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function scopeByYear($query, $year)
    {
        return $query->where('year', $year);
    }
}
