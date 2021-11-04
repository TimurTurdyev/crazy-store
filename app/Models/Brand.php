<?php

namespace App\Models;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public $timestamps = false;

    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function description(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(Description::class, 'entity')->withDefault();
    }

    public function groups(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class)
            ->join('groups', 'products.group_id', '=', 'groups.id')
            ->groupBy('groups.id');
    }

    public function scopeFilter(Builder $builder, FilterAbstract $filters): Builder
    {
        return $filters->apply(
            $builder
                ->select(['brands.id', 'brands.name'])
                ->join('products', 'brands.id', '=', 'products.brand_id')
                ->join('variants', 'products.id', '=', 'variants.product_id')
                ->join('variant_prices', 'variants.id', '=', 'variant_prices.variant_id')
                ->where('products.status', '=', 1)
                ->where('variants.status', '=', 1)
                ->where('variant_prices.quantity', '>', 0)
                ->groupBy(['brands.id', 'brands.name'])
        );
    }
}
