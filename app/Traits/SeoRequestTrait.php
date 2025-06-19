<?php

namespace App\Traits;

trait SeoRequestTrait
{
    /**
     * Get the validation rules that apply to the meta request.
     *
     * @return array<string, mixed>
     */
    protected function seoRules(): array
    {
        return [
            'meta.meta_title' => ['nullable', 'string', 'max:60'],
            'meta.meta_description' => ['nullable', 'string', 'max:160'],
            'meta.og_title' => ['nullable', 'string', 'max:60'],
            'meta.og_description' => ['nullable', 'string', 'max:160'],
            'meta.og_alt' => ['nullable', 'string', 'max:125'],
            'meta.header_code' => ['nullable', 'string'],
            'meta.body_code' => ['nullable', 'string'],
            'meta.footer_code' => ['nullable', 'string'],
        ];
    }

    /**
     * Get the validation messages for meta fields.
     *
     * @return array<string, string>
     */
    protected function seoMessages(): array
    {
        return [
            'meta.meta_title.max' => 'The meta title should be no longer than 60 characters for better meta.',
            'meta.meta_description.max' => 'The meta description should be no longer than 160 characters to ensure proper display in search results.',
            'meta.og_title.max' => 'The Open Graph title should be no longer than 60 characters to display correctly on social media.',
            'meta.og_description.max' => 'The Open Graph description should not exceed 160 characters to ensure proper visibility.',
            'meta.og_alt.max' => 'The alternative text should be no longer than 125 characters for better accessibility.',
            'meta.meta_image.image' => 'Please upload a valid image file for the meta image.',
            'meta.meta_image.mimes' => 'The meta image must be in JPEG, PNG, or JPG format.',
            'meta.meta_image.max' => 'The meta image size should not exceed 2MB.',
        ];
    }

    /**
     * Get meta data from the request.
     *
     * @return array<string, mixed>
     */
    protected function getSeoData(): array
    {
        return $this->only([
            'meta.meta_title',
            'meta.meta_description',
            'meta.meta_image',
            'meta.header_code',
            'meta.body_code',
            'meta.footer_code',
        ]);
    }
}
