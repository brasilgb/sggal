<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>AdminLTE 3 | Dashboard 2</title>

        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css')}}">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="index3.html" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="#" class="nav-link">Contact</a>
                    </li>
                </ul>

                <!-- SEARCH FORM -->
                <form class="form-inline ml-3">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <!-- Messages Dropdown Menu -->

                    <!-- Notifications Dropdown Menu -->

                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                                class="fas fa-th-large"></i></a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="index3.html" class="brand-link">
                    <img src="adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                         style="opacity: .8">
                    <span class="brand-text font-weight-light">AdminLTE 3</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">Alexander Pierce</a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                                 with font-awesome or any other icon font library -->
                            <li class="nav-item">
                                <a href="/" class="nav-link active">
                                    <i class="nav-icon fas fa-home"></i><p> Início</p></a>
                            </li>
                            
                            <li class="nav-item">
                                <a href="{{route('coletas.index')}}" class="nav-link">
                                    <i class="nav-icon fas fa-cart-plus"></i><p> Coletas</p></a>
                            </li>
                            
                            <li class="nav-item">
                                <a href="/" class="nav-link">
                                    <i class="nav-icon fa fa-truck"></i><p> Envio de ovos</p></a>
                            </li>
                            

                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-list-alt"></i>
                                    <p> Relatórios<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="./index.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Dashboard v1</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="./index2.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Dashboard v2</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="./index3.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Dashboard v3</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        @yield('content')      
                    </div>

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Main Footer -->
            <footer class="main-footer">
                <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> 3.0.1
                </div>
            </footer>
        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->
        <!-- jQuery -->
        <script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
        <!-- Bootstrap -->
        <script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- overlayScrollbars -->
        <script src="{{asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('adminlte/dist/js/adminlte.js')}}"></script>

        <!-- OPTIONAL SCRIPTS -->
        <script src="{{asset('adminlte/dist/js/demo.js')}}"></script>

        <!-- PAGE PLUGINS -->
        <!-- jQuery Mapael -->
        <script src="{{asset('adminlte/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
        <script src="{{asset('adminlte/plugins/raphael/raphael.min.js')}}"></script>
        <script src="{{asset('adminlte/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
        <script src="{{asset('adminlte/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
        <!-- ChartJS -->
        <script src="{{asset('adminlte/plugins/chart.js/Chart.min.js')}}"></script>

        <!-- PAGE SCRIPTS -->
        <script src="{{asset('adminlte/dist/js/pages/dashboard2.js')}}"></script>
    </body>
</html>