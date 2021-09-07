<?php

namespace App\Http\Requests\Catalog;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

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
                'string',
                function ($attribute, $value, $fail) {
                    $delivery = session('deliveries', collect())->firstWhere('code', $value);
                    if (!$delivery) {
                        $fail('Способ доставки не найден. Убедитесь что вы выбрали нужный способ доставки');
                    }
                }
            ],
            'notes' => [
                'nullable',
                'string',
            ]
        ];
    }

    public function messages()
    {
        return [
            'firstname.required' => 'Имя обязательно',
            'lastname.required' => 'Фамилия обязательна',
            'email.required' => 'Email обязателен',
            'phone.required' => 'Телефон обязателен',
            'post_code.required' => 'Индекс нужен для расчета доставки. Попробуйте дописать в адрес дом.',
            'delivery_code.required' => 'Ни один способ доставки не был выбран. Проверьте адрес и выберите доставку.',
        ];
    }
}
