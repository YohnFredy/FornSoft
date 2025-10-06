<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommissionInvoiceItem extends Model
{
    protected $table = 'commission_invoice_items';

    protected $fillable = [
        'commission_received_id',
        'business_data_id',
        'company_name',
        'invoice_number',
        'total_sales_report',
        'taxable_amount',
        'tax_amount',
        'invoice_id',
        'reconciliation_status',
        'notes',
    ];

    protected $casts = [
        'total_sales_report' => 'decimal:2',
        'taxable_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
    ];

    public function commissionReceived(): BelongsTo
    {
        return $this->belongsTo(CommissionReceived::class);
    }

    public function businessData(): BelongsTo
    {
        return $this->belongsTo(BusinessData::class);
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }
}
