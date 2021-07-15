<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id', 'order_number', 'status', 'total', 'item_count',
        'payment_status', 'payment_method', 'shipping_status', 'shipping_method',
        'firstname', 'lastname', 'address', 'city', 'country', 'post_code', 'phone', 'notes'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
