<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VariantRequest extends FormRequest
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
            'short_name' => 'required|max:64',
            'sku' => 'required|max:32',
            'variants.*.variant_id' => 'required|numeric',
            'variants.*.size_id' => 'required|numeric',
            'variants.*.price' => 'required|numeric',
            'variants.*.cost' => 'required|numeric',
            'variants.*.quantity' => 'required|numeric',
            'variants.*.discount' => 'required|numeric',
        ];
    }
}
