<?php

namespace App\Filters;

use Illuminate\Support\Facades\DB;

class ProductFilters extends QueryFilter
{
    protected function category($categoryIds)
    {
        $this->builder->join('category_group', 'groups.id', '=', 'category_group.group_id');
        $this->builder->whereIn('category_group.category_id', $this->paramToArray($categoryIds));
    }

    protected function group($groupIds = '')
    {
        $this->builder
            ->whereIn('products.group_id', $this->paramToArray($groupIds));
    }

    protected function brand($brandIds)
    {
        $this->builder->whereIn('products.brand_id', $this->paramToArray($brandIds));
    }

    protected function size($sizeIds)
    {
        $this->builder->whereIn('variant_prices.size_id', $this->paramToArray($sizeIds));
    }

    protected function name($name)
    {
        if ($name = (string)$name) {
            $this->builder->where(DB::raw("CONCAT(products.name, ' ', variants.short_name)"), 'like', '%' . $name . '%');
        }
    }
}
