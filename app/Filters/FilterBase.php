<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class FilterBase
{
    protected $builder;
    private $params;
    protected $delimiter = '.';

    public function __construct(Builder $builder, $params)
    {
        $this->builder = $builder;
        $this->params = $params;
    }

    public function apply(): Builder
    {
        foreach ($this->params as $name => $value) {
            if (method_exists($this, $name)) {
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
