@extends('frontend.layouts.app')

@section('content')
    <div class="row">
        <aside id="column-right" class="col-sm-3 hidden-xs">
            <h3 class="subtitle">حساب کاربری</h3>
            <div class="list-group">
                <ul class="list-item">
                    <li><a href="#">حساب کاربری</a></li>
                    <li><a href="#">لیست آدرس ها</a></li>
                    <li><a href="wishlist.html">لیست علاقه مندی</a></li>
                    <li><a href="#">تاریخچه سفارشات</a></li>
                    <li><a href="#">دانلود ها</a></li>
                    <li><a href="#">امتیازات خرید</a></li>
                    <li><a href="#">بازگشت</a></li>
                    <li><a href="#">تراکنش ها</a></li>
                    <li><a href="#">پرداخت های تکرار شونده</a></li>
                </ul>
            </div>
        </aside>
        <main id="column-left" class="col-sm-9">
            <div class="alert alert-success">
                {{\Illuminate\Support\Facades\Auth::user()->name." ".\Illuminate\Support\Facades\Auth::user()->last_name.' '}} عزیز ، به پنل کاربری خود خوش آمدید
            </div>
        </main>
    </div>
@endsection
