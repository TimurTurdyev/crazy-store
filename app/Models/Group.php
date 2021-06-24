<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public $timestamps = false;

    public function description(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(Description::class, 'entity')->withDefault();
    }
}
