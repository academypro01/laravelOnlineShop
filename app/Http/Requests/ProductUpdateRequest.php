<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'slug' => ['required'],
            'category_id' => ['required'],
            'brand_id' => ['required'],
            'selected_attributes' => ['required'],
            'status' => ['required'],
            'price' => ['required'],
            'description' => ['required'],
            'meta_title' => ['required'],
            'meta_desc' => ['required'],
            'meta_keywords' => ['required'],
            'photo_id' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'عنوان محصول را وارد کنید',
            'slug.required' => 'نام مستعار محصول را وارد کنید',
            'description.required' => 'توضیحات محصول را وارد کنید',
            'category_id.required' => 'دسته بندی محصول را انتخاب کنید',
            'brand_id.required' => 'برند محصول را انتخاب کنید',
            'selected_attributes.required' => 'ویژگی های محصول را انتخاب کنید',
            'status.required' => 'وضعیت محصول را انتخاب کنید',
            'price.required' => 'قیمت محصول را انتخاب کنید',
            'meta_title.required' => 'عنوان سئو را انتخاب کنید',
            'meta_desc.required' => 'توضیحات سئو را وارد کنید',
            'meta_keywords.required' => 'کلمات کلیدی را وارد کنید',
            'photo_id.required' => 'برای محصول خود حداقل یک تصویر انتخاب کنید'
        ];
    }
}
