<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PubAffiliate extends Model
{
    protected $table = 'pub_affiliates';

    /**
     * Campos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'control_id',
        'user_id',
        'side',
    ];

    /**
     * Relación con el control de publicidad.
     *
     * Un afiliado pertenece a un registro de control.
     */
    public function control()
    {
        return $this->belongsTo(PubControl::class);
    }

    /**
     * Relación con el usuario que fue asignado como afiliado.
     *
     * Un afiliado pertenece a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
