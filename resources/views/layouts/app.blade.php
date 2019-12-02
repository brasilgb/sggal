<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>SGGA | Painel</title>

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

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <!-- Messages Dropdown Menu -->

                    <!-- Notifications Dropdown Menu -->

                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">Sair <i class="fas fa-sign-out-alt nav-icon"></i></a>
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
                    <span class="brand-text font-weight-light">SGGA</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="adminlte/dist/img/avatar04.png" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">Administrador</a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                                 with font-awesome or any other icon font library -->
                            <li class="nav-item">
                                <a href="/" class="{{ (request()->is('/')) ? 'nav-link active' : 'nav-link' }}">
                                    <i class="nav-icon fas fa-home"></i><p>Início</p></a>
                            </li>
                            
                            <li class="nav-item">
                                <a href="{{route('coletas.index')}}" class="{{ (request()->is('coletas*')) ? 'nav-link active' : 'nav-link' }}">
                                    <i class="nav-icon fas fa-cart-plus"></i><p>Coletas</p></a>
                            </li>
                            
                            <li class="nav-item">
                                <a href="{{route('sendeggs.index')}}" class="{{ (request()->is('sendeggs*')) ? 'nav-link active' : 'nav-link' }}">
                                    <i class="nav-icon fa fa-truck"></i><p>Envio de ovos</p></a>
                            </li>
                            
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-clock"></i><p>Períodos</p></a>
                            </li>
                            
                            <li class="nav-item has-treeview">
                                <a href="#" class="{{ (request()->is('relatorios*')) ? 'nav-link active' : 'nav-link' }}">
                                    <i class="nav-icon fas fa-list-alt"></i>
                                    <p>Relatórios<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="./index.html" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Coletas</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Lotes e Aviários</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Envio de ovos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Aves</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Ração</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Fertilidade</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Eclosão</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            <li class="nav-item has-treeview">
                                <a href="#" class="{{ (request()->is('lotes')) ? 'nav-link active' : 'nav-link' }}">
                                    <i class="nav-icon fa fa-warehouse"></i>
                                    <p>Lotes e aviários<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Lotes</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Aviários</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-kiwi-bird"></i>
                                    <p>Aves<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Baixa de aves</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Peso das aves</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-pallet"></i>
                                    <p>Ração<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Recebimento</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Consumo</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-chart-line"></i>
                                    <p>Estatísticas<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Checklist</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Eclosão</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Fertilidade</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Produção</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-coins"></i>
                                    <p>Financeiro<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Despesas</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Conf. financeiro</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-cog"></i>
                                    <p>Configurações<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Empresa</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>E-mail</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Mortalidade</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-check-square"></i>
                                    <p>Tarefas<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Diárias</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fa fa-caret-right nav-icon"></i>
                                            <p>Específicas</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-user"></i><p>Usuários</p></a>
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
                <strong>Copyright &copy; 2018- <?= date("Y");?> <a href="http://adminlte.io">SGGA</a>.</strong>
                Todos os direitos reservados.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Versão</b> 3.0
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