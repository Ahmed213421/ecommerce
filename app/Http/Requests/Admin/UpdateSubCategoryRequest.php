<?php

namespace App\Http\Requests\Admin;

use App\Models\Subcategory;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSubCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name_en' => ['required', 'string'],
            'name_ar' => ['required', 'string'],
            'category_id' => ['exists:categories,id'],
            'simage' => ['nullable', 'image'],
        ];
    }

    public function validated($key = null, $default = null): array
    {
        $data = parent::validated($key, $default);
        $subcategory = Subcategory::find($this->route('subcategory'));

        if ($this->hasFile('simage')) {
            $data['imagepath'] = 'dashboard/' . $this->simage->storeAs('subcategory', time() . '_' . $this->simage->getClientOriginalName(), 'images');
        } else {
            $data['imagepath'] = $subcategory->imagepath;
        }

        return [
            'name' => [
                'en' => $data['name_en'],
                'ar' => $data['name_ar']
            ],
            'category_id' => $data['category_id'],
            'imagepath' => $data['imagepath'],
            'slug' => \Illuminate\Support\Str::slug($data['name_en'])
        ];
    }
}
