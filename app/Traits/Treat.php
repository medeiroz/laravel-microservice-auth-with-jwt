<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\RequestRestFulFilter\Select;
use App\Http\RequestRestFulFilter\Where;
use App\Http\RequestRestFulFilter\OrderBy;
use App\Http\RequestRestFulFilter\Paginate;

trait Treat
{
    public function scopeTreat(Builder $builder, Request $request)
    {
        $select = new Select($builder, $request);
        $where = new Where($builder, $request);
        $orderBy = new OrderBy($builder, $request);
        $paginate = new Paginate($builder, $request);

        $select->apply();
        $where->apply();
        $orderBy->apply();

        return $paginate->applyAndGetResources();
    }
}
