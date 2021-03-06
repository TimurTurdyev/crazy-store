<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public $timestamps = false;

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class)->withDefault(['name' => '']);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class)->withDefault(['name' => '']);
    }

    public function brands(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Brand::class);
    }

    public function variant(): HasOne
    {
        return $this->hasOne(Variant::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(Variant::class);
    }

    public function description(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(Description::class, 'entity')->withDefault();
    }
}
