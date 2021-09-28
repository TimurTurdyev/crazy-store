<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'firstname' => [
                'required',
                'string',
                'max:64'
            ],
            'lastname' => [
                'required',
                'string',
                'max:64'
            ],
            'email' => [
                'required',
                'email:rfc,dns',
                'max:128'
            ],
            'phone' => [
                'required',
                'string',
                'max:32'
            ],
            'post_code' => [
                'required',
                'string'
            ],
            'delivery_code' => [
                'required',
                'string'
            ],
            'delivery_value' => [
                'required',
                'integer'
            ],
            'delivery_name' => [
                'required',
                'string'
            ],
            'notes' => [
                'nullable',
                'string',
            ],
            'payment_code' => [
                'nullable',
                'string'
            ],
            'promo_value' => [
                'nullable',
                'integer'
            ]
        ];
    }
}
