<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTotal extends Model
{
    use HasFactory;

    protected $table = 'order_totals';

    protected $guarded = ['id'];

    protected $fillable = ['order_id', 'code', 'title', 'value', 'sort_order'];

    public $timestamps = false;
}
