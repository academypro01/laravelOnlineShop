<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeGroupRequest extends FormRequest
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
            'type' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'عنوان ویژگی الزامیست',
            'type.required' => 'نوع ویژگی الزامیست'
        ];
    }
}
