<?php


namespace App\Http\RequestRestFulFilter;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class BaseRequestRestFullFilter
{

    protected $builder;
    protected $request;
    protected $fillable;

    public function __construct(Builder $builder, Request $request)
    {
        $this->builder = $builder;
        $this->request = $request;
        $this->fillable = $this->builder->getModel()->getFillable();
        $this->fillable = array_merge($this->fillable, ['created_at', 'updated_at', 'id']);
    }

    abstract public function apply();
}
