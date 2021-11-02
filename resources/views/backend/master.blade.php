<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
    $url = explode('8000',url()->current());
    $url = str_replace('/',' ',end($url));
    $url = ucwords(preg_replace('/[\d*%-]+/', ' ', $url));
    @endphp
    <title>cit-ecommerce | {{ $url }}</title>
    <link rel="icon" type="img/icon"
        href="https://img-premium.flaticon.com/png/512/3649/premium/3649281.png?token=exp=1633454461~hmac=e3ec2f9bbea39d835f99b56fd23dddfe">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('asset/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('asset/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('asset/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('asset/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('asset/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('asset/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('asset/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/plugins/toastr/toastr.min.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('asset/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
                height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ asset('asset/dist/img/user1-128x128.jpg') }}" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ asset('asset/dist/img/user8-128x128.jpg') }}" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ asset('asset/dist/img/user3-128x128.jpg') }}" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i
                                                class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link " data-toggle="dropdown" href="#">
                        <b class="mr-2 h5 dropdown-toggle">{{ auth()->user()->name }}</b> <img
                            src="{{ asset('profile/'.auth()->user()->profile->id.'/'.auth()->user()->profile->image) }}"
                            class="img-circle elevation-2" alt="{{ auth()->user()->name }}" width="20">

                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                        <div class="dropdown-divider"></div>
                        <a href="{{ route('profile.index',auth()->user()) }}" class="dropdown-item">
                            <i class="fas fa-user mr-2"></i> Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('profile.create') }}" class="dropdown-item">
                            <i class="fas fa-edit mr-2"></i> Edit Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('profile.password',auth()->user()) }}" class="dropdown-item">
                            <i class="fas fa-lock mr-2"></i> Change Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer"
                            onclick="event.preventDefault();document.getElementById('form-logout').submit()">
                            <span class="btn btn-outline-danger"><i class=" fas fa-sign-out-alt"></i>
                                Logout
                            </span>
                        </a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('dashboard') }}" class="brand-link">
                <img src="https://cdn1.iconfinder.com/data/icons/e-commerce-service-soft-color/100/shopping_dashboard-512.png"
                    alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">E-Com</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                            <a target="_blank" href="{{ route('front.index') }}" class="nav-link ">
                                <i class="nav-icon fas fa-store"></i>
                                <p>
                                    Shop
                                </p>
                            </a>

                        </li>
                        <li class="nav-item menu-open @yield('dashboard_tree')">
                            <a href="{{ route('dashboard') }}" class="nav-link @yield('dashboard_active')">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>

                        </li>
                        <li class="nav-item @yield('category_tree')">
                            <a href="#" class="nav-link @yield('category_active')">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Category
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('category.index') }}"
                                        class="nav-link @yield('category_view_active')">
                                        <i class="far fa-list-alt nav-icon"></i>
                                        <p>View Categories</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('category.create') }}"
                                        class="nav-link @yield('category_add_active')">
                                        <i class="nav-icon fas fa-plus"></i>
                                        <p>Add Categories</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('category.trash') }}"
                                        class="nav-link @yield('category_trash_active')">
                                        <i class="fas fa-trash-alt nav-icon"></i>
                                        <p>Trash Categories</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item @yield('subcategory_tree')">
                            <a href="#" class="nav-link @yield('subcategory_active')">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Subcategory
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('subcategory.index') }}"
                                        class="nav-link @yield('subcategory_view_active')">
                                        <i class="far fa-list-alt nav-icon"></i>
                                        <p>View Subcategories</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('subcategory.create') }}"
                                        class="nav-link @yield('subcategory_add_active')">
                                        <i class="nav-icon fas fa-plus"></i>
                                        <p>Add Subcategory</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('subcategory.trash') }}"
                                        class="nav-link @yield('subcategory_trash_active')">
                                        <i class="fas fa-trash-alt nav-icon"></i>
                                        <p>Trash Subcategories</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item @yield('product_tree')">
                            <a href="#" class="nav-link @yield('product_active')">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Products
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('product.index') }}"
                                        class="nav-link @yield('product_view_active')">
                                        <i class="far fa-list-alt nav-icon"></i>
                                        <p>View Products</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('product.create') }}"
                                        class="nav-link @yield('product_add_active')">
                                        <i class="nav-icon fas fa-plus"></i>
                                        <p>Add Product</p>
                                    </a>
                                </li>
                            </ul>

                        </li>
                        <li class="nav-item @yield('color_size_tree')">
                            <a href="#" class="nav-link @yield('color_size_active')">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Colors And Sizes
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('color.index') }}" class="nav-link @yield('color_active')">
                                        <i class="far fa-list-alt nav-icon"></i>
                                        <p>Color</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('size.index') }}" class="nav-link @yield('size_active')">
                                        <i class="nav-icon fas fa-plus"></i>
                                        <p>Size</p>
                                    </a>
                                </li>
                            </ul>

                        </li>
                        <li class="nav-item @yield('coupon_tree')">
                            <a href="#" class="nav-link @yield('coupon_active')">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Coupon
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('coupon.index') }}" class="nav-link @yield('coupon_view_active')">
                                        <i class="far fa-list-alt nav-icon"></i>
                                        <p>View Coupon</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('coupon.create') }}" class="nav-link @yield('coupon_add_active')">
                                        <i class="nav-icon fas fa-plus"></i>
                                        <p>Add Coupon</p>
                                    </a>
                                </li>
                            </ul>

                        </li>
                        @can('assign user')
                        <li class="nav-item @yield('role_tree')">
                            <a href="#" class="nav-link @yield('role_active')">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Role Managment
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('role.index') }}" class="nav-link @yield('role_view_active')">
                                        <i class="far fa-list-alt nav-icon"></i>
                                        <p>Roles</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('role.create') }}" class="nav-link @yield('role_add_active')">
                                        <i class="nav-icon fas fa-plus"></i>
                                        <p>Create Role</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('role.assignUserStore') }}"
                                        class="nav-link @yield('role_user_active')">
                                        <i class="nav-icon fas fa-plus"></i>
                                        <p>Assign User Role</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('role.create.admin') }}"
                                        class="nav-link @yield('role_add_new_admin_active')">
                                        <i class="nav-icon fas fa-plus"></i>
                                        <p>Register New Admin</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @else
                        @endcan
                        <li class="nav-item @yield('order_tree')">
                            <a href="#" class="nav-link @yield('order_active')">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Orders
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('order.index') }}" class="nav-link @yield('order_view_active')">
                                        <i class="far fa-list-alt nav-icon"></i>
                                        <p>View Orders </p>
                                    </a>
                                </li>
                            </ul>


                        </li>



                        {{-- logout --}}

                        <form id="form-logout" action="{{route('logout')}}" method="POST">
                            @csrf
                        </form>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            @yield('content')

        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-{{ now()->format('Y') }} <i class="fab fa-github">/</i> <a target="_blank"
                    href="https://github.com/mdmahbubrahman/cit-ecommerce">mdmahbubrahman</a>.</strong>
            All rights reserved. ES WEB DEV 2004
            <div class="float-right d-none d-sm-inline-block">
                <b class="text-uppercase">DEVELOPMENT PHASE</b>
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('asset/plugins/jquery/jquery.min.js')}}"></script>
    <script src="//code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src=" {{ asset('asset/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip
        -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('asset/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- ChartJS -->
    <script src=" {{ asset('asset/plugins/chart.js/Chart.min.js')}}"></script>
    <!-- Sparkline
        -->
    <script src="{{ asset('asset/plugins/sparklines/sparkline.js')}}"></script>
    <!-- JQVMap -->
    <script src=" {{ asset('asset/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{ asset('asset/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('asset/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('asset/plugins/moment/moment.min.js')}}"></script>
    <script src="{{ asset('asset/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('asset/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{ asset('asset/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('asset/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}">
    </script>
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('asset/dist/js/adminlte.js')}}">
    </script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('asset/dist/js/demo.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('asset/dist/js/pages/dashboard.js')}}"></script>
    <script src="{{ asset('asset/plugins/toastr/toastr.min.js')}}"></script>
    {{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}
    <script>
        @if (session('success'))
        Command: toastr["success"]("{{ session('success') }}")
          toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
          }
          @endif
        @if (session('error'))
        Command: toastr["error"]("{{ session('error') }}")
        toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }
        @endif
    </script>
    @yield('footer_js')

</body>

</html>
