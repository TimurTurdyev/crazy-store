<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    use HasFactory;

    protected $table = 'order_histories';
    protected $guarded = ['id'];
    protected $fillable = ['notify', 'message', 'created_at', 'updated_at'];
}
