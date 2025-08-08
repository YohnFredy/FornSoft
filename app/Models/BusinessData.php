<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BusinessData extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'phone',
        'whatsapp',
        'website_url',
        'business_email',
        'description',
        'country_id',
        'department_id',
        'city_id',
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

   
    public function storeTypes()
    {
        return $this->belongsToMany(StoreType::class, 'business_data_store_type');
    }

    public function country()
    {
        return $this->belongsTo(\App\Models\Country::class, 'country_id');
    }

    public function department()
    {
        return $this->belongsTo(\App\Models\Department::class, 'department_id');
    }

    public function cityRelation()
    {
        return $this->belongsTo(\App\Models\City::class, 'city_id');
    }
}
