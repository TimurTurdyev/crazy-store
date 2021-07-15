<?php

namespace App\Filters;

class SizeFilters extends QueryFilter
{
    protected function brand($brandIds)
    {
        $this->builder->whereIn('products.brand_id', $this->paramToArray($brandIds));
    }

    protected function category($categoryIds)
    {
        $this->builder->join('category_group', 'groups.id', '=', 'category_group.group_id');
        $this->builder->whereIn('category_group.category_id', $this->paramToArray($categoryIds));
    }

    protected function group($groupIds = '')
    {
        $this->builder->whereIn('products.group_id', $this->paramToArray($groupIds));
    }
}
