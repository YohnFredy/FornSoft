<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Commission extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'vfb',
        'commission',
        'start',
        'end',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
