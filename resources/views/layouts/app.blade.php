@yield ('funciones_php')
<!DOCTYPE html>
<html lang="es">
<head>
    <!-- pagina heads -->
    @include("layouts.head")
    <!-- -------------------------------------- -->
    <!-- Estilos proios de la pagina -->
    @yield ('estilosHojas')
    <!-- -------------------------------------- -->
</head>
<body class="hold-transition sidebar-mini layout-fixed
{{session('apariencia.body_dark_mode')=='si'? 'dark-mode':''}}
{{session('apariencia.encabezado_fijo')=='si'? 'layout-navbar-fixed':''}}
{{session('apariencia.sidebar_collapse')=='si'? 'sidebar-collapse':''}}
{{session('apariencia.sidebar_mini_md_checkbox')=='si'? 'sidebar-mini-md':''}}
{{session('apariencia.sidebar_mini_xs_checkbox')=='si'? 'sidebar-mini-xs':''}}
{{session('apariencia.footer_fixed_checkbox')=='si'? 'layout-footer-fixed':''}}
{{session('apariencia.text_sm_body_checkbox')=='si'? 'text-sm':''}}"
onload="menu_ul()">
    <input type="hidden" id="sidebar_collapse_input" value="{{session('apariencia.sidebar_collapse')}}">
    <input type="hidden" id="sidebar_mini_md_checkbox_input" value="{{session('apariencia.sidebar_mini_md_checkbox')}}">
    <input type="hidden" id="sidebar_mini_xs_checkbox_input" value="{{session('apariencia.sidebar_mini_xs_checkbox')}}">
    <input type="hidden" id="flat_sidebar_checkbox_input" value="{{session('apariencia.flat_sidebar_checkbox')}}">
    <!--  Rutas Apariencia -->
    <input type="hidden" id="id_cambio_check_ruta" data_url="{{route('apariencia.cambio_check')}}">
    <input type="hidden" id="ruta_body_dark_mode" data_url="{{route('apariencia.body_dark_mode')}}">
    <input type="hidden" id="ruta_fondo_barra_sup" data_url="{{route('apariencia.fondomenu_sup')}}">
    <input type="hidden" id="ruta_fondo_barra_lat" data_url="{{route('apariencia.fondo_barra_lat')}}">
    <!-- Fin rutas apariencias -->
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{asset('imagenes/sistema/').'/'.session('apariencia.logo_shake')}}" alt="AdminLTELogo" height="150" width="auto">
        </div>
        <!-- pagina menu superior -->
        @include("layouts.menu_sup")
        <!-- pagina menu lateral -->
        @include("layouts.aside")

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <!-- -------------------------------------- -->
                            <!-- Titulo de la pagina -->
                            @yield ('titulo_panel')
                            <!-- -------------------------------------- -->
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <!-- -------------------------------------- -->
                            <!-- Arbol de la pagina -->
                            @yield ('arbol_panel')
                            <!-- -------------------------------------- -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- -------------------------------------- -->
                    <!-- Contenido de la pagina -->
                    @yield ('contenido')
                    <!-- -------------------------------------- -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <!-- pagina footer -->
        @include("layouts.footer")

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- pagina footer -->
    @include("layouts.script")
    @yield('scripts_pagina')
</body>
</html>
