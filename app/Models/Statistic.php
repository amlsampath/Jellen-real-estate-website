<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Statistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'value',
        'suffix',
        'description',
        'order'
    ];

    protected $casts = [
        'order' => 'integer'
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
