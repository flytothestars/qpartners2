<?php /** @var Illuminate\Http\Request $request */ ?>
        <!DOCTYPE html>
<html>

@include('admin.layout.app')

<body class="hold-transition sidebar-mini skin-black">
<i class="ajax-loader" id="ajax-loader"></i>
<div id="blur"></div>
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="/" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">{{Lang::get('app.website_name')}}</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">
            <img src="/logo_main.png?v=3" style="width:140px">
          </span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{Auth::user()->avatar}}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{Auth::user()->surname .' ' .Auth::user()->name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{Auth::user()->avatar}}" class="img-circle" alt="User Image">

                                <p>
                                    Администратор
                                    <small></small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="/admin/password" class="btn btn-default btn-flat">Сменить пароль</a>
                                </div>
                                <div class="pull-right">
                                    <a href="/logout" class="btn btn-default btn-flat">Выйти</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown tasks-menu">
                        <a href="/logout" title="Выйти">
                            <i class="fa fa-sign-out"></i>
                        </a>
                    </li>
                    @if(Auth::user()->role_id == 1)
                        <li>
                            <a href="#" data-toggle="control-sidebar" title="Настройки"><i class="fa fa-gears"></i></a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
    </header>

    <aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{Auth::user()->avatar}}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{Auth::user()->name}}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Онлайн</a>
                </div>
            </div>

            @if(Auth::user()->role_id == 3)
                @include('admin.layout.sidebar-admin')
            @else
                @include('admin.layout.sidebar')
            @endif

        </section>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

    @yield('breadcrump')

    <!-- Main content -->
        <section class="content">
            <?php if(Session::has('success')): ?>
            <div class="alert alert-success" role="alert">
                <?= Session::get('success') ?>
            </div>
            <?php elseif (Session::has('danger')): ?>
            <div class="alert alert-danger" role="alert">
                <?= Session::get('danger') ?>
            </div>
            <?php endif; ?>

            @yield('content')

        </section>

    </div><!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2019 <a href="/">{{Lang::get('app.website_name')}}</a>.</strong>
    </footer>

    <aside class="control-sidebar control-sidebar-dark">
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">

        </ul>
        <div class="tab-content">
            <div class="tab-pane" id="control-sidebar-home-tab"></div>
        </div>
    </aside>
    <div class="control-sidebar-bg"></div>
</div>

</body>
</html>


<meta name="csrf-token" content="{{ csrf_token() }}">


<!-- jQuery 2.1.4 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/admin/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="/admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/admin/plugins/fastclick/fastclick.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="/admin/dist/js/demo.js"></script>

{{--<script src="/custom/js/jquery-2.1.1.min.js"></script>--}}

<!-- AdminLTE App -->
<script src="/admin/dist/js/app.min.js"></script>

<link href="/custom/wysiwyg/default.css" rel="stylesheet"/>
<script type="text/javascript" src="/custom/wysiwyg/kindeditor.js"></script>
<script type="text/javascript" src="/custom/wysiwyg/ru_Ru.js"></script>

<script src="/custom/js/jquery.maskedinput.js"></script>
<script src="/custom/js/moment.js"></script>
<script src="/custom/js/custom.js?v=20"></script>
<script src="/custom/js/bootstrap-datetimepicker.min.js"></script>
<script src="/custom/js/jquery.gritter.js"></script>

<link href="/custom/fancybox/jquery.fancybox.css" type="text/css" rel="stylesheet">
<script src="/custom/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>

<!-- page script -->
<script src="/custom/js/admin.js?v=11"></script>
<script src="/admin/js/bootstrap-select.js?v=1"></script>
<script type="text/javascript" src="{{URL('/')}}/share42/share42.js"></script>

@if(isset($_GET['error']) && $_GET['error'] != '')
    <script>
        showError('{{$_GET['error']}}');
    </script>
@endif

@if(isset($_GET['message']) && $_GET['message'] != '')
    <script>
        showMessage('{{$_GET['message']}}');
    </script>
@endif
@yield('js')