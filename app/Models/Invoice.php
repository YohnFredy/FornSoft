<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'business_data_id',
        'company_name',
        'nit',
        'invoice_number',
        'total_amount',
        'pts',
        'invoice_date',
        'currency',
        'image_path',
        'status',
        'review_notes',
    ];

    protected $casts = [
        'invoice_date_ocr' => 'date',
        'raw_ocr_response' => 'array', // Para convertir el JSON a array automáticamente
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
