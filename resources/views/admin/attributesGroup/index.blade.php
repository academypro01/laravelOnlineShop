@extends('admin.layouts.app')

@section('title')
    لیست ویژگی ها
@endsection

@section('content')
    @include('admin.partials.alerts')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title pull-right"> ویژگی ها </h3>
                <a class="btn btn-app pull-left" href="{{route('attributesGroup.create')}}">
                    <i class="fa fa-plus" aria-hidden="true"></i>افزودن
                </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <div id="example2_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="موتور رندر: activate to sort column descending">ویژگی </th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="موتور رندر: activate to sort column descending">نوع </th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="موتور رندر: activate to sort column descending">عملیات </th>
                                </thead>
                                <tbody>
                                @foreach($attributesGroup as $attributeGroup)
                                    <tr role="row" class="odd">
                                        <td>{{$attributeGroup->title}}</td>
                                        <td>{{$attributeGroup->type}}</td>
                                        <td>
                                            <a href="{{route('attributesGroup.edit', $attributeGroup->id)}}" class="d-block pull-right">
                                                <button class="btn btn-warning">ویرایش</button>
                                            </a>
                                            <form action="{{route('attributesGroup.destroy', $attributeGroup->id)}}" method="post" class="pull-left">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="submit" value="حذف" class="btn btn-danger">
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
