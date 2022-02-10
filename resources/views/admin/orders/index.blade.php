@extends('admin.layouts.app')

@section('title')
   لیست سفارشات
@endsection

@section('content')
    @include('admin.partials.alerts')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title pull-right"> سفارشات </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <div id="example2_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" >شناسه </th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" > مبلغ </th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" >وضعیت </th>
                                </thead>
                                <tbody>
                                @foreach ($orders as $order)

                                    <tr>
                                        <td>
                                            {{$order->id}}
                                        </td>
                                        <td>{{$order->amount}}</td>
                                        <td>
                                            @if($order->status == 1)
                                                <button class="btn btn-success" type="button">پرداخت شده</button>
                                            @else
                                                <button class="btn btn-danger" type="button">پرداخت نشده</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table></div></div>
                    <div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                            {{$orders->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
