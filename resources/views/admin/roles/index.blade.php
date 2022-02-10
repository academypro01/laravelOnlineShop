@extends('admin.layouts.app')

@section('title')
   لیست نقش ها
@endsection

@section('content')
    @include('admin.partials.alerts')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title pull-right"> نقش ها </h3>
                <a class="btn btn-app pull-left" href="{{route('roles.create')}}">
                    <i class="fa fa-plus" aria-hidden="true"></i>افزودن
                </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <div id="example2_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" >شناسه </th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" >عنوان </th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" >عملیات </th>
                                </thead>
                                <tbody>
                                @foreach ($roles as $role)

                                    <tr>
                                        <td>
                                            {{$role->id}}
                                        </td>
                                        <td>{{$role->name}}</td>
                                        <td>
                                            <a href="{{route('roles.edit', $role->id)}}" class="d-block pull-right">
                                                <button class="btn btn-warning">ویرایش</button>
                                            </a>
                                            <form action="{{route('roles.destroy', $role->id)}}" method="post" class="pull-left">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="submit" value="حذف" class="btn btn-danger">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table></div></div>
                    <div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                            {{$roles->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
