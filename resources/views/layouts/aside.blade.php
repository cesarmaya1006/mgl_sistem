<!-- Main Sidebar Container -->
<aside class="main-sidebar  elevation-4
        {{session('apariencia.no_expand_sidebar_checkbox')=='si'? 'sidebar-no-expand':''}}
        {{session('apariencia.fondo_barra_lat')}}
        " id="main_sidebar"
        >
        <input type="hidden" id="fondo_barra_lat_input" value="{{session('apariencia.fondo_barra_lat')}}">
    <!-- Brand Logo -->
    <a href="#" class="brand-link
                {{session('apariencia.text_sm_brand_checkbox')=='si'? 'text-sm':''}}
                pt-3 pb-4">
        <img src="{{asset('imagenes/sistema/').'/'.session('apariencia.logo_empresa')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8;">
        <span class="brand-text font-weight-light">{{session('apariencia.nombre_empresa')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex pt-3">
            <div class="image">
                <img src="{{asset('imagenes/usuarios/'.session('foto'))}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{session('nombres').' '. session('apellidos')}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2" style="color: #064149; font-weight: 500;">
            <ul class="nav nav-pills nav-sidebar flex-column
                        {{session('apariencia.flat_sidebar_checkbox')=='si'? 'nav-flat':''}}
                        {{session('apariencia.legacy_sidebar_checkbox')=='si'? 'nav-legacy':''}}
                        {{session('apariencia.compact_sidebar_checkbox')=='si'? 'nav-compact':''}}
                        {{session('apariencia.child_indent_sidebar_checkbox')=='si'? 'nav-child-indent':''}}
                        {{session('apariencia.text_sm_sidebar_checkbox')=='si'? 'text-sm':''}}

                      " data-widget="treeview" role="menu"
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
