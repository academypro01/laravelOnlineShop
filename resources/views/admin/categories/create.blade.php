@extends('admin.layouts.app')

@section('title')
    افزودن دسته جدید
@endsection

@section('content')
    @include('admin.partials.errors')
    <form class="form-horizontal" method="post" action="{{route('categories.store')}}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">عنوان دسته بندی</label>

                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" id="inputEmail3" placeholder="عنوان دسته بندی را وارد کنید ">
                </div>
            </div>
            <div class="form-group">
                <label for="parent_id">دسته والد</label>
                <div class="col-sm-10">
                    <select name="parent_id" id="" class="form-control">
                        <option value="">بدون والد</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @if(count($category->childrenRecursive) > 0)
                                @include('admin.partials.createCategory', ['categories' => $category->childrenRecursive, 'level' => 1])
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">توضیحات متا</label>

                <div class="col-sm-10">
                    <textarea name="meta_desc" id="" class="form-control" cols="30" placeholder="توضیحات متا را وارد کنید" rows="10"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">عنوان متا</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" name="meta_title" id="inputPassword3" placeholder="عنوان متا را وارد کنید">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">کلمات کلیدی متا</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" name="meta_keywords" id="inputPassword3" placeholder="کلمات کلیدی متا را وارد کنید">
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
