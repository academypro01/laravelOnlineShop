@extends('admin.layouts.app')

@section('title')
   ویرایش محصول: {{$product->title}}
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
        var photos = [].concat({{$product->photos->pluck('id')}})
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
        productGallery = function(){
            document.getElementById('product-photo').value = photos_id.concat(photos)
        }
        removeImages = function(id){
            var index = photos.indexOf(id)
            photos.splice(index, 1);
            document.getElementById('updated_photo_' + id).remove();
        };
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
    <form class="form-horizontal" method="post" action="{{route('products.update', $product->id)}}">
        @csrf
        <input type="hidden" name="_method" value="PATCH">
        <div class="card-body">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">عنوان محصول</label>

                <div class="col-sm-10">
                    <input type="text" value="{{$product->title}}" name="title" class="form-control" id="inputEmail3" placeholder="عنوان محصول را وارد کنید ">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">نام مستعار محصول</label>

                <div class="col-sm-10">
                    <input type="text" value="{{$product->slug}}" name="slug" class="form-control" id="inputEmail3" placeholder="عنوان مستعار محصول را وارد کنید ">
                </div>
            </div>
            <attribute-component-edit :brands="{{$brands}}" :product="{{$product}}"></attribute-component-edit>
            <input type="hidden" name="photo_id[]" id="product-photo" value="">
            <div class="form-group">
                <label for="photo"> گالری تصاویر</label>
                <div class="col-sm-10">
                    <div class="dropzone" id="dropzone">

                    </div>
                    <div class="row">
                        @foreach($product->photos as $photo)
                            <div class="col-sm-3" id="updated_photo_{{$photo->id}}">
                                <img class="img-responsive w-25" src="{{$photo->path}}">
                                <button type="button" class="btn btn-danger" onclick="removeImages({{$photo->id}})">حذف</button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" onclick="productGallery()" class="btn btn-info">ذخیره</button>
        </div>
        <!-- /.card-footer -->
    </form>
@endsection
