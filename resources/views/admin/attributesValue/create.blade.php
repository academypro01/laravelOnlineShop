@extends('admin.layouts.app')

@section('title')
    افزودن مقدار ویژگی جدید
@endsection

@section('content')
    @include('admin.partials.errors')
    <form class="form-horizontal" method="post" action="{{route('attributesValue.store')}}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="title" class="col-sm-2 control-label">مقدار ویژگی</label>

                <div class="col-sm-10">
                    <input type="text" name="title" class="form-control" id="inputEmail3" placeholder="عنوان مقدار ویژگی را وارد کنید ">
                </div>
            </div>
            <div class="form-group">
                <label for="type">ویژگی والد</label>
                <div class="col-sm-10">
                    <select name="attributeGroup_id" id="" class="form-control">
                       @foreach($attributesGroup as $attributeGroup)
                            <option value="{{$attributeGroup->id}}">{{$attributeGroup->title}}</option>
                       @endforeach
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
