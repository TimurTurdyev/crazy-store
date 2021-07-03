<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter
{
    private Request $request;

    protected Builder $builder;

    protected string $delimiter = '.';

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function requestMerge($params)
    {
        $this->request->merge($params);
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->filters() as $name => $value) {
            if (method_exists($this, $name)) {
                call_user_func_array([$this, $name], array_filter([$value]));
            }
        }
        return $this->builder;
    }

    public function filters()
    {
        return $this->request->query();
    }

    protected function paramToArray($param)
    {
        return explode($this->delimiter, $param);
    }
}
