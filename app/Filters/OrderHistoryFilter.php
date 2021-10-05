<?php

namespace App\Filters;

use Illuminate\Support\Facades\DB;

class OrderHistoryFilter extends FilterAbstract
{
    public function code($code = null)
    {
        if ($code) {
            $this->builder->whereIn('order_histories.code', $this->paramToArray($code));
        }
    }
}
