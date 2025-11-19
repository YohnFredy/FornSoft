<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'business_data_id',
        'invoice_number',
        'total_amount',
        'pts',
        'invoice_date',
        'start',
        'end',
        'locked',
        'currency',
        'image_path',
        'status',
        'review_notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

   /*  public function businessData()
    {
        return $this->belongsTo(BusinessData::class);
    } */

    public function businessData()
{
    return $this->belongsTo(BusinessData::class)->select(['id','business_id']);
}

    // Accessor para llegar al negocio
    public function getBusinessAttribute()
    {
        return $this->businessData?->business;
    }
}
