<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointsDistribution extends Model
{
    protected $table = 'points_distributions';

    protected $fillable = [
        'user_id',
        'invoice_id',
        'commission_invoice_item_id',
        'points',
    ];

     protected $casts = [
        'points' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function commissionInvoiceItem()
    {
        return $this->belongsTo(CommissionInvoiceItem::class);
    }

    public function adminUser()
    {
        return $this->belongsTo(User::class);
    }
}
