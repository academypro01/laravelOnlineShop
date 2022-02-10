@extends('admin.layouts.app')

@section('title')
    افزودن ویژگی به دسته بندی: {{$category->name}}
@endsection

@section('content')
    @include('admin.partials.errors')
    <form class="form-horizontal" method="post" action="{{route('categorySettings.update', $category->id)}}">
        @csrf
        <input type="hidden" name="_method" value="PATCH">
        <div class="card-body">
            <div class="form-group">
                <label for="parent_id">ویژگی های دسته</label>
                <div class="col-sm-10">
                    <select name="attributesGroup[]" id="" class="form-control" multiple>
                        @foreach($attributesGroup as $attributeGroup)
                            <option
                                @foreach ($category->attributesGroup as $categoryAttribute)
                                    @if ($categoryAttribute->id == $attributeGroup->id)
                                        selected
                                    @endif
                                @endforeach

                                value="{{$attributeGroup->id}}">{{$attributeGroup->title}}</option>
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
