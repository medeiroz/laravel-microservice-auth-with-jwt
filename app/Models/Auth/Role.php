<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Builder;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];


    public function scopeByName(Builder $builder, string $name)
    {
        return $builder
            ->where($this->table . '.name', $name)
            ->firstOrFail();
    }
}
