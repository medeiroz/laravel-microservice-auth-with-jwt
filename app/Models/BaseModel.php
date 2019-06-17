<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Treat;
use App\Scopes\OwnerScope;

class BaseModel extends Model
{
    use Treat;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new OwnerScope);
    }
}
