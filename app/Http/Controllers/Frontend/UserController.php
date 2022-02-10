<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Models\Address;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function register(UserRegisterRequest $request)
    {

        $user = new User();

        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->national_code = $request->national_code;
        $user->password = Hash::make($request->password);
        $user->save();

        $address = new Address();

        $address->company = $request->company;
        $address->address = $request->address;
        $address->post_code = $request->post_code;
        $address->province_id = $request->province_id;
        $address->city_id = $request->city_id;
        $address->user_id = $user->id;
        $address->save();

        $role = Role::where('name','کاربر')->first()->id;

        $user->roles()->sync([$role]);

        Session::flash('created','شما با موفقیت ثبت نام شدید');
        return redirect(route('login'));


    }
}
