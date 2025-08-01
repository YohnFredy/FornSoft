<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseSupport extends Model
{
    protected $fillable = [
        'business_id',
        'invoice_number',
        'currency',
        'total_amount',
        'pts',
        'invoice_date',
        'image_path',
        'status',
        'review_notes',
    ];
}
