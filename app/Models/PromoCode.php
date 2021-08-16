<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PromoCode extends Model
{
    use HasFactory;

    protected $table = 'promo_codes';
    protected $guarded = ['id'];

    public function discountPrice(int $value = 0): int
    {
        if (!$value || !$this->discount) {
            return 0;
        }

        if ($this->type === 'P') {
            return -(int)($value / 100 * $this->discount);
        }

        return -(int)($value - $this->discount);
    }

    public function validateMessage($code = ''): string
    {
        if (!is_string($code)) {
            return 'Промокод не валиден!';
        }

        $code = $code ? ' ' . $code : $code;

        if ($this->id === null) {
            return sprintf('Промокод%s. Не действителен!', $code);
        }
        if ($this->logged && Auth::id()) {
            return sprintf('Что-бы применить промокод%s. Авторизуйтесь!', $code);
        }

        if (!$this->dateStartValidate() || !$this->dateEndValidate()) {
            return sprintf('Истек срок использования промокода%s', $code);
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
