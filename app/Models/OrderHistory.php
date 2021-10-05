<?php

namespace App\Models;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

class OrderHistory extends Model
{
    use HasFactory;

    protected $table = 'order_histories';
    protected $guarded = ['id'];
    protected $fillable = ['order_id', 'notify', 'code', 'status', 'message', 'created_at', 'updated_at'];

    #[ArrayShape(['pending' => "string", 'processing' => "string", 'complete' => "string", 'decline' => "string"])] public function getStatuses(): array
    {
        return [
            'pending' => 'В ожидании',
            'processing' => 'В процессе',
            'complete' => 'Завершен',
            'decline' => 'Отменен',
        ];
    }

    #[Pure] public function getStatusNameAttribute(): string
    {
        return $this->getStatuses()[$this->status] ?? 'pending';
    }

    #[ArrayShape(['message' => "string", 'delivery' => "string", 'payment' => "string"])] public function getCodes(): array
    {
        return [
            'message' => 'Сообщение',
            'delivery' => 'Доставка',
            'payment' => 'Оплата'
        ];
    }

    #[Pure] public function getCodeNameAttribute(): string
    {
        return $this->getCodes()[$this->code] ?? '---';
    }

    public function scopeFilter(Builder $builder, FilterAbstract $filters): Builder
    {
        return $filters->apply($builder);
    }
}
