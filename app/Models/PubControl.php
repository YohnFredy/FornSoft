<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PubControl extends Model
{
     protected $table = 'pub_controls';

    /**
     * Campos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'user_id',
        'total_assigned',
        'ad_value',
    ];

    /**
     * Relación con el usuario al que pertenece este control.
     *
     * Un control de publicidad pertenece a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con los afiliados asignados mediante publicidad.
     *
     * Un control puede tener muchos afiliados relacionados.
     */
    public function affiliates()
    {
        return $this->hasMany(PubAffiliate::class, 'control_id');
    }
}
