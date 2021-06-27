<?php

namespace App\Filters;

class ProductFilter extends FilterBase
{
    protected function group(array $value)
    {
        if (count($value)) {
            $this->builder->whereIn('products.group_id', '=', $value);
        }
    }

    protected function brand(array $value)
    {
        if (count($value)) {
            $this->builder->whereIn('products.brand_id', $value);
        }
    }

    protected function size(array $value)
    {
        if (count($value)) {
            $this->builder->whereIn('variant_prices.size_id', $value);
        }
    }
}
