@extends('admin.layouts.app')

@section('title')
    لیست دسته بندی ها
@endsection

@section('content')
    @include('admin.partials.alerts')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title pull-right"> دسته بندی ها </h3>
                <a class="btn btn-app pull-left" href="{{route('categories.create')}}">
                    <i class="fa fa-plus" aria-hidden="true"></i>افزودن
                </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <div id="example2_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="موتور رندر: activate to sort column descending">شناسه </th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="موتور رندر: activate to sort column descending">عنوان </th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="موتور رندر: activate to sort column descending">عملیات </th>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                <tr role="row" class="odd">
                                    <td class="sorting_1">{{$category->id}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>
                                        <a href="{{route('categories.edit', $category->id)}}" class="d-block pull-right">
                                            <button class="btn btn-warning">ویرایش</button>
                                        </a>
                                        <a class="p-2" href="{{route('categorySettings.edit', $category->id)}}">
                                            <button class="btn btn-primary">ویژگی ها</button>
                                        </a>
                                        <form action="{{route('categories.destroy', $category->id)}}" method="post" class="pull-left">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="submit" value="حذف" class="btn btn-danger">
                                        </form>
                                    </td>
                                </tr>
                                @if (count($category->childrenRecursive) > 0)
                                    @include('admin.partials.categoryIndex', ['categories' => $category->childrenRecursive, 'level' => 1])
                                @endif
                                @endforeach
                            </table></div></div>
                        <div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                            {{$categories->links()}}
                            </div>
                        </div>
                </div>
            </div>
            </div>
            <!-- /.card-body -->
        </div>
@endsection
