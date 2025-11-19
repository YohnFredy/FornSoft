<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BinaryPoint extends Model
{
    protected $fillable = ['user_id', 'personal', 'points_left', 'points_right', 'locked', 'approved'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
