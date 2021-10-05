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
        'item_count', 'sub_total', 'total',
        'promo_code', 'promo_value',
        'delivery_code', 'delivery_name', 'delivery_value',
        'payment_code',
        'city', 'address', 'post_code',
        'created_at', 'updated_at'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function getNoteAttribute(): string
    {
        $note = $this->histories()->where('message')->first();
        return $note ?: '---';
    }

    #[ArrayShape(['pending' => "string", 'processing' => "string", 'completed' => "string", 'decline' => "string"])] public function getStatusesAttribute(): array
    {
        return [
            'pending' => 'Ожидание',
            'processing' => 'В процессе',
            'completed' => 'Завершен',
            'decline' => 'Отменен'
        ];
    }

    #[ArrayShape(['message' => "string", 'delivery' => "string", 'payment' => "string"])] public function getCodesAttribute(): array
    {
        return [
            'message' => 'Сообщение',
            'delivery' => 'Доставка',
            'payment' => 'Оплата'
        ];
    }

    #[Pure] public function getDeliveryAttribute(): array
    {
        if (Str::contains($this->delivery_code, 'cdek.pvz')) {
            return [
                'name' => 'CDEK ПВЗ',
                'address' => $this->delivery_name,
                'value' => $this->delivery_value,
            ];
        }

        return [
            'name' => $this->delivery_name,
            'address' => $this->post_code ? $this->post_code . ', ' . $this->address : $this->address,
            'value' => $this->delivery_value,
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
        return $this->hasMany(OrderHistory::class);
    }
}
