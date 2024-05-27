<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white
    {{ session('apariencia.fondo_barra_sup') == 'navbar-light' || session('apariencia.fondo_barra_sup') == 'bg-warning' ? 'navbar-light' : 'navbar-dark' }}
    {{ session('apariencia.dropdown_legacy') == 'si' ? 'dropdown-legacy' : '' }}
    {{ session('apariencia.text_sm_header_checkbox') == 'si' ? 'text-sm' : '' }}
    {{ session('apariencia.border_bottom') == 'si' ? 'border-bottom-0' : '' }}
    {{ session('apariencia.fondo_barra_sup') != 'navbar-light' ? session('apariencia.fondo_barra_sup') : '' }}
    "
    id="menu_superior">
    <input type="hidden" id="fondo_barra_sup_input" value="{{ session('apariencia.fondo_barra_sup') }}">
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
                <span class="badge badge-info navbar-badge" id="badge_mesajes_usu">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="cajonera_mensajes_sup">
                <a href="#" class="dropdown-item d-none">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{ asset('lte/dist/img/user1-128x128.jpg') }}" alt="" class="img-size-50 mr-3 img-circle">
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
                <a href="#" class="dropdown-item dropdown-footer ver_chats" id="ver_chats" onclick="abrir_chat_mensajes()">Abrir Chats</a>
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <input type="hidden" id="input_notificaiones"
            data_url="{{ route('notificacion.getnotificaciones', ['id' => session('id_usuario')]) }}">
        <input type="hidden" id="readnotificaciones" data_url="{{ route('notificacion.readnotificaciones') }}">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span
                    class="badge {{ session('cant_notificaciones') < 3 ? 'badge-primary' : (session('cant_notificaciones') < 5 ? 'badge-success' : 'badge-danger') }} navbar-badge"
                    id="badge_cant_notificaciones"
                    data_cantidad="{{ session('cant_notificaciones') }}">{{ session('cant_notificaciones') }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="menu_badge_cant_notificaciones_2"
                style="font-size: 0.75em;">
                <span class="dropdown-item dropdown-header" id="badge_cant_notificaciones_2">0 Notificaciones</span>
                <div class="dropdown-divider" id="id_division_primera"></div>
                <a href="#" class="dropdown-item item_notificacion_link">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider" id="id_division_segunda"></div>
                <a href="#" class="dropdown-item dropdown-footer ver_todas_notif">Ver Todas las
                    notificaciones</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        @if (session('rol.id' < 4))
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link text-danger" data-widget="Logout" href="{{ route('logout') }}" role="button">
                <i class="fas fa-power-off"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
<!-- /.modales -->
<!-- ======================================================================================================================================= -->
<!-- /.modal notificaciones -->
<div class="modal fade" id="notificacionesMenuSupModal" tabindex="-1"
    aria-labelledby="notificacionesMenuSupModalLabel" aria-hidden="true">
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
<!-- ======================================================================================================================================= -->
<input type="hidden" id="ruta_get_usuarios" data_url="{{ route('mensajes.getusuarios', ['id' => session('id_usuario')]) }}">
<input type="hidden" id="folder_imagenes_usuario_2" value="{{ asset('imagenes/usuarios/') }}">
<input type="hidden" id="ultimo_mensaje_subido_id" value="0">
<input type="hidden" id="data_getmensajes_dest_rem" data_url="{{route('mensajes.getmensajes_dest_rem')}}">
<input type="hidden" id="data_getmensajes_dest_rem_ult" data_url="{{route('mensajes.getmensajes_dest_rem_ult')}}">
<input type="hidden" id="data_get_all_nuevos_mensajes" data_url="{{route('mensajes.get_all_nuevos_mensajes')}}">
<!-- ======================================================================================================================================= -->
<!-- /.modal mensajes -->
<div class="modal fade" id="mensajesMenuSupModal" tabindex="-1" aria-labelledby="mensajesMenuSupModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mensajesMenuSupModalLabel">Chat de Mensajes</h5>
            </div>
            <div class="modal-body" style="font-size: 0.8em;">
                <div class="row h-100" style="border: 2px black ridge;">
                    <div class="col-12  h-100 col-md-3 h-100 d-inline-block" style="border 3px black solid; border-right-style: ridge;background-color: rgba(255, 255, 50, 0.1)">
                        <div class="row">
                            <div class="col-12">
                                <h4><strong>Chats</strong></h4>
                            </div>
                            <div class="col-12">
                                <input type="text" class="search form-control form-control-sm"
                                    placeholder="Buscar">
                            </div>
                            <div class="col-12 table-responsive">
                                <table class="table table-hover table-borderless results" id="tabla_msj_usuarios">
                                    <thead>
                                        <tr>
                                            <th scope="col">Usuarios</th>
                                        </tr>
                                        <tr class="warning no-result">
                                            <td><i class="fa fa-warning"></i> Sin Resultados</td>
                                        </tr>
                                    </thead>
                                    <tbody id="body_table_usuarios_chat">
                                        <tr>
                                            <td class="d-flex flex-row "></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table table-hover table-borderless results" id="tabla_msj_proyectos">
                                    <thead>
                                        <tr>
                                            <th scope="col">proyectos</th>
                                        </tr>
                                        <tr class="warning no-result">
                                            <td><i class="fa fa-warning"></i> Sin Resultados</td>
                                        </tr>
                                    </thead>
                                    <tbody id="body_table_usuarios_chat_p">
                                        <tr>
                                            <td class="d-flex flex-row "></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-9 h-100 d-inline-block"
                        style="border 2px black solid; border-style: ridge;">
                        <div class="row conversacion" id="conversacion_overflow" style="height: 85%;">
                            <div class="col-12 h-100 overflow-auto" id="caja_conversaciones">
                                <div class="row mt-2 caja_destinatario_base d-none" id="caja_destinatario_base">
                                    <div class="col-10 destinatario" style="border: 1px black solid; border-radius: 5px;background-color: rgba(0, 255, 0, 0.062);">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="float-star">
                                                    <h6><i class="fas fa-comment-alt mr-1" aria-hidden="true"></i><strong class="strong_remitente">Cesar Maya</strong></h6><span class="span_fecha" style="font-size: 0.7em;">[Hace 3 Horas]</span>
                                                </span>
                                            </div>
                                            <div class="col-12">
                                                <p class="p_mensaje" style="text-align: justify;">
                                                    Lorem Ipsum es simplemente el texto de relleno de las imprentas y
                                                    archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar
                                                    de las industrias desde el año 1500, cuando un impresor (N. del T.
                                                    persona que se dedica a la imprenta) desconocido usó una galería de
                                                    textos y los mezcló de tal manera que logró hacer un libro de textos
                                                    especimen. No sólo sobrevivió 500 años, sino que tambien ingresó
                                                    como texto de relleno en documentos electrónicos, quedando
                                                    esencialmente igual al original. Fue popularizado en los 60s con la
                                                    creación de las hojas "Letraset", las cuales contenian pasajes de
                                                    Lorem Ipsum, y más recientemente con software de autoedición, como
                                                    por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem
                                                    Ipsum.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2"></div>
                                </div>
                                <div class="row mt-2 caja_remitente_base d-none" id="caja_remitente_base">
                                    <div class="col-2"></div>
                                    <div class="col-10 remitente" style="border: 1px black solid; border-radius: 5px;background-color: rgba(0, 195, 255, 0.062);">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="float-end">
                                                    <h6><i class="fas fa-comment-alt mr-1" aria-hidden="true"></i><strong class="strong_remitente">Cesar Maya</strong></h6><span class="span_fecha" style="font-size: 0.7em;">[Hace 3 Horas]</span>
                                                </span>
                                            </div>
                                            <div class="col-12">
                                                <p class="p_mensaje float-end" style="text-align: justify;">
                                                    El trozo de texto estándar de Lorem Ipsum usado desde el año 1500 es
                                                    reproducido debajo para aquellos interesados. Las secciones 1.10.32
                                                    y 1.10.33 de "de Finibus Bonorum et Malorum" por Cicero son también
                                                    reproducidas en su forma original exacta, acompañadas por versiones
                                                    en Inglés de la traducción realizada en 1914 por H. Rackham.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ultima_caja" id="ultima_caja">.</div>
                            </div>
                        </div>
                        <form class="row formulario_envia position-absolute bottom-0  w-100 d-flex align-items-center"
                                id="form_mensajes"
                                style="height: 15%;border-top-style: ridge"
                                action="{{route('mensajes.store')}}"
                                method="POST"
                                autocomplete="off"
                                enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="col-11 form-group pt-2">
                                <input type="hidden" name="remitente_id_msj" id="remitente_id_msj" value="{{session('id_usuario')}}">
                                <input type="hidden" name="destinatario_id_msj" id="destinatario_id_msj" value="0">
                                <input type="hidden" name="proyectos_id_msj" id="proyectos_id_msj" value="0">
                                <input type="hidden" name="tipo_msj" id="tipo_msj" value="persona">
                                <input type="hidden" id="folder_imagenes_usuarios" value="{{ asset('imagenes/usuarios/') }}">
                                <textarea class="form-control form-control-sm" id="mensaje_envio" name="mensaje_envio" rows="3" style="resize: none;" disabled required></textarea>
                            </div>
                            <div class="col-1">
                                <button type="submit"> <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info boton_cerrar_modal_mjs">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- ======================================================================================================================================= -->

<!-- /.modales -->
<!-- /.navbar -->
