<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Description extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function entity(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    public function getBodyHtmlAttribute() {
        if ($this->body) {
            return Str::markdown($this->body);
        }
        return '';
    }
}
