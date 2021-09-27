<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';
    protected $guarded = ['id'];
    protected $fillable = ['order_id', 'product_id', 'variant_id', 'price_id', 'name', 'photo', 'price_old', 'price', 'quantity'];
    protected $casts = ['price' => 'integer', 'price_old' => 'integer', 'quantity' => 'integer'];

    public $timestamps = false;

    public function variant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Variant::class, 'variant_id', 'id');
    }

    public function variantPrice(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(VariantPrice::class, 'price_id', 'id');
    }
}
