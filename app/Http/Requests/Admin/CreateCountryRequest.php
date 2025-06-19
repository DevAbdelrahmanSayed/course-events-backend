<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseFormRequest;

class CreateCountryRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:countries,name'],
            'name_ar' => ['required', 'string', 'max:255'],
            'content' => ['nullable', 'string', 'max:255'],
            'currency' => ['required', 'string', 'max:10'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Country name is required',
            'name.unique' => 'Country name already exists',
            'content.required' => 'Content is required',
            'currency.required' => 'Currency is required',
        ];
    }
}
