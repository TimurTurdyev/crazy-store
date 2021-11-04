<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $guarded = ['id'];
    protected $fillable = [
        'order_code',
        'user_id', 'ip', 'firstname', 'lastname', 'email', 'phone',
        'payment_code',
        'city', 'address', 'post_code',
        'created_at', 'updated_at'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function getStatusAttribute()
    {
        $selected = $this->histories()->first()?->status;

        return config('main.order.' . $selected, '-');
    }

    public function getPaymentProcessingAttribute(): bool
    {
        $selected = $this->histories()->first();

        if ($selected === null || config('main.payment_processing') == $selected->status) {
            return true;
        }

        return false;
    }

    public function getPaymentNameAttribute(): string
    {
        return config('main.payments.' . $this->payment_code, '-');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function histories(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrderHistory::class)->orderByDesc('id');
    }

    public function totals(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrderTotal::class)->orderBy('sort_order');
    }
}
