<?php


namespace App\Http\RequestRestFulFilter;


class Where extends BaseRequestRestFullFilter
{

    private $fieldsSearch;


    /**
     * Aplica os filtros
     */
    public function apply(): void
    {
        $this->fieldsSearch = array_intersect_key($this->request->all(), array_flip($this->fillable));

        $this
            ->applyEq()
            ->applyLt()
            ->applyLte()
            ->applyGt()
            ->applyGte()
            ->applyLike()
            ->applyRegex();
    }


    /**
     * Aplica os filtros usando =
     * @return Where
     */
    private function applyEq(): self
    {

        foreach($this->fieldsSearch as $column => $field) {

            if (!is_array($field) || !empty($field['eq'])) {
                $valueSearch = ($field['eq']) ?? $field;
                $this->builder->where($column,'=', $valueSearch);
            }
        }

        return $this;
    }


    /**
     * Aplica os filtros usando <
     * @return Where
     */
    private function applyLt(): self
    {
        foreach($this->fieldsSearch as $column => $field) {
            if (!empty($field['lt']) || !empty($field['before']) ) {
                $valueSearch = ($field['lt']) ?? $field['before'];
                $this->builder->where($column, '<', $valueSearch);
            }
        }

        return $this;
    }


    /**
     * Aplica os filtros usando <=
     * @return Where
     */
    private function applyLte(): self
    {
        foreach($this->fieldsSearch as $column => $field) {
            if (!empty($field['lte'])) {
                $valueSearch = $field['lte'];
                $this->builder->where($column,'<=', $valueSearch);
            }
        }

        return $this;
    }


    /**
     * Aplica os filtros usando >
     * @return Where
     */
    private function applyGt(): self
    {
        foreach($this->fieldsSearch as $column => $field) {
            if (!empty($field['gt']) || !empty($field['after']) ) {
                $valueSearch = ($field['gt']) ?? $field['after'];
                $this->builder->where($column, '>', $valueSearch);
            }
        }

        return $this;
    }


    /**
     * Aplica os filtros usando >=
     * @return Where
     */
    private function applyGte(): self
    {
        foreach($this->fieldsSearch as $column => $field) {
            if (!empty($field['gte'])) {
                $valueSearch = $field['gte'];
                $this->builder->where($column,'>=', $valueSearch);
            }
        }

        return $this;
    }


    /**
     * Aplica os filtros usando like
     * @return Where
     */
    private function applyLike(): self
    {
        foreach($this->fieldsSearch as $column => $field) {

            if (!empty($field['like'])) {
                $valueSearch = $field['like'];
                $this->builder->where($column,'like',"%{$valueSearch}%");
            }
        }

        return $this;
    }

    /**
     * Aplica o filtros de regex
     * @return Where
     */
    private function applyRegex(): self
    {
        foreach($this->fieldsSearch as $column => $field) {

            if (!empty($field['regex'])) {
                $valueSearch = $field['regex'];
                $this->builder->where($column,'regexp', $valueSearch);
            }
        }

        return $this;
    }


}
