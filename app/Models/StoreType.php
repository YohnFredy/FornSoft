<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreType extends Model
{
    protected $fillable = ['name']; // Solo el campo 'name' se puede asignar masivamente

    public function businessData()
    {
        return $this->belongsToMany(BusinessData::class, 'business_data_store_type');
    }
}
