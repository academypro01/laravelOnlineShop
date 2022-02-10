@extends('admin.layouts.app')

@section('title')
    افزودن محصول جدید
@endsection

@section('app-styles')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection

@section('app-scripts')
    <script src="{{asset('js/app.js')}}" async></script>
    <script src="{{asset('admin/plugins/ckeditor/ckeditor.js')}}" async></script>
@endsection

@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('admin/css/dropzone.min.css')}}">
@endsection

@section('scripts')
    <script src="{{asset('admin/js/dropzone.min.js')}}"></script>
    <script !src="">
        Dropzone.autoDiscover = false;
        let photos_id = [];
        new Dropzone('#dropzone', {
            url: '{{route('photo.upload')}}',
            paraName: 'file',
            method : 'post',
            uploadMultiple: false,
            maxFiles: 10,
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            headers: {
                'x-csrf-token': document.head.querySelector('meta[name="csrf-token"]').content,
            },
            success: function (file, response) {
                if(photos_id.indexOf(response.photo_id) == -1) {
                    photos_id.push(response.photo_id);
                }
            },
        });
        function addPhotoGallery() {
            document.querySelector("input[name='photo_id[]']").value = photos_id;
        }


        ClassicEditor
            .create( document.querySelector( '#editor' ), {
                toolbar: {
                    items: [
                        'heading', '|',
                        'alignment', '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'subscript', 'superscript', '|',
                        'link', '|',
                        'bulletedList', 'numberedList', 'todoList',
                        '-',
                        'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor', '|',
                        'code', 'codeBlock', '|',
                        'insertTable', '|',
                        'outdent', 'indent', '|',
                        'uploadImage', 'blockQuote', '|',
                        'undo', 'redo'
                    ],
                    shouldNotGroupWhenFull: true
                },
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                    ]
                },
                language: 'fa',
            } )
            .catch( error => {
                console.log( error );
            } );

    </script>

@endsection

@section('content')
    @include('admin.partials.errors')
    <form class="form-horizontal" method="post" action="{{route('products.store')}}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">عنوان محصول</label>

                <div class="col-sm-10">
                    <input type="text" name="title" class="form-control" id="inputEmail3" placeholder="عنوان محصول را وارد کنید ">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">نام مستعار محصول</label>

                <div class="col-sm-10">
                    <input type="text" name="slug" class="form-control" id="inputEmail3" placeholder="عنوان مستعار محصول را وارد کنید ">
                </div>
            </div>
            <attribute-component :brands="{{$brands}}"></attribute-component>
            <input type="hidden" name="photo_id[]" value="">
            <div class="form-group">
                <label for="photo"> گالری تصاویر</label>
                <div class="col-sm-10">
                    <div class="dropzone" id="dropzone">

                    </div>
                </div>
            </div>
        </div>

        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" onclick="addPhotoGallery()" class="btn btn-info">ذخیره</button>
        </div>
        <!-- /.card-footer -->
    </form>
@endsection
