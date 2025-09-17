<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'description_en' => 'nullable|string|max:255',
            'description_ar' => 'nullable|string|max:255',
            'imagepath' => 'image',
        ];
    }
    public function validated($key = null, $default = null): array
{
    $data = parent::validated();

    return [
        'name' => [
            'en' => $data['name_en'],
            'ar' => $data['name_ar'],
        ],
        'description' => [
            'en' => $data['description_en'],
            'ar' => $data['description_ar'],
        ],
        'imagepath' => $data['imagepath'] ?? null,
    ];
}
}
