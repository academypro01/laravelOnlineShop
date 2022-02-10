<?php

namespace App\Http\Requests;

use App\Rules\nationalCodeRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRegisterRequest extends FormRequest
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
            'last_name' => ['required'],
            'email' => ['required','unique:users'],
            'phone' => ['required', 'unique:users','numeric','regex: /09(1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}/i'],
            'national_code' => ['required', 'unique:users','digits:10',new nationalCodeRule()],
            'address' => ['required'],
            'post_code' => ['required','digits:10'],
            'province_id' => ['required','numeric'],
            'city_id' => ['required','numeric'],
            'password' => ['required','confirmed',Password::min(9)->letters()],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'نام را وارد کنید',
            'last_name.required' => 'نام خانوادگی را وارد کنید',
            'email.required' => 'ایمیل را وارد کنید',
            'email.unique' => 'ایمیل تکراری میباشد',
            'phone.required' => 'شماره تلفن همراه خود را وارد کنید',
            'phone.unique' => 'شماره تلفن وارد شده تکراری میباشد',
            'phone.numeric' => 'شماره تلفن فقط باید شامل عدد باشد',
            'phone.regex' => 'ساختار شماره تلفن صحیح نیست',
            'national_code.required' => 'کدملی را وارد کنید',
            'national_code.unique' => 'کدملی تکراری میباشد',
            'national_code.digits' => 'کدملی فقط باید شامل عدد باشد',
            'address.required' => 'آدرس را وارد کنید',
            'post_code.required' => 'کدپستی را وارد کنید',
            'post_code.digits' => 'کدپستی باید فقط عدد باشد',
            'province_id.required' => 'استان خود را انتخاب کنید',
            'province_id.numeric' => 'لطفا از لیست استان را انتخاب نمایید',
            'city_id.required' => 'شهر خود را انتخاب نمایید',
            'city_id.numeric' => 'لطفا از لیست شهر را انتخاب نمایید',
            'password.required' => 'پسورد را وارد نمایید',
            'password.confirmed' => 'پسوردها با یکدیگر یکسان نیست',
            'password.min' => 'حداقل طول برای پسورد 9 کاراکتر است',
            'password.letter' => 'حتما باید از یک حرف انگلیسی در ساختار پسورد استفاده کنید'
        ];
    }
}
