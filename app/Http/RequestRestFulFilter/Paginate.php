<?php


namespace App\Http\RequestRestFulFilter;


class Paginate extends BaseRequestRestFullFilter
{
    public $resources;

    public function apply(): void
    {
        if (empty($this->request->per_page)) {
            $this->request->per_page = env('PAGINATE_PER_PAGE');
        }

        if ($this->request->per_page === 'all') {
            $this->resources = ['data' => $this->builder->get()];

        } else {
            $per_page = ((int) $this->request->per_page) ?: config('app.paginate.per_page');
            $this->resources = $this->builder->paginate($per_page);
            $this->resources->appends($this->request->all());
        }
    }


    public function applyAndGetResources()
    {
        $this->apply();
        return $this->resources;
    }

}
