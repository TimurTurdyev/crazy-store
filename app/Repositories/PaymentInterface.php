<?php

namespace App\Repositories;

use App\Models\Order;

interface PaymentInterface
{
    public function message(Order $order): array;
}
