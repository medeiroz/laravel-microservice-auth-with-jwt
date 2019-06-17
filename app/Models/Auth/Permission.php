<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Builder;
use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
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
