<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter
{
    private array $params;

    protected Builder $builder;

    protected string $delimiter = '.';

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->params as $name => $value) {
            if (method_exists($this, $name) && $value) {
                call_user_func_array([$this, $name], array_filter([$value]));
            }
        }
        return $this->builder;
    }

    protected function paramToArray($param)
    {
        return explode($this->delimiter, $param);
    }
}
