<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white
    {{session('apariencia.fondo_barra_sup')=='navbar-light'||session('apariencia.fondo_barra_sup')=='bg-warning'?'navbar-light':'navbar-dark'}}
    {{session('apariencia.dropdown_legacy')=='si'? 'dropdown-legacy':''}}
    {{session('apariencia.text_sm_header_checkbox')=='si'? 'text-sm':''}}
    {{session('apariencia.border_bottom')=='si'? 'border-bottom-0':''}}
    {{session('apariencia.fondo_barra_sup')!='navbar-light'?session('apariencia.fondo_barra_sup'):''}}
    " id="menu_superior">
    <input type="hidden" id="fondo_barra_sup_input" value="{{session('apariencia.fondo_barra_sup')}}">
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
        </li>

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-info navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{ asset('lte/dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
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
                        <img src="{{ asset('lte/dist/img/user8-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
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
                        <img src="{{ asset('lte/dist/img/user3-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Nora Silvester
                                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
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
        <input type="hidden" id="input_notificaiones" data_url="{{route('notificacion.getnotificaciones',['id' => session('id_usuario')])}}">
        <input type="hidden" id="readnotificaciones" data_url="{{route('notificacion.readnotificaciones')}}">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge {{session('cant_notificaciones')<3?'badge-primary':(session('cant_notificaciones')<5?'badge-success':'badge-danger')}} navbar-badge" id="badge_cant_notificaciones" data_cantidad="{{session('cant_notificaciones')}}">{{session('cant_notificaciones')}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="menu_badge_cant_notificaciones_2" style="font-size: 0.75em;">
                <span class="dropdown-item dropdown-header" id="badge_cant_notificaciones_2">0 Notificaciones</span>
                <div class="dropdown-divider" id="id_division_primera"></div>
                <a href="#" class="dropdown-item item_notificacion_link">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider" id="id_division_segunda"></div>
                <a href="#" class="dropdown-item dropdown-footer ver_todas_notif">Ver Todas las notificaciones</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        @if (session('rol.id'<4)) <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link text-danger" data-widget="Logout" href="{{route('logout')}}" role="button">
                    <i class="fas fa-power-off"></i>
                </a>
            </li>
    </ul>
</nav>
<!-- /.navbar -->
<!-- /.modales -->
<!-- /.modal notificaciones -->
<div class="modal fade" id="notificacionesMenuSupModal" tabindex="-1" aria-labelledby="notificacionesMenuSupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificacionesMenuSupModalLabel">Notificaciones</h5>
            </div>
            <div class="modal-body table-responsive" style="font-size: 0.8em;">
                <table class="table table-striped table-hover table-borderless">
                    <tbody id="tbody_notificacionesMenuSupModal">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info boton_cerrar_modal_notif">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- /.modales -->
<!-- /.navbar -->
