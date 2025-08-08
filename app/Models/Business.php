<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'nit',
        'user_id',
        'minimum_percentage',
        'maximum_percentage',
        'email',
        'password',
        'is_active',
    ];

    // Relación polimórfica genérica
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    // RECOMENDACIÓN: Relación específica para logos
    public function logos()
    {
        return $this->morphMany(Image::class, 'imageable')->where('type', 'logo');
    }

    public function latestLogo()
    {
        return $this->morphOne(Image::class, 'imageable')->latestOfMany('type', 'logo');
    }

    // RECOMENDACIÓN: Relación específica para imágenes de galería
    public function galleryImages()
    {
        // Renombramos para evitar confusión con la relación genérica "images"
        return $this->morphMany(Image::class, 'imageable')->where('type', 'image');
    }

    public function businessCategories()
    {
        return $this->belongsToMany(
            \App\Models\BusinessCategory::class,
            'business_business_category',
            'business_id',
            'business_category_id'
        );
    }

    public function categories(): BelongsToMany
    {
        // Usamos "categories" como nombre del método para que sea más natural de leer ($business->categories)
        return $this->belongsToMany(BusinessCategory::class, 'business_business_category');
    }

    public function data(): HasMany
    {
        return $this->hasMany(BusinessData::class);
    }

    public static function generateSlug($name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $i = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$i}";
            $i++;
        }

        return $slug;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
