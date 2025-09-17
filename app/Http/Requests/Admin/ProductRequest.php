<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name_en' => 'required',
            'name_ar' => 'required',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'quantity' => 'numeric|min:0|max:100',
            'subcategory_id' => 'required|exists:subcategories,id',
            'imagepath' => 'required|image',
            'images.*' => 'image|nullable',
        ];
    }

    public function validated($key = null, $default = null): array
    {
        $data = parent::validated($key, $default);

        return [
            'name' => [
                'en' => $data['name_en'],
                'ar' => $data['name_ar'],
            ],
            'description' => [
                'en' => $data['description_en'],
                'ar' => $data['description_ar'],
            ],
            'price' => $data['price'],
            'discount_percentage' => $data['discount'] ?? 0,
            'quantity' => $data['quantity'] ?? 1,
            'imagepath' => $data['imagepath'],
            'subcategory_id' => $data['subcategory_id'],
            'slug' => $data['slug'] ?? \Str::slug($data['name_en']),
        ];
    }
}
