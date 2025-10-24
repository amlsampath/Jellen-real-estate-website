<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AgentContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'email',
        'mobile_number',
        'whatsapp_number',
        'bio',
        'photo',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Scope for active agent
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Get WhatsApp link
    public function getWhatsappLinkAttribute()
    {
        // Remove any non-numeric characters from the number
        $cleanNumber = preg_replace('/[^0-9]/', '', $this->whatsapp_number);
        return "https://wa.me/{$cleanNumber}";
    }

    // Get phone link
    public function getPhoneLinkAttribute()
    {
        return "tel:{$this->mobile_number}";
    }

    // Get email link
    public function getEmailLinkAttribute()
    {
        return "mailto:{$this->email}";
    }
}