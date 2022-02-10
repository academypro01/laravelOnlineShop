@extends('admin.layouts.app')

@section('title')
    ویرایش مقدار: {{$attributeValue->title}}
@endsection

@section('content')
    @include('admin.partials.errors')
    <form class="form-horizontal" method="post" action="{{route('attributesValue.update', $attributeValue->id)}}">
        @csrf
        <input type="hidden" name="_method" value="PATCH">
        <div class="card-body">
            <div class="form-group">
                <label for="title" class="col-sm-2 control-label">مقدار ویژگی</label>

                <div class="col-sm-10">
                    <input value="{{$attributeValue->title}}" type="text" name="title" class="form-control" id="inputEmail3" placeholder="عنوان مقدار ویژگی را وارد کنید ">
                </div>
            </div>
            <div class="form-group">
                <label for="type">ویژگی والد</label>
                <div class="col-sm-10">
                    <select name="attributeGroup_id" id="" class="form-control">
                        @foreach($attributesGroup as $attributeGroup)
                            <option {{($attributeGroup->id == $attributeValue->attributeGroup->id) ? 'selected' : ''}} value="{{$attributeGroup->id}}">{{$attributeGroup->title}}</option>
                        @endforeach
                    </select>
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
