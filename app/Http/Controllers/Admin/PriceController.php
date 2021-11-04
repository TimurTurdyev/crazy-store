<?php

namespace App\Http\Controllers\Admin;

use App\Filters\ProductFilter;
use App\Http\Controllers\Controller;
use App\Models\Variant;
use Illuminate\Http\Request;


class PriceController extends Controller
{
    public function filter(Request $request): \Illuminate\Http\JsonResponse
    {
        $prices = [];

        $products = Variant::filter(new ProductFilter($request->only(['name', 'status', 'stock'])))
            ->with(['prices', 'photos'])
            ->limit(12)
            ->get();

        foreach ($products as $variant) {
            foreach ($variant->prices as $price) {
                $name = rtrim(rtrim($variant->variant_name, ', ') . ', ' . (string)$price?->size?->name, ', ');

                $photo = $variant->photos->first();
                $prices[] = [
                    'name' => $name,
                    'value' => $price->id,
                    'data' => [
                        'product_id' => $variant->product_id,
                        'variant_id' => $variant->id,
                        'price_id' => $price->id,
                        'name' => $name,
                        'price_old' => $price->discount_price,
                        'price' => $price->price,
                        'quantity' => 1,
                        'photo' => asset($photo->path),
                        'stock' => $price->quantity
                    ]
                ];
            }
        }

        return response()->json($prices);
    }
}
