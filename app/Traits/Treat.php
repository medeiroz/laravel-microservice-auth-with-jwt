<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Http\RequestRestFulFilter;

trait Treat
{
    public function scopeTreat($builder, $request)
    {

        (new RequestRestFulFilter\Select($builder, $request))->apply();
        (new RequestRestFulFilter\Where($builder, $request))->apply();
        (new RequestRestFulFilter\OrderBy($builder, $request))->apply();

        return $builder;
    }
}
