@yield("funciones_php")
<!DOCTYPE html>
<html dir="ltr" lang="es">
  <head>
    <!-- pagina heads -->
    @include("layouts.head")
    <!-- -------------------------------------- -->
    @yield('estilosHojas')
  </head>
  <body>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        @include("layouts.header")
        @include("layouts.aside")
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">@yield ('titulo_panel')</h4>
                        <div class="ms-auto text-end"></div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                @yield ('contenido')
            </div>
            @include("layouts.footer")
        </div>
    </div>
    @include("layouts.scripts")
</body>
</html>
