@extends('admin.layouts.app')

@section('title')
    افزودن ویژگی جدید
@endsection

@section('content')
    @include('admin.partials.errors')
    <form class="form-horizontal" method="post" action="{{route('attributesGroup.store')}}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="title" class="col-sm-2 control-label">عنوان ویژگی</label>

                <div class="col-sm-10">
                    <input type="text" name="title" class="form-control" id="inputEmail3" placeholder="عنوان دسته بندی را وارد کنید ">
                </div>
            </div>
            <div class="form-group">
                <label for="type">نوع ویژگی</label>
                <div class="col-sm-10">
                    <select name="type" id="" class="form-control">
                        <option value="select">تکی</option>
                        <option value="multiple">چندتایی</option>
                    </select>
                </div>
            </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-info">ذخیره</button>
        </div>
        <!-- /.card-footer -->
    </form>
@endsection
