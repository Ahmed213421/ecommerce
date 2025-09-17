<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;


class CategoryRequest extends FormRequest
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
        'imagepath' => 'image',
        'category_id' => 'nullable|exists:categories,id',
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
            'imagepath' => $data['imagepath'] ?? null,
            'slug' => Str::slug($data['name_en']),
            'category_id' => $data['category_id'] ?? null,
        ];
    }

}
