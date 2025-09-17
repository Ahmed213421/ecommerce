<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'pageIcon' => ['image', 'nullable'],
            'logo' => ['image', 'nullable'],
            'email' => ['email', 'email:filter', 'unique:settings,email,' . $this->route('setting')],
            'phone' => ['regex:/^\d{11}$/'],
            'description_en' => ['required', 'string'],
            'description_ar' => ['required', 'string'],
            'hours_working_en' => ['required', 'string'],
            'hours_working_ar' => ['required', 'string'],
            'whoweare_en' => ['required', 'string'],
            'whoweare_ar' => ['required', 'string'],
            'tax_rate' => ['required', 'string'],
            'map' => ['nullable', 'string'],
            'address_en' => ['nullable', 'string'],
            'address_ar' => ['nullable', 'string'],
            'fb' => ['nullable', 'string'],
            'li' => ['nullable', 'string'],
            'tw' => ['nullable', 'string'],
            'ins' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function validated($key = null, $default = null): array
    {
        $data = parent::validated($key, $default);

        return [
            'description' => [
                'en' => $data['description_en'],
                'ar' => $data['description_ar'],
            ],
            'hours_working' => [
                'en' => $data['hours_working_en'],
                'ar' => $data['hours_working_ar'],
            ],
            'whoweare' => [
                'en' => $data['whoweare_en'],
                'ar' => $data['whoweare_ar'],
            ],
            'pageIcon' => $data['pageIcon'] ?? null,
            'logo' => $data['logo'] ?? null,
            'email' => $data['email'],
            'phone' => $data['phone'],
            'tax_rate' => $data['tax_rate'],
            'map' => $data['map'] ?? null,
            'address' => [
                'en' => $data['address_en'] ?? null,
                'ar' => $data['address_ar'] ?? null,
            ],
            'fb' => $data['fb'] ?? null,
            'li' => $data['li'] ?? null,
            'tw' => $data['tw'] ?? null,
            'ins' => $data['ins'] ?? null,
            'description' => $data['description'] ?? null,
        ];
    }
}
