<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('app-styles')
    @yield('app-scripts')


    <link rel="stylesheet" href="{{asset('admin/plugins/font-awesome/css/font-awesome.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('admin/css/all.css')}}">

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    @yield('styles')


</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">


        <!-- Right navbar links -->
        <ul class="navbar-nav mr-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                        class="fa fa-th-large"></i></a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->

        <!-- Sidebar -->
        <div class="sidebar" style="direction: ltr">
            <div style="direction: rtl">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="#" class="d-block">{{\Illuminate\Support\Facades\Auth::user()->name.' '.\Illuminate\Support\Facades\Auth::user()->last_name}}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fa fa-bookmark-o" aria-hidden="true"></i>

                                <p>
                                    دسته بندی ها
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('categories.index')}}" class="nav-link">
                                        <i class="fa fa-bookmark-o" aria-hidden="true"></i>

                                        <p>لیست دسته بندی ها</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fa fa-filter" aria-hidden="true"></i>

                                <p>
                                    ویژگی ها
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('attributesGroup.index')}}" class="nav-link">
                                        <i class="fa fa-filter" aria-hidden="true"></i>

                                        <p>لیست ویژگی ها</p>
                                    </a>
                                </li>

                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('attributesValue.index')}}" class="nav-link">
                                        <i class="fa fa-filter" aria-hidden="true"></i>

                                        <p>مقادیر ویژگی ها</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fa fa-paint-brush" aria-hidden="true"></i>

                                <p>
                                   برند ها
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('brands.index')}}" class="nav-link">
                                        <i class="fa fa-paint-brush" aria-hidden="true"></i>

                                        <p>لیست برند ها</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fa fa-dropbox" aria-hidden="true"></i>

                                <p>
                                  محصولات
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('products.index')}}" class="nav-link">
                                        <i class="fa fa-dropbox" aria-hidden="true"></i>

                                        <p>لیست محصولات</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('products.trash.index')}}" class="nav-link">
                                        <i class="fa fa-trash" aria-hidden="true"></i>

                                        <p> زباله دان</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('coupons.index')}}" class="nav-link">
                                <i class="fa fa-money" aria-hidden="true"></i>
                                <p>کدتخفیف</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('backend.orders.index')}}" class="nav-link">
                                <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                <p>سفارشات</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('roles.index')}}" class="nav-link">
                                <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                <p>نقش ها</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('frontend.profile')}}" class="nav-link">
                                <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                <p>پنل کاربران</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@yield('title')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="#">خانه</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid" id="app">
                @yield('content')
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@yield('scripts')
<script src="{{asset('admin/js/all.js')}}"></script>

</body>
</html>
