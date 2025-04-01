<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content=" {{ config('itlux.release') }}">
    <title><?=$settings['2']?> | {{ config('itlux.name') }}</title>
    <link href="/favicon.ico" rel="icon" />

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/alte/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/alte/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/alte/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="/alte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="/alte/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="/alte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/alte/plugins/iCheck/all.css">
    <link rel="stylesheet" href="/alte/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="/alte/plugins/timepicker/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="/alte/bower_components/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="/alte/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/alte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="/alte/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


    <script src="/alte/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/alte/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="/alte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/alte/bower_components/raphael/raphael.min.js"></script>
    <script src="/alte/bower_components/morris.js/morris.min.js"></script>
    <script src="/alte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <script src="/alte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="/alte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="/alte/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
    <script src="/alte/bower_components/moment/min/moment.min.js"></script>
    <script src="/alte/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="/alte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="/alte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/alte/bower_components/fastclick/lib/fastclick.js"></script>
    <script src="/alte/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="/alte/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="/alte/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="/alte/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <script src="/alte/bower_components/moment/min/moment.min.js"></script>
    <script src="/alte/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="/alte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="/alte/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="/alte/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="/alte/plugins/iCheck/icheck.min.js"></script>

    <script src="/alte/dist/js/adminlte.min.js"></script>
    <script src="/alte/dist/js/pages/dashboard.js"></script>
    <script src="/alte/dist/js/demo.js"></script>
    <script src="/alte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="/alte/bower_components/ckeditor/ckeditor.js"></script>
    <script src="/alte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    
    <script>
        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('editor1')
            //bootstrap WYSIHTML5 - text editor
            $('.textarea').wysihtml5()
        })
    </script>

    <script src="/alte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/alte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    
    <link rel="stylesheet" href="/css/itlux.css">

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <a href="{{ url('/admin') }}" class="logo">
            <span class="logo-mini">O<b>B</b></span>
            <span class="logo-lg">Office<b>Book</b></span>
        </a>
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="/alte/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <img src="/alte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                <p>
                                    {{ Auth::user()->name }}
                                </p>
                            </li>
                            <li class="user-footer" style="background-color: #222D32;">
                                <div class="pull-left">
                                    <a href="/admin/userprofile" class="btn btn-default btn-flat">Профиль</a>
                                </div>
                                <div class="pull-right">
                                    {{ Auth::guest() }}
                                    <a class="btn btn-default btn-flat" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">Меню</li>
                
                @if (Gate::allows('people'))
                <li <?=$menuactive['menu_peoples']?>>
                    <a href="#"><i class="fa  fa-group"></i><span>Люди</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @foreach ($status as $key => $stat)
                        <li <?=$menuactive['menu_peoples_'.$key]?>><a href="/admin/peoples/<?=$key?>"><i class="fa fa-child"></i><?=$stat?></a></li>
                        @endforeach
                        <li <?=$menuactive['menu_peoples_all']?>><a href="/admin/peoples"><i class="fa fa-child"></i>Все</a></li>
                    </ul>
                </li>
                @endif
                
                @if (Gate::allows('inventory'))
                <li <?=$menuactive['menu_inventory']?>>
                    <a href="#"><i class="fa fa-laptop"></i> <span>Имущество</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <li <?=$menuactive['menu_inventory_all']?>><a href="/admin/inventorys"><i class="fa fa-circle-thin"></i>Все группы</a></li>
                        
                        @if (Gate::allows('group'))
                        @foreach ($groups as $key => $group)
                        <li <?=$menuactive['menu_inventory_'.$key]?> ><a href="/admin/inventorys/<?=$key?>"><i class="fa fa-check"></i><?=$group?></a></li>
                        @endforeach
                        @endif
                        
                        <li <?=$menuactive['menu_inventory_n']?>><a href="/admin/inventorys/n"><i class="fa fa-calendar-check-o"></i>Не используется</a></li>
                        <li <?=$menuactive['menu_inventory_s']?>><a href="/admin/inventorys/s"><i class="fa fa-calendar-times-o"></i>Списанное</a></li>
                    </ul>
                </li>
                @endif
                
                @if (Gate::allows('addresses')||Gate::allows('point')||Gate::allows('group')||Gate::allows('position'))
                <li <?=$menuactive['menu_dir']?> >
                    <a href="#"><i class="fa fa-book"></i> <span>Справочники</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        @if (Gate::allows('addresses'))
                        <li <?=$menuactive['menu_addresses']?> ><a href="/admin/addresses"><i class="fa fa-map-marker"></i>Адреса</a></li>
                        @endif
                         @if (Gate::allows('point'))
                        <li <?=$menuactive['menu_points']?> ><a href="/admin/points"><i class="fa fa-map-marker"></i>Места хранения</a></li>
                        @endif
                        @if (Gate::allows('group'))
                            <li <?=$menuactive['menu_groupprod']?> ><a href="/admin/groups"><i class="fa fa-object-group"></i>Группы имущества</a></li>
                        @endif
                        @if (Gate::allows('position'))
                        <li <?=$menuactive['menu_us_positions']?> ><a href="/admin/positions"><i class="fa fa-sign-out"></i>Должности</a></li>
                        @endif
                    </ul>
                </li>
                @endif
                
                @if (Gate::allows('root') || Gate::allows('mailwork') || Gate::allows('inventoryedit') || Gate::allows('history'))
                <li <?=$menuactive['menu_settings']?> >
                    <a href="#"><i class="fa fa-cog"></i> <span>Настройки</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>

                    <ul class="treeview-menu">
                        @if (Gate::allows('root'))
                            <li <?=$menuactive['menu_settings_org']?> ><a href="/admin/settings"><i class="fa fa-user"></i>Данные организации</a></li>
                            <li <?=$menuactive['menu_us_users']?> ><a href="/admin/users"><i class="fa fa-user"></i>Пользователи</a></li>
                            <li <?=$menuactive['menu_us_accessrole']?> ><a href="/admin/accessrole"><i class="fa fa-th"></i>Матрица прав</a></li>
                            <li <?=$menuactive['menu_security']?> ><a href="/admin/security"><i class="fa fa-user-secret"></i>Безопасность</a></li>
                        @endif
                        @if (Gate::allows('mailwork'))
                            <li <?=$menuactive['menu_mailworks']?> ><a href="/admin/mailworks"><i class="fa fa-envelope"></i>Почта рабочая</a></li>
                        @endif
                        @if (Gate::allows('history'))
                            <li <?=$menuactive['menu_history']?> ><a href="/admin/historys"><i class="fa fa-history"></i>Истроия правок</a></li>
                        @endif
                        @if (Gate::allows('inventory_edit'))
                            <li <?=$menuactive['menu_export_excel']?> ><a href="/admin/export"><i class="fa fa-file-excel-o"></i>Експотр в Excel</a></li>
                        @endif
                        @if (Gate::allows('root'))
                            <li <?=$menuactive['menu_import_excel']?> ><a href="/admin/import"><i class="fa fa-file-excel-o"></i>Импорт с Excel</a></li>
                        @endif
                    </ul>
                </li>
                @endif
                
            </ul>
        </section>
    </aside>
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                <?=$settings['2']?>
                <small><?=$settings['3']?></small>
            </h1>
            <ol class="breadcrumb">
                <?=$leftmenu?>
            </ol>
        </section>

    @yield('content')

    </div>
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            Все под контролем!
        </div>
        &copy; {{ config('itlux.release') }} <a href="http://itlux.com.ua" target="_blank">ITLux.com.ua</a>
    </footer>

    <aside class="control-sidebar control-sidebar-dark">
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" id="control-sidebar-home-tab">
                <a href="/office" ><h3 class="control-sidebar-heading">OfficeBook</h3></a>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="/office/contacts">
                            <i class="menu-icon fa fa-user bg-yellow"></i>
                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Контакты</h4>
                                <p>E-mail, тел. адресс</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="/office/inventorys">
                            <i class="menu-icon fa fa-laptop  bg-light-blue"></i>
                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Имущество</h4>
                                <p>Что, где, у кого</p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </aside>
    <div class="control-sidebar-bg"></div>
</div>

<script src="/js/admin.js"></script>

@include('layouts.analytics')

</body>
</html>

