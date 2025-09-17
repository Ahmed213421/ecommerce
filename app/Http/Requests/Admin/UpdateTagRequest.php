<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTagRequest extends FormRequest
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
        ];
    }
}
