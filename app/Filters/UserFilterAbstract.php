<?php

namespace App\Filters;

use Illuminate\Support\Facades\DB;

class UserFilterAbstract extends FilterAbstract
{
    protected function all_fields($value)
    {
        if (is_string($value)) {
            $this->builder->where(DB::raw("REGEXP_REPLACE(CONCAT(users.firstname, '', users.lastname, users.phone, users.email), '[^[:alnum:]]', '')"), 'like', '%' . preg_replace('/[^[:alnum:]]/u', '', $value) . '%');
        }
    }
}
