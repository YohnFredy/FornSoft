<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BusinessData extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'store_type',
        'phone',
        'whatsapp',
        'website_url',
        'email',
        'description',
        'country',
        'department',
        'city',
        'address',
        'latitude',
        'longitude',
        'facebook_url',
        'instagram_url',
        'linkedin_url',
        'youtube_url',
        'tiktok_url',
        'x_url',
        'promo_video_url',
        'additional_videos',
        'custom_links',
    ];

     protected $casts = [
        'additional_videos' => 'array',
        'custom_links' => 'array',
    ];

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }
}
