<?php


namespace App\Http\RequestRestFulFilter;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class OrderBy
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
     * Ordenação dos registros
     */
    public function apply(): void
    {


        if (!empty($this->request->sort)) {

            $aux_explode = explode(',', $this->request->sort);

            foreach ($aux_explode as $value) {

                $firstLetter = substr($value,0,1);

                $orderBy = ($firstLetter === '-') ? 'desc' : 'asc';

                if (in_array($firstLetter, ['-', '+'])) {
                    $columnBy = substr($value,1);
                } else {
                    $columnBy = $value;
                }

                if (in_array($columnBy, $this->fillable)) {
                    $this->builder->orderBy($columnBy, $orderBy);
                }

            }


        }

    }


}
