<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\RequestRestFulFilter;

trait Treat
{
    public function scopeTreat(Builder $builder, Request $request)
    {
        $select = new RequestRestFulFilter\Select($builder, $request);
        $where = new RequestRestFulFilter\Where($builder, $request);
        $orderBy = new RequestRestFulFilter\OrderBy($builder, $request);
        $paginate = new RequestRestFulFilter\Paginate($builder, $request);

        $select->apply();
        $where->apply();
        $orderBy->apply();

        return $paginate->applyAndGetResouces();
    }
}
