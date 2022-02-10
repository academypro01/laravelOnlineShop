@extends('admin.layouts.app')

@section('title')
   ویرایش برند: {{$brand->title}}
@endsection

@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('admin/css/dropzone.min.css')}}">
@endsection

@section('scripts')
    <script src="{{asset('admin/js/dropzone.min.js')}}"></script>
    <script !src="">
        Dropzone.autoDiscover = false;
        new Dropzone('#dropzone', {
            url: '{{route('photo.upload')}}',
            paraName: 'file',
            method : 'post',
            uploadMultiple: false,
            maxFiles: 1,
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            headers: {
                'x-csrf-token': document.head.querySelector('meta[name="csrf-token"]').content,
            },
            success: function (file, response) {
                document.querySelector("input[name='photo_id']").value = response.photo_id;
            },
        });
    </script>
@endsection

@section('content')
    @include('admin.partials.errors')
    <img src="{{$brand->photo->path}}" alt="brand photo" width="200">
    <form class="form-horizontal" method="post" action="{{route('brands.update', $brand->id)}}">
        @csrf
        <input type="hidden" name="_method" value="PATCH">
        <div class="card-body">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">عنوان برند</label>

                <div class="col-sm-10">
                    <input value="{{$brand->title}}" type="text" name="title" class="form-control" id="inputEmail3" placeholder="عنوان برند را وارد کنید ">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">توضیحات برند</label>

                <div class="col-sm-10">
                    <textarea name="description" id="" class="form-control" cols="30" placeholder="توضیحات برند را وارد کنید" rows="10">{{$brand->description}}</textarea>
                </div>
            </div>
            <input type="hidden" name="photo_id" value="{{$brand->photo->id}}">
            <div class="form-group">
                <label for="photo">آپلود تصویر</label>
                <div class="col-sm-10">
                    <div class="dropzone" id="dropzone">

                    </div>
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
