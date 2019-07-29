<?php

namespace App\Models\Auth;

use Illuminate\Cache\TaggableStore;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Hash;
use mysql_xdevapi\Exception;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use App\Traits\Treat;

class User extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use Notifiable;
    use EntrustUserTrait;
    use Treat;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function scopeByEmail($builder, string $email)
    {
        return $builder->where($this->table . ".email", $email);
    }

    public function scopeByPhone($builder, string $phone)
    {
        return $builder->where($this->table . ".phone", $phone);
    }

    public function getFirstNameAttribute(): string
    {
        return explode(' ', $this->name)[0];
    }

    public function setPasswordAttribute(string $value): void
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function saveRoles($inputRoles)
    {
        if (!empty($inputRoles)) {
            $this->roles()->sync($inputRoles);
        } else {
            $this->roles()->detach();
        }

        if (Cache::getStore() instanceof TaggableStore) {
            Cache::tags(config('entrust.role_user_table'))->flush();
        }
    }

}
