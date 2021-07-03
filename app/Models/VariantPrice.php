<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantPrice extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public $timestamps = false;
    protected $hidden = ['cost'];

    protected $appends = ['stock', 'discount_price'];

    protected $casts = [
        'quantity' => 'integer',
        'discount' => 'integer',
    ];

    public function getStockAttribute() {
        return $this->quantity ? 'В наличии' : 'Закончился';
    }

    public function getDiscountPriceAttribute()
    {
        if ($this->discount && $this->price) {
            $discountPrice = $this->price - ($this->price / 100 * $this->discount);
            return ($discountPrice ?: 0) > 100 ? 0 : $discountPrice;
        }
        return $this->price;
    }
}
