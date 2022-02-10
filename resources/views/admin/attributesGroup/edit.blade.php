@extends('admin.layouts.app')

@section('title')
    ویرایش ویژگی: {{$attributeGroup->title}}
@endsection

@section('content')
    @include('admin.partials.errors')
    <form class="form-horizontal" method="post" action="{{route('attributesGroup.update', $attributeGroup->id)}}">
        @csrf
        <input type="hidden" name="_method" value="PATCH">
        <div class="card-body">
            <div class="form-group">
                <label for="title" class="col-sm-2 control-label">عنوان ویژگی</label>

                <div class="col-sm-10">
                    <input value="{{$attributeGroup->title}}" type="text" name="title" class="form-control" id="inputEmail3" placeholder="عنوان دسته بندی را وارد کنید ">
                </div>
            </div>
            <div class="form-group">
                <label for="type">نوع ویژگی</label>
                <div class="col-sm-10">
                    <select name="type" id="" class="form-control">
                        <option {{($attributeGroup->type == 'select') ? 'selected' : ''}} value="select">تکی</option>
                        <option {{($attributeGroup->type == 'multiple') ? 'selected' : ''}} value="multiple">چندتایی</option>
                    </select>
                </div>
            </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-info">بروز رسانی</button>
        </div>
        <!-- /.card-footer -->
    </form>
@endsection
