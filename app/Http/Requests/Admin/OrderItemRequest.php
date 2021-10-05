<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class OrderItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'prices.*.product_id' => 'required|int',
            'prices.*.variant_id' => 'required|int',
            'prices.*.price_id' => 'required|distinct|int',
            'prices.*.name' => 'required|string',
            'prices.*.photo' => 'required|string',
            'prices.*.price_old' => 'required|int',
            'prices.*.price' => 'required|int',
            'prices.*.quantity' => 'required|int',
        ];
    }
}
