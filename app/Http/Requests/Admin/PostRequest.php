<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title_en' => 'required|string',
            'title_ar' => 'required|string',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'imagepath' => 'required|image',
            'subcategory_id' => 'required|exists:subcategories,id',
            'slug' => 'nullable|unique:posts,slug',
        ];
    }

    public function validated($key = null, $default = null): array
    {
        $data = parent::validated($key, $default);


        $data['admin_id'] = auth('admin')->id();

        return [
        'title' => [
            'en' => $data['title_en'],
            'ar' => $data['title_ar'],
            ],
            'description' => [
                'en' => $data['description_en'],
                'ar' => $data['description_ar'],
            ],
            'imagepath' => $data['imagepath'] ?? null,
            'subcategory_id' => $data['subcategory_id'],
            'slug' => $data['slug'] ?? \Str::slug($data['title_en']),
            'admin_id' => $data['admin_id'],
        ];
    }
}
