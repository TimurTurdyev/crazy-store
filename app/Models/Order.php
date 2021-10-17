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
        'payment_code', 'payment_instruction',
        'city', 'address', 'post_code',
        'created_at', 'updated_at'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function getStatusAttribute() {
        $selected = $this->histories()->first()?->status;

        return config('main.order')[$selected] ?? '-';
    }

    #[Pure] public function getDeliveryAttribute(): array
    {
        if (Str::contains($this->delivery_code, 'cdek.pvz')) {
            return [
                'name' => 'CDEK ПВЗ',
                'address' => $this->delivery_method,
            ];
        }

        return [
            'name' => $this->delivery_method,
            'address' => $this->post_code ? $this->post_code . ', ' . $this->address : $this->address,
        ];
    }

    #[Pure] public function getPaymentNameAttribute(): string
    {
        return $this->getPaymentsAttribute()[$this->payment_code] ?? '---';
    }

    #[ArrayShape(['sber.card' => "string", 'tinkoff.pay' => "string"])] public function getPaymentsAttribute(): array
    {
        return [
            'sber.card' => 'Оплата на карту сбербанка',
            'tinkoff.pay' => 'Онлайн оплата'
        ];
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
