<?php

namespace App\Models;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VariantPrice extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public $timestamps = false;
    protected $hidden = ['cost'];

    protected $appends = ['stock', 'discount_price'];

    protected $fillable = ['variant_id', 'size_id', 'price', 'cost', 'quantity', 'discount'];

    protected $casts = [
        'quantity' => 'integer',
        'discount' => 'integer',
    ];

    public function getStockAttribute(): string
    {
        return $this->quantity ? 'В наличии' : 'Закончился';
    }

    public function getDiscountPriceAttribute(): int
    {
        if ($this->discount && $this->price) {
            $discountPrice = $this->price - ($this->price / 100 * $this->discount);
            return ($discountPrice ?: 0) > $this->price ? $this->price : $discountPrice;
        }

        return $this->price ?? 0;
    }

    public function size(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Size::class);
    }

    public function variant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Variant::class);
    }
}
