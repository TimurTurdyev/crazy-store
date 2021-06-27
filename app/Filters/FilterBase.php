<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

abstract class FilterBase
{
    protected $builder;
    private $params;

    public function __construct(Builder $builder, array $params)
    {
        $this->builder = $builder;
        $this->params = $params;
    }

    public function apply(): Builder
    {
        foreach ($this->params as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter(is_array($value) ? $value : [$value]);
            }
        }

        return $this->builder;
    }
}
