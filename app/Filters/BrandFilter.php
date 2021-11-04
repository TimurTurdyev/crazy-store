<?php

namespace App\Filters;

class BrandFilter extends FilterAbstract
{
    protected function category($categoryIds)
    {
        $this->builder->join('category_group', 'groups.id', '=', 'category_group.group_id');
        $this->builder->whereIn('category_group.category_id', $this->paramToArray($categoryIds));
    }

    protected function group($groupIds = '')
    {
        $this->builder
            ->where('products.status', '=', 1)
            ->whereIn('products.group_id', $this->paramToArray($groupIds));
    }

    protected function discount($value = '') {
        if ($value === 'yes') {
            $this->builder->where('variant_prices.discount', '>', 0);
        } else {
            $this->builder->where('variant_prices.discount', '=', 0);
        }
    }
}
