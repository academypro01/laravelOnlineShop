@extends('admin.layouts.app')

@section('title')
   ویرایش کدتخفیف: {{$coupon->title}}
@endsection

@section('content')
    @include('admin.partials.errors')
    <form class="form-horizontal" method="post" action="{{route('coupons.update', $coupon->id)}}">
        @csrf
        <input type="hidden" name="_method" value="PATCH">
        <div class="card-body">
            <div class="form-group">
                <label for="title" class="col-sm-2 control-label">عنوان کدتخفیف</label>
                <div class="col-sm-10">
                    <input value="{{$coupon->title}}" type="text" name="title" class="form-control" id="title" placeholder="عنوان کدتخفیف را وارد کنید ">
                </div>
            </div>
            <div class="form-group">
                <label for="code" class="col-sm-2 control-label">کدتخفیف</label>
                <div class="col-sm-10">
                    <input type="text" value="{{$coupon->code}}" name="code" class="form-control" id="code" placeholder=" کدتخفیف را وارد کنید ">
                </div>
            </div>
            <div class="form-group">
                <label for="price" class="col-sm-2 control-label">قیمت</label>
                <div class="col-sm-10">
                    <input type="number" value="{{$coupon->price}}" name="price" class="form-control" id="price" placeholder="قیمت کدتخفیف را وارد کنید ">
                </div>
            </div>
            <div class="form-group">
                <label for="status" class="col-sm-2 control-label">وضعیت</label>
                <select name="status" id="status" class="form-control col-sm-10">
                    <option value="0" {{ ($coupon->status == 0) ? 'selected' : '' }}>منقضی</option>
                    <option value="1" {{ ($coupon->status == 1) ? 'selected' : '' }}>فعال</option>
                </select>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-info">بروزرسانی</button>
        </div>
        <!-- /.card-footer -->
    </form>
@endsection
