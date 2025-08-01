<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'name',
        'last_name',
        'dni',
        'email',
        'password',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn(string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }

    public function userData(): HasOne
    {
        return $this->hasOne(UserData::class);
    }

    public function binary()
    {
        return $this->hasOne(Binary::class);
    }

    public function binaryTotal()
    {
        return $this->hasOne(BinaryTotal::class);
    }

    public function binaryPts()
    {
        return $this->hasOne(BinaryPoint::class);
    }

    public function unilevel()
    {
        return $this->hasOne(Unilevel::class);
    }

    public function unilevelTotal()
    {
        return $this->hasOne(UnilevelTotal::class);
    }

    public function binaryPoint(): HasOne
    {
        return $this->hasOne(BinaryPoint::class);
    }

    public function unilevelPoint(): HasOne
    {
        return $this->hasOne(UnilevelPoint::class);
    }

    public function activation()
    {
        return $this->hasOne(UserActivation::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function commissions()
    {
        return $this->hasMany(Commission::class);
    }

      public function consentLogs(): HasMany
    {
        return $this->hasMany(ConsentLog::class);
    }

    /**
     * Opcional: Relación para obtener el último consentimiento fácilmente.
     */
    public function latestConsentLog()
    {
        return $this->hasOne(ConsentLog::class)->latestOfMany('accepted_at');
    }

}
