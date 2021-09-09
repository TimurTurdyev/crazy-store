<?php

namespace App\Http\Controllers\Admin;

use App\Filters\ProductFilters;
use App\Http\Controllers\Controller;
use App\Models\Variant;
use Illuminate\Http\Request;


class PriceController extends Controller
{
    public function filter(Request $request): \Illuminate\Http\JsonResponse
    {
        $prices = [];

        $products = Variant::filter(new ProductFilters($request->only(['name'])))
            ->where('variant_prices.quantity', '>=', 0)
            ->with(['prices.size', 'photos'])
            ->limit(12)
            ->get();

        foreach ($products as $variant) {
            foreach ($variant->prices->where('quantity', '>', 0) as $price) {
                $name = rtrim(rtrim($variant->variant_name, ', ') . ', ' . (string)$price?->size?->name, ', ');

                $photo = $variant->photos->first();
                $prices[] = [
                    'name' => $name,
                    'value' => $price->id,
                    'data' => [
                        //        "id" => 12
                        //        "order_id" => 7
                        //        "product_id" => 253
                        //        "variant_id" => 253
                        //        "price_id" => 450
                        //        "name" => "Боди с коротким рукавом Кот, 62"
                        //        "price_old" => 320
                        //        "price" => 320
                        //        "quantity" => 1
                        //        "photo" => "http://127.0.0.1:8000/storage/catalog/kogankids/902.jpg"
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
