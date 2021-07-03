<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Variant extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public $timestamps = false;

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function prices(): HasMany
    {
        return $this->hasMany(VariantPrice::class)
            ->leftJoin('sizes', 'variant_prices.size_id', '=', 'sizes.id')
            ->select(['variant_prices.*', 'sizes.name']);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(VariantPhoto::class)->orderBy('sort_order');
    }

    public function scopeFilter(): \Illuminate\Database\Eloquent\Builder
    {
        return $this->newQuery()
            ->select([
                'products.group_id',
                'products.brand_id',
                'groups.name as group_name',
                'variants.id',
                'variants.product_id',
                DB::raw("CONCAT(products.name, ', ', variants.short_name) as variant_name"),
            ])
            ->join('variant_prices', 'variants.id', '=', 'variant_prices.variant_id')
            ->join('products', 'variants.product_id', '=', 'products.id')
            ->join('groups', 'products.group_id', '=', 'groups.id')
            ->groupBy(['products.id', 'variants.id'])
            ->with([
                'photos',
                'prices'
            ]);
    }

}
