<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Size;

class FilterRepository
{

    private string $groups;

    public function __construct(string $groups)
    {
        $this->groups = $groups;
    }

    public function apply(): \Illuminate\Support\Collection
    {
        $groupIds = explode('.', $this->groups);
        return collect([
            'brands' => $this->brands($groupIds),
            'sizes' => $this->sizes($groupIds),
        ]);
    }

    private function brands($groupIds)
    {
        return Brand::select(['brands.id', 'brands.name'])
            ->join('products', 'brands.id', '=', 'products.brand_id')
            ->whereIn('products.group_id', $groupIds)
            ->groupBy(['brands.id', 'brands.name'])
            ->get();
    }

    private function sizes($groupIds)
    {
        return Size::select(['sizes.id', 'sizes.name'])
            ->join('variant_prices', 'sizes.id', '=', 'variant_prices.size_id')
            ->join('variants', 'variant_prices.variant_id', '=', 'variants.id')
            ->join('products', 'variants.product_id', '=', 'products.id')
            ->whereIn('products.group_id', $groupIds)
            ->groupBy(['sizes.id', 'sizes.name'])
            ->get();
    }

}
