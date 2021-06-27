<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public $timestamps = false;

    public function groups(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'category_group');
    }

    public function description(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(Description::class, 'entity')->withDefault();
    }
}
