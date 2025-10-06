<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommissionReceived extends Model
{
    protected $table = 'commission_receiveds';

    protected $fillable = [
        'business_data_id',
        'excel_batch_id',
        'report_date',
        'total_sales_report',
        'taxable_amount',
        'tax_amount',
        'payment_date',
        'payment_reference',
        'fornuvi_invoice_number',
        'status',
    ];

    /**
     * Casts de atributos para manejar correctamente los tipos de datos.
     */
    protected $casts = [
        'report_date' => 'date',
        'payment_date' => 'date',
        'total_sales_report' => 'date',
        'taxable_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
    ];

    public function businessData(): BelongsTo
    {
        return $this->belongsTo(BusinessData::class);
    }
}
