@extends('admin.layouts.app')

@section('title')
   افزودن کدتخفیف جدید
@endsection

@section('content')
    @include('admin.partials.errors')
    <form class="form-horizontal" method="post" action="{{route('coupons.store')}}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="title" class="col-sm-2 control-label">عنوان کدتخفیف</label>
                <div class="col-sm-10">
                    <input type="text" name="title" class="form-control" id="title" placeholder="عنوان کدتخفیف را وارد کنید ">
                </div>
            </div>
            <div class="form-group">
                <label for="code" class="col-sm-2 control-label">کدتخفیف</label>
                <div class="col-sm-10">
                    <input type="text" name="code" class="form-control" id="code" placeholder=" کدتخفیف را وارد کنید ">
                </div>
            </div>
            <div class="form-group">
                <label for="price" class="col-sm-2 control-label">قیمت</label>
                <div class="col-sm-10">
                    <input type="number" name="price" class="form-control" id="price" placeholder="قیمت کدتخفیف را وارد کنید ">
                </div>
            </div>
            <div class="form-group">
                <label for="status" class="col-sm-2 control-label">وضعیت</label>
                <select name="status" id="status" class="form-control col-sm-10">
                    <option value="0">منقضی</option>
                    <option value="1">فعال</option>
                </select>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-info">ذخیره</button>
        </div>
        <!-- /.card-footer -->
    </form>
@endsection
