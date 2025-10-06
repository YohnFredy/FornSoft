<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'parent_id', 'is_final', 'is_active'
    ];

    protected $casts = [
        'is_final' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->where('is_active', 1);
    }
    /**
     * Obtiene la ruta completa de la categoría
     * (Categoría padre > Categoría actual)
     */
    public function getFullPathAttribute()
    {
        $path = [$this->name];
        $category = $this;
        
        while ($category->parent) {
            $path[] = $category->parent->name;
            $category = $category->parent;
        }
        
        return implode(' > ', array_reverse($path));
    }
    
    

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    

   public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = static::generateSlug($model->name);
        });
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
