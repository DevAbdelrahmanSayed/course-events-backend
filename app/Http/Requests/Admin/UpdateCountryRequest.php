<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class UpdateCountryRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $countrySlug = $this->route('country')->slug;

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:countries,name',
                Rule::unique('countries', 'name')->ignore($countrySlug, 'slug'),
            ],
            'name_ar' => ['nullable', 'string', 'max:255'],
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
