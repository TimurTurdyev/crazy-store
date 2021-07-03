<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Size;

class FilterRepository
{

    private array $groups;

    public function __construct(string $groups)
    {
        $this->groups = explode('.', $groups);
    }

    public function brands()
    {
        return Brand::select(['brands.id', 'brands.name'])
            ->join('products', 'brands.id', '=', 'products.brand_id')
            ->whereIn('products.group_id', $this->groups)
            ->groupBy(['brands.id', 'brands.name'])
            ->get();
    }

    public function sizes()
    {
        return Size::select(['sizes.id', 'sizes.name'])
            ->join('variant_prices', 'sizes.id', '=', 'variant_prices.size_id')
            ->join('variants', 'variant_prices.variant_id', '=', 'variants.id')
            ->join('products', 'variants.product_id', '=', 'products.id')
            ->whereIn('products.group_id', $this->groups)
            ->groupBy(['sizes.id', 'sizes.name'])
            ->get();
    }

}
