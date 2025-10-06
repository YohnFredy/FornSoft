<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderBillingData extends Model
{
     use HasFactory;

    protected $table = 'order_billing_data';

    protected $fillable = [
        'order_id',
        'name',
        'document_type_id',
        'document',
        'email',
        'phone',
        'country_id',
        'department_id',
        'city_id',
        'addCity',
        'address',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
