<?php


namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
    protected $request;
    protected $builder;
    protected $filters = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function apply($builder)
    {
        $this->builder = $builder;
        foreach ($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }
        // foreach ($this->getFilters as $filter => $value) {
        //     if (method_exists($this, $filter)) {
        //         $this->$filter($value);
        //     }
        // }
        // if ($this->request->has('by')) {
        //     $this->by($this->request->by);
        // }
        return $this->builder;
    }

    public function getFilters()
    {
        return $this->request->only($this->filters);
    }
}
