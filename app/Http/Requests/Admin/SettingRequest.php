<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'email' => ['email', 'email:filter', 'unique:settings,email'],
            'phone' => ['nullable', 'regex:/^\d{11}$/'],
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
}
