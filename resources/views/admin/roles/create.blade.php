@extends('admin.layouts.app')

@section('title')
    افزودن نقش جدید
@endsection


@section('content')
    @include('admin.partials.errors')
    <form class="form-horizontal" method="post" action="{{route('roles.store')}}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">عنوان نقش</label>

                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" id="inputEmail3" placeholder="عنوان نقش را وارد کنید ">
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
