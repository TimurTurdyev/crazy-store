<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class FilterAbstract
{
    private array $params;

    protected Builder $builder;

    protected string $delimiter = '.';

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;

        foreach ($this->params as $name => $value) {
            if (method_exists($this, $name)) {
                call_user_func_array([$this, $name], array_filter([$value]));
            }
        }
        return $this->builder;
    }

    protected function paramToArray($param): array
    {
        return explode($this->delimiter, $param);
    }
}
