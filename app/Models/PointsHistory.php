<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointsHistory extends Model
{
    protected $fillable = ['user_id', 'start', 'end', 'personal', 'unilevel', 'left_binary', 'right_binary'];
}
