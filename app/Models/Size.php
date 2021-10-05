<?php

namespace App\Models;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public $timestamps = false;

    public function scopeFilter(Builder $builder, FilterAbstract $filters): Builder
    {
        return $filters->apply(
            $builder
                ->select(['sizes.id', 'sizes.name'])
                ->join('variant_prices', 'sizes.id', '=', 'variant_prices.size_id')
                ->join('variants', 'variant_prices.variant_id', '=', 'variants.id')
                ->join('products', 'variants.product_id', '=', 'products.id')
                ->where('products.status', '=', 1)
                ->where('variants.status', '=', 1)
                ->where('variant_prices.quantity', '>', 0)
                ->groupBy(['sizes.id', 'sizes.name'])
        );
    }
}
