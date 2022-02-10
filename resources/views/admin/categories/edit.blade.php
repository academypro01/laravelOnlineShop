@extends('admin.layouts.app')

@section('title')
    ویرایش دسته بندی : {{$selected_category->name}}
@endsection

@section('content')
    @include('admin.partials.errors')
    <form class="form-horizontal" method="post" action="{{route('categories.update', $selected_category->id)}}">
        @csrf
        <input type="hidden" name="_method" value="PATCH">
        <div class="card-body">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">عنوان دسته بندی</label>

                <div class="col-sm-10">
                    <input value="{{$selected_category->name}}" type="text" name="name" class="form-control" id="inputEmail3" placeholder="عنوان دسته بندی را وارد کنید ">
                </div>
            </div>
            <div class="form-group">
                <label for="parent_id">دسته والد</label>
                <div class="col-sm-10">
                    <select name="parent_id" id="" class="form-control">
                        <option {{($selected_category->parent_id == null) ? 'selected': ''}} value="">بدون والد</option>
                        @foreach($categories as $category)
                            <option {{($category->id == $selected_category->parent_id) ? 'selected': ''}} value="{{$category->id}}">{{$category->name}}</option>
                            @if(count($category->childrenRecursive) > 0)
                                @include('admin.partials.categoryEdit', ['categories' => $category->childrenRecursive, 'level' => 1, 'selected_category' => $selected_category])
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">توضیحات متا</label>

                <div class="col-sm-10">
                    <textarea name="meta_desc" id="" class="form-control" cols="30" placeholder="توضیحات متا را وارد کنید" rows="10">{{$selected_category->meta_desc}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">عنوان متا</label>

                <div class="col-sm-10">
                    <input value="{{$selected_category->meta_title}}" type="text" class="form-control" name="meta_title" id="inputPassword3" placeholder="عنوان متا را وارد کنید">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">کلمات کلیدی متا</label>

                <div class="col-sm-10">
                    <input value="{{$selected_category->meta_keywords}}" type="text" class="form-control" name="meta_keywords" id="inputPassword3" placeholder="کلمات کلیدی متا را وارد کنید">
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-info">به روز رسانی</button>
        </div>
        <!-- /.card-footer -->
    </form>
@endsection
