<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        if ($this->request->has('description') && !empty($this->request->get('description')['id'])) {
            $description = ',' . $this->request->get('description')['id'];
        } else {
            $description = '';
        }

        return [
            'name' => ['required', 'max:96'],
            'description.heading' => ['required', 'max:128', 'unique:descriptions,heading' . $description],
            'description.meta_title' => ['nullable', 'max:255'],
            'description.preview' => ['nullable', 'max:255'],
            'description.body' => ['nullable'],
        ];
    }
}
