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
<body class="hold-transition sidebar-mini layout-fixed" onload="menu_ul()">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('imagenes/sistema/mgl_logo.png') }}" alt="AdminLTELogo" height="60" width="60">
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
