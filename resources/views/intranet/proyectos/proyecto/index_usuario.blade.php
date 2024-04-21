<div class="row">
    <div class="col-12 col-md-3 mt-3 mb-3 mt-md-2 mb-md-2">
        <div class="card card-raised border-start border-5 border-info"
        data_url = "{{route('proyecto.getproyectosusuario', ['config_usuario_id' => session('id_usuario')] )}}"
        data_url2 = "{{route('proyecto.gestion', ['id' => 1] )}}"
        id="tarjetaProyectosUsuario"
        style="cursor: pointer;">
            <div class="card-body px-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="me-2 text-info">
                        <div class="display-6">{{$usuario->proyectos_miembro->where('estado','Activo')->count()}}</div>
                        <div class="card-text">Proyectos Activos</div>
                    </div>
                    <div class="icon-circle bg-info text-white"><i class="fas fa-project-diagram"></i></div>
                </div>
                <div class="card-text">
                    <div class="d-inline-flex align-items-center">
                        <div class="caption">Proyectos incluidos activos</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @php
    $tareasVige = 0;
    $tareasProx = 0;
    $tareasVenc = 0;
    $cantTareasLider = 0;
    $cantTareasusuario = 0;
    foreach ($usuario->proyectos_miembro as $proyecto) {
        foreach ($proyecto->componentes as $componente) {
            foreach ($componente->tareas->where('progreso','<', '100') as $tarea) {
                //-------------------------------------------------
                $date1 = new DateTime($tarea->fec_creacion);
                $date2 = new DateTime($tarea->fec_limite);
                $diff = date_diff($date1, $date2);
                $differenceFormat = '%a';
                $diasTotalTarea = $diff->format($differenceFormat);
                if ($diasTotalTarea == 0) {
                    $diasTotalTarea = 1;
                }
                //-------------------------------------------------
                $date1 = new DateTime($tarea->fec_creacion);
                $date2 = new DateTime(date('Y-m-d'));
                $diff = date_diff($date1, $date2);
                $differenceFormat = '%a';
                $diasGestionTarea = $diff->format($differenceFormat);
                //---------------------------------------------------
                if ($usuario->id == $proyecto->config_usuario_id) {
                    $cantTareasLider++;
                    if ($tarea->fec_limite < date('Y-m-d')) {
                        $tareasVenc++;
                    }else {
                        $porcVenc=($diasGestionTarea * 100) / $diasTotalTarea;
                        if ($porcVenc> 80 || $diasTotalTarea - $diasGestionTarea < 3) {
                            $tareasProx++;
                        } else {
                            $tareasVige++;
                        }
                    }
                } else {
                    $cantTareasusuario++;
                    if ($tarea->config_usuario_id == session('id_usuario')) {
                        if ($tarea->fec_limite < date('Y-m-d')) {
                            $tareasVenc++;
                        } else {
                            $porcVenc=($diasGestionTarea * 100) / $diasTotalTarea;
                            if ($porcVenc> 80 || $diasTotalTarea - $diasGestionTarea < 3) {
                                $tareasProx++;
                            } else {
                                $tareasVige++;
                            }
                        }
                    }
                }
            }
        }
    }
    @endphp
    <div class="col-12 col-md-3 mt-3 mb-3 mt-md-2 mb-md-2">
        <div class="card card-raised border-start border-5 border-success {{$tareasVige>0?'tarjetaTareasUsuario': ''}}"
             style="{{$tareasVige>0?'cursor: pointer;': ''}}"
             data_url = "{{route('tarea.gettareasusumodal', ['config_usuario_id' => session('id_usuario'),'estado'=>'activas'] )}}"
             data_url2 = "{{route('tarea.gestion', ['id' => 1] )}}">
            <div class="card-body px-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="me-2 text-success">
                        <div class="display-6">{{$tareasVige}}</div>
                        <div class="card-text">Tareas Vigentes</div>
                    </div>
                    <div class="icon-circle bg-success text-white"><i class="fas fa-thumbs-up"></i></div>
                </div>
                <div class="card-text">
                    <div class="d-inline-flex align-items-center">
                        <div class="caption">Tareas Vigentes</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-3 mt-3 mb-3 mt-md-2 mb-md-2">
        <div class="card card-raised border-start border-5 border-warning {{$tareasProx>0?'tarjetaTareasUsuario': ''}}"
            style="{{$tareasProx>0?'cursor: pointer;': ''}}"
            data_url = "{{route('tarea.gettareasusumodal', ['config_usuario_id' => session('id_usuario'),'estado'=>'proxvencer'] )}}"
            data_url2 = "{{route('tarea.gestion', ['id' => 1] )}}">
            <div class="card-body px-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="me-2 text-warning">
                        <div class="display-6">{{$tareasProx}}</div>
                        <div class="card-text">Tareas prox. a vencer</div>
                    </div>
                    <div class="icon-circle bg-warning text-white"><i class="fas fa-bell"></i></div>
                </div>
                <div class="card-text">
                    <div class="d-inline-flex align-items-center">
                        <div class="caption">Tareas prox. a vencer</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-3 mt-3 mb-3 mt-md-2 mb-md-2">
        <div class="card card-raised border-start border-5 border-danger {{$tareasVenc>0?'tarjetaTareasUsuario': ''}}"
             style="{{$tareasVenc>0?'cursor: pointer;': ''}}"
             data_url = "{{route('tarea.gettareasusumodal', ['config_usuario_id' => session('id_usuario'),'estado'=>'vencidas'] )}}"
             data_url2 = "{{route('tarea.gestion', ['id' => 1] )}}">
            <div class="card-body px-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="me-2 text-danger">
                        <div class="display-6">{{$tareasVenc}}</div>
                        <div class="card-text">Tareas Vencidas</div>
                    </div>
                    <div class="icon-circle bg-danger text-white"><i class="fas fa-exclamation-triangle"></i></div>
                </div>
                <div class="card-text">
                    <div class="d-inline-flex align-items-center">
                        <div class="caption">Tareas Vencidas</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if ($usuario->proyectos_miembro->where('estado','Activo')->count())
<div class="row">
    <div class="col-12">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        <strong>Proyectos Activos</strong>
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body table-responsive">
                        <table class="table table-striped table-hover table-sm tabla_data_table_m" id="tabla-data">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class="text-center">Proyecto</th>
                                    <th class="text-center">Líder</th>
                                    <th class="text-center">Gestión/Días</th>
                                    <th class="text-center">Progreso proyecto</th>
                                    <th class="text-center">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuario->proyectos_miembro->where('estado','Activo') as $proyectos)
                                    <tr>
                                        <td class="text-center">
                                            <a href="{{route('proyecto.detalle',['id' => $proyecto->id])}}"
                                               class="btn btn-info btn-sm pl-4 pr-4"
                                               style="font-size: 0.8em;">
                                               <i class="fas fa-folder mr-1"></i>
                                               Ver
                                            </a>
                                        </td>
                                        <td class="text-center">{{$proyecto->titulo}}</td>
                                        <td class="text-center">{{$proyecto->lider->nombres . ' ' . $proyecto->lider->apellidos . ' - ' . $proyecto->lider->empleado->cargo->cargo }} </td>
                                        <td class="text-center">
                                            @php
                                                $date1 = new DateTime($proyecto->fec_creacion);
                                                $date2 = new DateTime(Date('Y-m-d'));
                                                $diff = date_diff($date1, $date2);
                                                $differenceFormat = '%a';
                                            @endphp
                                            {{ $diff->format($differenceFormat) }} días
                                        </td>
                                        <td class="text-center">
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-green" role="progressbar"
                                                    aria-volumenow="{{ $proyecto->progreso }}" aria-volumemin="0"
                                                    aria-volumemax="100" style="width: {{ $proyecto->progreso }}%">
                                                </div>
                                            </div>
                                            <small>
                                                {{ number_format($proyecto->progreso, 2, ',', '.') }} %
                                            </small>
                                        </td>
                                        <td class=" text-center">
                                            <span class="badge badge-success pl-4 pr-4">{{ $proyecto->estado }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<br><br>
<div class="row">
    <div class="col-12">
        <div class="accordion accordion-flush" id="accordionFlushCalendario">
            <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseCalendario" aria-expanded="false" aria-controls="flush-collapseOne">
                    <strong>Calendario de tareas</strong>
                </button>
            </h2>
            <div id="flush-collapseCalendario" class="accordion-collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushCalendario">
                <div class="accordion-body">
                    <div class="row">
                        .col-12>.row>.col-12.
                        <div class="col-12 mb-4">
                            <div class="container-fluid">
                                <p><span class="badge pl-4 pr-4 mr-5 text-red" style="background-color: red; min-width: 25px; color: red;">..........</span> Tarea Vencida</p>
                                <p><span class="badge pl-4 pr-4 mr-5 text-orange" style="background-color: orange; min-width: 25px; color: red;">..........</span> Tareas próxima a vencer</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="container-fluid">
                                <div class="row d-flex justify-content-center ">
                                <div class="col-md-12">
                                    <div class="card card-primary">
                                    <div class="card-body p-0">
                                        <!-- THE CALENDAR -->
                                        <div id="calendar"></div>
                                        <input type="hidden" id="array_events_calendario" data_url="{{route('tarea.gettareasusu',['config_usuario_id' => $usuario->id])}}">
                                    </div>
                                    <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================================================================ -->
<!-- Modales  -->
<!-- ------------------------------------------------------------------------------------------------------------  -->
<!-- Modal proyectos Usuario  -->
<div class="modal fade" id="proyectosModalUsuario" tabindex="-1" aria-labelledby="proyectosModalUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="proyectosModalUsuarioLabel">Modal title</h5>
                <button type="button" class="btn-close boton_cerrar_modal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body table-responsive" style="font-size: 0.8em;">
                <table class="table table-striped table-hover table-sm tabla_data_table_m projects">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Proyecto</th>
                            <th>Lider</th>
                            <th>Miembros de Equipo</th>
                            <th>Gestión/Días</th>
                            <th>Progreso proyecto</th>
                            <th class="text-center">Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="tbody_proyectos_usuario">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info boton_cerrar_modal_pro_usu">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- ------------------------------------------------------------------------------------------------------------  -->
<!-- Modal proyectos Usuario  -->
<div class="modal fade" id="tareasModalUsuario" tabindex="-1" aria-labelledby="tareasModalUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tareasModalUsuarioLabel">Modal title</h5>
                <button type="button" class="btn-close boton_cerrar_modal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body table-responsive" style="font-size: 0.8em;">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tarea</th>
                            <th>Gestión/Días</th>
                            <th>Progreso tarea</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="tbody_tareas_usuario">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info boton_cerrar_modal_tarea_usu">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================================================================ -->
