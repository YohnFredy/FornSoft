<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nit',
        'user_id',
        'percentage',
        'email',
        'password',
    ];

    public function categories(): BelongsToMany
    {
        // Usamos "categories" como nombre del método para que sea más natural de leer ($business->categories)
        return $this->belongsToMany(BusinessCategory::class, 'business_business_category');
    }

    public function data(): HasMany
    {
        return $this->hasMany(BusinessData::class);
    }
}
