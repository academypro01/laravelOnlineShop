<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => ['required'],
            'meta_desc' => ['required'],
            'meta_title' => ['required'],
            'meta_keywords' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'نام دسته بندی الزامیست',
            'meta_desc.required' => 'توضیحات متا الزامیست',
            'meta_title.required' => 'عنوان متا الزامیست',
            'meta_keywords.required' => 'کلمات کلیدی متا الزامیست'
        ];
    }
}
