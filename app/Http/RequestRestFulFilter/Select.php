<?php


namespace App\Http\RequestRestFulFilter;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class Select
{

    private $builder;
    private $request;
    private $fillable;

    public function __construct(Builder $builder, Request $request)
    {
        $this->builder = $builder;
        $this->request = $request;
        $this->fillable = $this->builder->getModel()->getFillable();
        $this->fillable = array_merge($this->fillable, ['created_at', 'updated_at', 'id']);
    }


    /**
     * Seleção das colunas
     */
    public function apply(): void
    {
        if (!empty($this->request->fields)) {
            $fieldsSelect = explode(',', $this->request->fields);

            if ($fieldsSelect) {
                $this->builder->select($fieldsSelect);
            }
        }
    }


}
