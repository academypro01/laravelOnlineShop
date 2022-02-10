@extends('admin.layouts.app')

@section('title')
   زباله دان محصولات
@endsection

@section('content')
    @include('admin.partials.alerts')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title pull-right"> زباله دان محصولات </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <div id="example2_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">تصویر </th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">کدمحصول </th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">عنوان </th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">کاربر </th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">وضعیت انتشار </th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">عملیات </th>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr role="row" class="odd">
                                        <td><img src="{{$product->photos[0]->path}}" alt="photo" width="100"></td>
                                        <td>{{$product->sku}}</td>
                                        <td>{{$product->title}}</td>
                                        <td>{{$product->user->name}}</td>
                                        <td>
                                            @if ($product->status == 1)
                                                <button class="btn btn-success">منتشر شده</button>
                                            @else
                                                <button class="btn btn-danger">عدم انتشار</button>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{route('products.trash.restore')}}" method="post" class="pull-right">
                                                @csrf
                                                <input type="hidden" name="restore_id" value="{{$product->id}}">
                                                <input type="submit" value="بازگردانی" class="btn btn-info">
                                            </form>
                                            <form action="{{route('products.trash.forceDelete')}}" method="post" class="pull-left">
                                                @csrf
                                                <input type="hidden" name="forceDelete_id" value="{{$product->id}}">
                                                <input type="submit" value="حذف همیشگی" class="btn btn-danger">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table></div></div>
                    <div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
