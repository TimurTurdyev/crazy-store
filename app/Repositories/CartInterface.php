<?php


namespace App\Repositories;


use App\Models\Cart;
use Illuminate\Support\Collection;

interface CartInterface
{
    public function getProductPriceTotal(): int;

    public function getProductDiscountTotal(): int;

    public function getProductSumIfNotDiscount(): int;

    public function getCount(): int;

    public function add(int $price_id, int $quantity): Cart;

    public function update(int $id, int $price_id, int $quantity): Cart;

    public function clearCache(): void;

    public function getItems(): Collection;

    public function validateQuantity(): Collection;

    public function setPromoCode($code): void;

    public function promoCodeRemove(): void;

    public function promoCode(): null|object;

    public function remove($id): void;

    public function destroyCart(): void;
}
