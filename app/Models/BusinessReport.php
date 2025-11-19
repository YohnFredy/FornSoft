<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessReport extends Model
{
    protected $fillable = [
        'invoice_date',
        'business_data_id',
        'user_dni',
        'total_amount',
        'commission',
        'currency',
        'status',
        'invoice_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
