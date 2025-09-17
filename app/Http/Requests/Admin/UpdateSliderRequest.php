<?php

namespace App\Http\Requests\Admin;

use App\Models\Slider;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSliderRequest extends FormRequest
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
            'image' => ['nullable', 'image'],
        ];
    }

    public function validated($key = null, $default = null): array
    {
        $data = parent::validated($key, $default);
        $slider = Slider::find($this->route('slider'));

        if ($this->hasFile('image')) {
            $data['imagepath'] = 'dashboard/' . $this->image->storeAs('slider', time() . '_' . $this->image->getClientOriginalName(), 'images');
        } else {
            $data['imagepath'] = $slider->imagepath;
        }

        return [
            'main_title' => $data['main_title'],
            'branch_title' => $data['branch_title'],
            'imagepath' => $data['imagepath'],
        ];
    }
}
