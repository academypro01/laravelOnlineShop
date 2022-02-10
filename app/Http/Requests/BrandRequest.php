<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required'],
            'description' => ['required'],
            'photo_id' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'عنوان برند الزامیست',
            'description.required' => 'توضیحات برند الزامیست',
            'photo_id' => 'برای برند خود یک تصویر انتخاب کنید'
        ];
    }
}
