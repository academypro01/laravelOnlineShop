@extends('admin.layouts.app')

@section('title')
    افزودن نقش جدید
@endsection


@section('content')
    @include('admin.partials.errors')
    <form class="form-horizontal" method="post" action="{{route('roles.update', $role->id)}}">
        @csrf
        <input type="hidden" name="_method" value="PATCH">
        <div class="card-body">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">عنوان نقش</label>

                <div class="col-sm-10">
                    <input value="{{$role->name}}" type="text" name="name" class="form-control" id="inputEmail3" placeholder="عنوان نقش را وارد کنید ">
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-info">بروزرسانی</button>
        </div>
        <!-- /.card-footer -->
    </form>
@endsection
