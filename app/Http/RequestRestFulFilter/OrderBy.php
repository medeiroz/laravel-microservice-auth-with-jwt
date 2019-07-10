<?php


namespace App\Http\RequestRestFulFilter;


class OrderBy extends BaseRequestRestFullFilter
{

    public function apply(): void
    {
        if (!empty($this->request->sort)) {

            $columns = $this->columnsStringToArray($this->request->sort);

            foreach ($columns as $column) {

                $columnName = $this->getColumnName($column);
                $orderBy = $this->getOrderByColumnName($column);

                if (in_array($columnName, $this->fillable)) {
                    $this->builder->orderBy($columnName, $orderBy);
                }
            }
        }
    }


    private function columnsStringToArray(string $columns)
    {
        return explode(',', $columns);
    }


    private function getFirstLetter(string $string)
    {
        return substr($string,0,1);
    }


    private function getColumnName(string $column)
    {
        $firstLetter = $this->getFirstLetter($column);

        return (in_array($firstLetter, ['-', '+']))
            ? substr($column,1)
            : $column;
    }


    private function getOrderByColumnName(string $column)
    {
        $firstLetter = $this->getFirstLetter($column);

        return ($firstLetter === '-') ? 'desc' : 'asc';
    }


}
