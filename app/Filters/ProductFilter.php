<?php

namespace App\Filters;

use Illuminate\Support\Facades\DB;

class ProductFilter extends FilterAbstract
{
    protected function category($categoryIds)
    {
        $this->builder->join('category_group', 'groups.id', '=', 'category_group.group_id');
        $this->builder->whereIn('category_group.category_id', $this->paramToArray($categoryIds));
    }

    protected function discount($value = '') {
        if ($value === 'yes') {
            $this->builder->where('variant_prices.discount', '>', 0);
        } else {
            $this->builder->where('variant_prices.discount', '=', 0);
        }
    }

    protected function group($groupIds = '')
    {
        $this->builder->whereIn('products.group_id', $this->paramToArray($groupIds));
    }

    protected function brand($brandIds)
    {
        $this->builder->whereIn('products.brand_id', $this->paramToArray($brandIds));
    }

    protected function size($sizeIds)
    {
        $this->builder->whereIn('variant_prices.size_id', $this->paramToArray($sizeIds));
    }

    protected function name($value)
    {
        if (is_string($value)) {
            $this->builder->leftJoin('sizes', 'variant_prices.size_id', '=', 'sizes.id');
            $this->builder->where(DB::raw("REGEXP_REPLACE(CONCAT(products.name, '', variants.short_name, sizes.name), '[^[:alnum:]]', '')"), 'like', '%' . preg_replace('/[^[:alnum:]]/u', '', $value) . '%');
        }
    }

    protected function stock($value = 'in')
    {
        if ($value === 'out') {
            $this->builder->where('variant_prices.quantity', '<', 1);
        } else {
            $this->builder->where('variant_prices.quantity', '>', 0);
        }
    }

    protected function status($value = 'on')
    {
        if ($value === 'off') {
            $this->builder->where('variants.status', '=', 0);
        } else {
            $this->builder->where('variants.status', '=', 1);
        }
    }
}
