<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'main_title' => ['required', 'string'],
            'branch_title' => ['required', 'string'],
            'image' => ['required', 'image'],
        ];
    }

    public function validated($key = null, $default = null): array
    {
        $data = parent::validated($key, $default);

        if ($this->hasFile('image')) {
            $data['imagepath'] = 'dashboard/' . $this->image->storeAs('slider', time() . '_' . $this->image->getClientOriginalName(), 'images');
        }

        return [
            'main_title' => $data['main_title'],
            'branch_title' => $data['branch_title'],
            'imagepath' => $data['imagepath'],
        ];
    }
}
