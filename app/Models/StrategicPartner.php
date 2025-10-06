<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StrategicPartner extends Model
{
    protected $table = 'strategic_partners';

    protected $fillable = [
        'user_id',
        'commission_received_id',
        'points',
        'status',
    ];

    protected $casts = [
        'points' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function commissionReceived(): BelongsTo
    {
        return $this->belongsTo(CommissionReceived::class);
    }
}
