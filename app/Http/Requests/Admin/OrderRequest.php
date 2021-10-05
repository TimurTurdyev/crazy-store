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
            'user_id' => [
                'nullable',
                'exists:App\Models\User,id'
            ],
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
                'nullable',
                'email:rfc,dns',
                'max:128'
            ],
            'phone' => [
                'nullable',
                'string',
                'max:32'
            ],
            'address' => [
                'nullable',
                'string',
                'max:128'
            ],
            'post_code' => [
                'nullable',
                'string'
            ],
            'delivery_code' => [
                'nullable',
                'string'
            ],
            'delivery_value' => [
                'nullable',
                'integer'
            ],
            'delivery_name' => [
                'nullable',
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
