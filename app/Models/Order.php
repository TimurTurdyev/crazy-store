<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $guarded = ['id'];
    protected $fillable = [
        'order_code', 'status',
        'user_id', 'ip', 'firstname', 'lastname', 'email', 'phone',
        'item_count', 'sub_total', 'promo_value', 'delivery_value', 'total', 'promo_code',
        'delivery_code', 'delivery_status', 'delivery_name',
        'payment_code', 'payment_status', 'payment_name',
        'city', 'address', 'post_code', 'notes',
        'created_at', 'updated_at'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function getStatusAttribute($value): string
    {
        if ($this->delivery_status === 'decline' || $this->payment_status === 'decline') {
            return 'Отменен';
        }

        if ($this->delivery_status === 'processing' || $this->payment_status === 'processing') {
            return 'В процессе';
        }

        if ($this->delivery_status === 'pending' || $this->payment_status === 'pending') {
            return 'Создан';
        }

        return 'Завершен';
    }

    public function getDeliveryAttribute(): array
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

    public function getPaymentsAttribute() {
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
