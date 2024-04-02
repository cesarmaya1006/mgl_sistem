<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-info elevation-4" id="main_sidebar">
    <!-- Brand Logo -->
    <a href="#" class="brand-link pt-3 pb-4">
        <img src="{{asset('imagenes/sistema/mgl_logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8;background-color: white;">
        <span class="brand-text font-weight-light text-white">Mgl - Tech</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('imagenes/usuarios/'.session('foto'))}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block text-white">{{session('nombres').' '. session('apellidos')}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2" style="color: #064149; font-weight: 500;">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
                @foreach ($menusComposer as $key => $item)
                    @if ($item['config_menu_id'] != 0)
                        @break
                    @endif
                    @include("layouts.menu-item", ["item" => $item])
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
