<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConsentLog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'contract_version_accepted',
        'privacy_policy_version_accepted',
        'accepted_at',
        'ip_address',
        'user_agent',
        'checkbox_text',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'accepted_at' => 'datetime',
    ];

    /**
     * Get the user that owns the consent log.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
