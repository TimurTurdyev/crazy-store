<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_history extends Model
{
    use HasFactory;

    protected $table = 'order_histories';
    protected $guarded = ['id'];
}
