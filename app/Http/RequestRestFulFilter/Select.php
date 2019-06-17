<?php


namespace App\Http\RequestRestFulFilter;


class Select extends BaseRequestRestFullFilter
{

    public function apply(): void
    {
        if (!empty($this->request->fields)) {
            $fieldsSelect = explode(',', $this->request->fields);

            if ($fieldsSelect = array_map('trim', $fieldsSelect)) {
                $this->builder->select($fieldsSelect);
            }
        }
    }

}
