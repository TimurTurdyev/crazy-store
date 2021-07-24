<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupons';
    protected $guarded = ['id'];

    public function discountPrice(int $value = 0): int
    {
        if (!$value || !$this->discount) {
            return 0;
        }

        if ($this->type === 'P') {
            return $value / 100 * $this->discount;
        }

        return $value - $this->discount;
    }

    public function validateMessage($code = ''): string
    {
        if (!is_string($code)) {
            return 'Не валидный код купона!';
        }

        $code = $code ? ' ' . $code : $code;

        if ($this->id === null) {
            return sprintf('Код купона%s. Не действителен!', $code);
        }
        if ($this->logged && Auth::id()) {
            return sprintf('Что-бы применить код купона%s. Авторизуйтесь!', $code);
        }

        if (!$this->dateStartValidate() || !$this->dateEndValidate()) {
            return sprintf('Истек срок использования купона%s', $code);
        }
        return '';
    }

    private function dateStartValidate(): bool
    {
        if (!$this->date_start) {
            return true;
        }
        return $this->date_start < Carbon::now()->timestamp;
    }

    private function dateEndValidate(): bool
    {
        if (!$this->date_end) {
            return true;
        }
        return $this->date_end > Carbon::now()->timestamp;
    }
}
