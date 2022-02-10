<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CouponRequest extends FormRequest
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
            'code' => ['required', 'unique:coupons'],
            'price' => ['required'],
            'status' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'عنوان کدتخفیف را وارد کنید',
            'code.required' => 'کدتخفیف را وارد کنید',
            'code.unique' => 'کدتخفیف وارد شده تکراری است',
            'price.required' => 'قیمت کدتخفیف را وارد کنید',
            'status.required' => 'وضعیت کدتخفیف را انتخاب کنید'
        ];
    }
}
