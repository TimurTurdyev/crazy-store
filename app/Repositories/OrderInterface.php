<?php

namespace App\Repositories;

use App\Models\Order;

interface OrderInterface
{
    public function storeOrderDetails($params): null|Order;
}
