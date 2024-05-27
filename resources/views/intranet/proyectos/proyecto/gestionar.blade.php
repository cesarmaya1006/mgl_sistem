@extends("layouts.app")
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')

@endsection
<!-- Pagina CSS -->
@section('estilosHojas')
<link rel="stylesheet" href="{{asset('css/intranet/proyectos/proyecto/gestionar.css')}}">
@endsection
<!-- ************************************************************* -->
@section('titulo_panel')
<i class="fas fa-project-diagram ml-4" aria-hidden="true"></i> Módulo de Proyectos
@endsection
<!-- ************************************************************* -->
@section('contenido')
<div class="row">
    <div class="col-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-4 mb-md-0">
                            <h4 class="card-title">
                                <strong>Gestión de Proyecto - {{$proyecto->titulo}}</strong>
                            </h4>
                        </div>
                        <div class="col-12 col-md-6 mb-4 mb-md-0">
                            <a href="{{route('proyecto.index')}}" class="btn btn-info btn-sm btn-sombra pl-3 pr-5 float-md-end">
                                <i class="fas fa-reply mr-3" aria-hidden="true"></i>
                                Volver
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('includes.mensaje')
                @include('includes.error-form')
                <!--  Sistema Cards  -->
                <div class="row">
                    <div class="col-12 pt-3 pb-3 pl-md-2 pr-md-2" style="background-color: rgba(0, 0, 0, 0.05)">
                        <div class="row mb-3">
                            <div class="col-12">
                                <h6><strong>Datos de proyecto</strong></h6>
                            </div>
                        </div>
                        <div class="row" style="font-size: 0.9em">
                            <div class="col-12 col-md-3">
                                <div class="row">
                                    <div class="col-5 col-md-4 text-right"><strong>Lider del proyecto:</strong></div>
                                    <div class="col-7 col-md-8">{{ $proyecto->lider->nombres . ' ' . $proyecto->lider->apellidos }}</div>
                                </div>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="row">
                                    <div class="col-5 col-md-3 text-right"><strong>Objetivo principal:</strong></div>
                                    <div class="col-7 col-md-9 text-justify">{{ $proyecto->objetivo }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="font-size: 0.9em">
                            <div class="col-12 col-md-3">
                                <div class="row">
                                    <div class="col-5 col-md-4 text-right"><strong>Fecha de creación:</strong></div>
                                    <div class="col-7 col-md-8">{{ $proyecto->fec_creacion }}</div>
                                </div>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="row">
                                    <div class="col-5 col-md-3 text-right"><strong>Estado:</strong></div>
                                    <div class="col-7 col-md-9 text-capitalize"><span class="badge {{$proyecto->estado=='activo'?'badge-success':($proyecto->estado=='extendido'?'badge-danger':($proyecto->estado=='cerrado'?'badge-secondary':'badge-info'))}} pl-4 pr-4"><strong>{{ $proyecto->estado }}</strong></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="font-size: 0.9em">
                            <div class="col-12 col-md-3">
                                <div class="row">
                                    <div class="col-5 col-md-4 text-right"><strong>Progreso:</strong></div>
                                    <div class="col-7 col-md-8">
                                        <?php
                                        switch ($proyecto->progreso) {
                                            case 0:
                                                $color = 'indigo';
                                                break;
                                            case $proyecto->progreso <= 25:
                                                $color='navy';
                                                break;
                                            case $proyecto->progreso <= 50:
                                                $color='dodgerblue';
                                                break;
                                            case $proyecto->progreso <= 75:
                                                $color='aquamarine';
                                                break;
                                            default:
                                                $color='lime';
                                                break;
                                            }
                                            $porcentaje1=$proyecto->progreso;
                                            $porcentaje2 = 100 - $porcentaje1;
                                            $red = 0;
                                            $green = ($porcentaje1 * 255) / 100;
                                            $blue = ($porcentaje2 * 255) / 100;
                                            ?>

                                        <div class="col-8" style="color: {{ $color }}">
                                            {{ number_format($proyecto->progreso, 2, ',', '.') }} %
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="row">
                                    <div class="col-5 col-md-3 text-right"><strong>Tiempo gestión:</strong></div>
                                    <div class="col-7 col-md-9">
                                        <?php
                                        $date1 = new DateTime($proyecto->fec_creacion);
                                        $date2 = new DateTime(Date('Y-m-d'));
                                        $diff = date_diff($date1, $date2);
                                        $differenceFormat = '%a';
                                        ?>
                                        <strong>{{ $diff->format($differenceFormat) }} días</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($proyecto->presupuesto>0)
                        <hr>
                            <div class="row" style="font-size: 0.9em">
                                <div class="col-12 col-md-4">
                                     <div class="row">
                                        <div class="col-8 col-md-5 text-right"><strong>Presupuesto del Proyecto:</strong></div>
                                        <div class="col-4 col-md-7">{{ '$ ' . number_format($proyecto->presupuesto, 2, ',', '.') }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                     <div class="row">
                                        <div class="col-8 col-md-5 text-right"><strong>Ejecución del presupuesto:</strong></div>
                                        <div class="col-4 col-md-7">{{ '$ ' . number_format($proyecto->ejecucion, 2, ',', '.') }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                     <div class="row">
                                        <div class="col-8 col-md-5 text-right"><strong>Porcentaje de ejecución:</strong></div>
                                        <div class="col-4 col-md-7">{{ number_format($proyecto->porc_ejecucion, 2, ',', '.') }} %</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($proyecto->config_usuario_id == session('id_usuario') || session('lider') == 1)
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <a href="{{route('proyecto.expotar_informeproyecto',['id' => $proyecto->id])}}" target="_blank" class="btn btn-success btn-xs btn-sombra pl-3 pr-5 float-md-end">
                                        <i class="fas fa-file-download mr-3" aria-hidden="true"></i>
                                        Exportar Informe
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row" style="background-color: rgba(0, 0, 0, 0.05)">
                    <div class="col-12 col-md-6 pt-3 pl-md-2 pr-md-2">
                        <div class="card card-outline card-secondary collapsed-card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-11">
                                        <h6><strong>Personal asignado al proyecto</strong></h6>
                                    </div>
                                    <div class="col-1">
                                        <div class="card-tools text-end">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-responsive" style="display: none;font-size: 0.9em;">
                                <table class="table-hover table-sm">
                                    <tbody>
                                        @foreach ($proyecto->miembros_proyecto as $usuario)
                                        <tr>
                                            <th scope="row">{{$usuario->nombres . ' ' . $usuario->apellidos}}</th>
                                            <td class="pl-4">{{$usuario->empleado->cargo->cargo}}</td>
                                            <td class="pl-4">{{$usuario->config_empresa_id!=$proyecto->config_empresa_id?$usuario->empresa->nombres:''}} {{$usuario->id == $proyecto->lider->id?' * Líder del Proyecto':''  }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 pt-3 pl-md-2 pr-md-2">
                        <div class="card card-outline card-secondary collapsed-card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-11">
                                        <h6><strong>Clientes y Proveedores</strong></h6>
                                    </div>
                                    <div class="col-1">
                                        <div class="card-tools text-end">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-responsive" style="display: none;font-size: 0.9em;">
                                <p>
                                    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Link with href</a>
                                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Button with data-bs-target</button>
                                </p>
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body">Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row" style="background-color: rgba(0, 0, 0, 0.05)">
                    <div class="col-12 card card-outline card-secondary collapsed-card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-11">
                                    <div class="row">
                                        <div class="col-12 col-md-7">
                                            <h6 class="card-title" style="font-size: 0.98em;"><strong>Componentes del proyecto</strong></h6>
                                        </div>
                                        <div class="col-12 col-md-5 text-md-right mt-2 mt-md-0">
                                            <a href="{{route('componente.create',['proyectos_id'=> $proyecto->id])}}" class="btn btn-primary btn-sm text-center" style="font-size: 0.8em;"><i class="fas fa-plus-circle mr-2"></i> Nuevo componente</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="card-tools float-end">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="font-size: 0.9em;">
                            @if ($proyecto->componentes->count()>0)
                            <div class="row">
                                @foreach ($proyecto->componentes as $componente)
                                <div class="col-12 col-md-4">
                                    <a class="btn btn-light btn-sm pl-5 pr-5" data-bs-toggle="collapse" href="#collapse{{$componente->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        {{$componente->titulo}}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        @foreach ($proyecto->componentes as $componente)
                            <div class="row">
                                <div class="col-12">
                                    <div class="collapse mt-5 mini_sombra_general" style="border-top : solid 1px black;" id="collapse{{$componente->id}}">
                                        <div class="card card-body">
                                            <div class="row mb-5">
                                                <div class="col-12">
                                                    <h6><strong>{{$componente->titulo}}</strong></h6>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="row">
                                                        <div class="col-4 text-right"><strong>Responsable:</strong></div>
                                                        <div class="col-8">
                                                            {{ $componente->responsable->nombres . ' ' . $componente->responsable->apellidos }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4 text-right"><strong>Cargo:</strong></div>
                                                        <div class="col-8">
                                                            {{$componente->responsable->empleado->cargo->cargo }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4 text-right"><strong>Fecha d creación:</strong></div>
                                                        <div class="col-8">{{ $componente->fec_creacion }}</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4 text-right"><strong>Estado:</strong></div>
                                                        <div class="col-8">{{ $componente->estado }}</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4 text-right"><strong>Impacto:</strong></div>
                                                        <div class="col-8">{{ $componente->impacto }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="row">
                                                        <div class="col-4 text-right"><strong>Porcentaje de avance:</strong></div>
                                                        <div class="col-8">
                                                            {{ number_format(intval($componente->progreso), 2, ',', '.') }} %</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4 text-right"><strong>Objetivo:</strong></div>
                                                        <div class="col-8">
                                                            <p class="text-justify">{{ $componente->objetivo }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($proyecto->presupuesto>0)
                                            <hr>
                                            <div class="row" style="font-size: 0.9em">
                                                <div class="col-12 col-md-4">
                                                    <div class="row">
                                                        <div class="col-7 col-md-5 text-right"><strong>Presupuesto del Componente:</strong></div>
                                                        <div class="col-5 col-md-7 text-right text-md-left">{{ '$ ' . number_format($componente->presupuesto, 2, ',', '.') }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <div class="row">
                                                        <div class="col-7 col-md-5 text-right"><strong>Ejecución del presupuesto:</strong></div>
                                                        <div class="col-5 col-md-7 text-right text-md-left">{{ '$ ' . number_format($componente->ejecucion, 2, ',', '.') }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <div class="row">
                                                        <div class="col-7 col-md-5 text-right"><strong>Porcentaje de ejecución:</strong></div>
                                                        <div class="col-5 col-md-7 text-right text-md-left">{{ number_format($componente->porc_ejecucion, 2, ',', '.') }} %</div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            <hr>
                                            <div class="row mb-4 pl-4 w-100">
                                                <div class="col-12">
                                                    <strong>Tareas</strong>
                                                    <a href="{{route('tarea.create',['componente_id'=>$componente->id])}}" class="btn btn-success btn-xs btn-sombra text-center pl-3 pr-3 float-md-right"><i class="fas fa-plus-circle mr-2"></i> Nueva
                                                        tarea</a>
                                                </div>
                                                <div class="col-12 d-flex flex-row">
                                                    <div class="form-check mr-2">
                                                        <input class="form-check-input" type="checkbox" value="todas" id="check_Todas" data_componente="{{$componente->id}}">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                          Todas
                                                        </label>
                                                    </div>
                                                    <div class="form-check mr-2">
                                                        <input class="form-check-input tablaTarea_selector" type="checkbox" value="Activa" data_id="tabla_tareas_componente_{{$componente->id}}" data_url="{{route('tarea.getapitareas',['proy_componentes_id'=>$componente->id,'estado'=>'Activa'])}}" id="check_Activas" data_componente="{{$componente->id}}" checked>
                                                        <label class="form-check-label" for="flexCheckChecked">
                                                          Activas
                                                        </label>
                                                    </div>
                                                    <div class="form-check mr-2">
                                                        <input class="form-check-input tablaTarea_selector" type="checkbox" value="Inactiva" data_id="tabla_tareas_componente_{{$componente->id}}" data_url="{{route('tarea.getapitareas',['proy_componentes_id'=>$componente->id,'estado'=>'Inactiva'])}}" id="check_Inactivas" data_componente="{{$componente->id}}">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                          Inactivas
                                                        </label>
                                                    </div>
                                                      <div class="form-check mr-2">
                                                        <input class="form-check-input tablaTarea_selector" type="checkbox" value="Cerrada" data_id="tabla_tareas_componente_{{$componente->id}}" data_url="{{route('tarea.getapitareas',['proy_componentes_id'=>$componente->id,'estado'=>'Cerrada'])}}" id="check_Cerradas" data_componente="{{$componente->id}}" >
                                                        <label class="form-check-label" for="flexCheckChecked">
                                                          Cerradas
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 table-responsive">
                                                    <table class="table table-striped table-hover table-sm" id="tabla_tareas_componente_{{$componente->id}}">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Id</th>
                                                                <th class="text-center" scope="col">Responsable</th>
                                                                <th class="text-center" scope="col">Titulo</th>
                                                                <th class="text-center" scope="col">Fecha de creación</th>
                                                                <th class="text-center" scope="col">Fecha límite</th>
                                                                <th class="text-center" scope="col">Progreso</th>
                                                                <th class="text-center" scope="col">Estado</th>
                                                                <th class="text-center" scope="col">Impacto</th>
                                                                <th class="text-center" scope="col">Objetivo</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($componente->tareas->where('estado','Activa') as $tarea)
                                                            <tr>
                                                                <td>
                                                                    @if ($tarea->responsable->id == session('id_usuario') || Session('lider')==1)
                                                                    <a href="{{route('tarea.gestion',['id'=>$tarea->id])}}" class="btn-accion-tabla {{$tarea->responsable->id == session('id_usuario')?'text-primary':'text-secondary'}}" title="Gestionar tarea"><i class="fas fa-eye mr-2"></i></a>
                                                                    @else
                                                                    <i class="fas fa-eye-slash"></i>
                                                                    @endif
                                                                </td>
                                                                <td>{{ ucfirst(strtolower($tarea->responsable->nombres)) . ' ' . ucfirst(strtolower($tarea->responsable->apellidos)) }}
                                                                </td>
                                                                <td>{{ $tarea->titulo }}</td>
                                                                <td class="text-center">{{ $tarea->fec_creacion }}</td>
                                                                <td class="text-center">{{ $tarea->fec_limite }}</td>
                                                                <td class="text-center">{{ $tarea->progreso }} %</td>
                                                                <td class="text-center">{{ $tarea->estado }}</td>
                                                                <td class="text-center">{{ $tarea->impacto }}</td>
                                                                <td>{{ $tarea->objetivo }}</td>
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
                            @endforeach
                            @else
                            <div class="row">
                                <div class="col-12">
                                    <h6><strong>Sin Componentes</strong></h6>
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-12">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="background-color: rgba(0, 0, 0, 0.05)">
                    <div class="col-12 card card-outline card-secondary collapsed-card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-11">
                                    <div class="row">
                                        <div class="col-12 col-md-7">
                                            <h6 class="card-title" style="font-size: 0.98em;"><strong>Estadísticas del proyecto</strong></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="card-tools float-end">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="font-size: 0.9em;">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="row">
                                        <div class="col-12"><h5><strong>Ponderacíon de Componentes</strong></h5></div>
                                        <div class="col-12 text-center">
                                            <input type="hidden" id="proyecto_mostrar_proyecto" data_url="{{route('proyecto.proyecto_ponderacion_comp',['id' => $proyecto->id])}}">
                                            <canvas id="pieChart" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="row">
                                        <div class="col-12"><h5><strong>Avance de los Componentes</strong></h5></div>
                                        <div class="col-12 text-center">
                                            <input type="hidden" id="proyecto_avance_comp" data_url="{{route('proyecto.proyecto_avance_comp',['id' => $proyecto->id])}}">
                                            <canvas id="avanceComponentesChart" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="valor_presupuesto" value="{{$proyecto->presupuesto}}">
                            @if ($proyecto->presupuesto> 0)
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12"><h5><strong>Detalles de presupuesto</strong></h5></div>
                                        <div class="col-12 text-center">
                                            <input type="hidden" id="proyecto_presupuesto_comp" data_url="{{route('proyecto.proyecto_presupuesto_comp',['id' => $proyecto->id])}}">
                                            <canvas id="chart_proyecto_presupuesto_comp" class="chartjs-render-monitor" style="max-height: 350px;"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <br><br>
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12"><h5><strong>Diagrama de Gantt ->  tareas</strong></h5></div>
                                        <div class="col-12 table-responsive">
                                            @php

                                                //----------------------------------------------------------
                                                foreach ($proyecto->componentes as $componente) {
                                                    $minFecha[] = $componente->tareas->min('fec_creacion');
                                                    $maxFecha[] = $componente->tareas->max('fec_limite');
                                                }
                                                $minFecha = collect($minFecha);
                                                $maxFecha = collect($maxFecha);
                                                //----------------------------------------------------------
                                                $datetime1 = date_create($minFecha->min());
                                                $datetime2 = date_create($maxFecha->max());
                                                $contador = date_diff($datetime1, $datetime2);
                                                $differenceFormat = '%a';
                                                $cantDiasProyecto = $contador->format($differenceFormat)+1;
                                                //----------------------------------------------------------
                                                //----------------------------------------------------------
                                                $fecha_Ant = date("d-m-Y",strtotime($minFecha->min()."+ 1 days"));
                                                $fechaminComoEntero = strtotime($fecha_Ant);
                                                $dia_min = date("d", $fechaminComoEntero)-1;
                                                $mes_min = date("m", $fechaminComoEntero);
                                                $anio_min = date("Y", $fechaminComoEntero);
                                                $mes_array_1 = [['mes' => $mes_min,'anio' => $anio_min,'colspan' => (cal_days_in_month(CAL_GREGORIAN, $mes_min, $anio_min)),'marca'=>strtotime($anio_min.'-'.$mes_min.'-'.$dia_min)]];
                                                $diasUsados =(cal_days_in_month(CAL_GREGORIAN, $mes_min, $anio_min) );
                                                $numColspan =0;
                                                $sumDias = 0;
                                                for ($i=1; $i < $cantDiasProyecto; $i++) {
                                                    $fechaminComoEntero = strtotime($fecha_Ant);
                                                    $mes_dia_ant = date("m", $fechaminComoEntero);

                                                    $fecha_Sig = date("Y-m-d",strtotime($fecha_Ant."+ " . 1 ." days"));
                                                    $fechaminComoEntero_sig = strtotime($fecha_Sig);
                                                    $dia_dia_sig = date("d", $fechaminComoEntero_sig);
                                                    $mes_dia_sig = date("m", $fechaminComoEntero_sig);
                                                    $anio_sig = date("Y", $fechaminComoEntero_sig);
                                                    if ($mes_dia_ant!=$mes_dia_sig) {
                                                        $dias_mes = cal_days_in_month(CAL_GREGORIAN, $mes_dia_sig, $anio_sig);
                                                        if (($dias_mes + $diasUsados) > $cantDiasProyecto) {
                                                            $numColspan = ($cantDiasProyecto - $diasUsados);
                                                        } else {
                                                            $numColspan = $dias_mes;
                                                        }
                                                        $mes_array_1[] = ['mes' => $mes_dia_sig,'anio' => $anio_sig,'colspan' => $numColspan,'marca'=>strtotime($anio_sig.'-'.$mes_dia_sig.'-'.$dia_dia_sig)];
                                                        $diasUsados += $dias_mes;
                                                    }
                                                    //-------------------------------------------------------------------

                                                    $fecha_Ant = $fecha_Sig;
                                                }
                                                //----------------------------------------------------------
                                                date_default_timezone_set("America/Bogota");
                                                setlocale(LC_TIME, 'es_VE.UTF-8','esp');
                                            @endphp
                                            <table class="table table-hover table-sm table-bordered tabla_data_table_gantt" style="font-size: 0.85em; max-height: 500px;">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" rowspan="2" >

                                                        </th>
                                                        @foreach ($mes_array_1 as $mes)
                                                            <th class="text-center" colspan="{{$mes['colspan']}}" scope="col">
                                                                {{  ucwords(utf8_encode(strftime('%B', $mes['marca'])))}}
                                                            </th>
                                                        @endforeach
                                                    </tr>
                                                    <tr>
                                                        @for ($i = 1; $i < ($cantDiasProyecto+1); $i++)
                                                            <td class="text-center pl-3 pr-5" scope="col">
                                                                @php
                                                                date_default_timezone_set("America/Caracas");
                                                                setlocale(LC_TIME, 'es_VE.UTF-8','esp');
                                                                $marca = strtotime(date("Y-m-d",strtotime($minFecha->min() ."+ ".($i-1)." days")));
                                                                @endphp
                                                                <strong>{{  ucfirst(utf8_encode(strftime('%A', $marca)))}}</strong>
                                                                <br>
                                                                {{  utf8_encode(strftime('%e %b', $marca))}}
                                                            </td>
                                                        @endfor
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($proyecto->componentes as $componente)
                                                        @foreach ($componente->tareas as $tarea)
                                                            <tr>
                                                                <td class="pl-1">
                                                                    <span class="d-flex flex-row">
                                                                        <i class="fas fa-play mr-1 mt-1" aria-hidden="true"></i><h6><strong>{{$componente->titulo}}</strong></h6>
                                                                    </span>
                                                                    <i class="fa fa-caret-right mr-1" aria-hidden="true"></i> {{$tarea->titulo}}
                                                                </td>
                                                                @php
                                                                    $x = 1;
                                                                    $date_tarea_lim = date_create($tarea->fec_limite);
                                                                    $date_tarea_cre = date_create($tarea->fec_creacion);
                                                                    $diasTarea = date_diff($date_tarea_lim, $date_tarea_cre);
                                                                    $differenceFormat = '%a';
                                                                    $diferencia_dias = $diasTarea->format($differenceFormat)+1;
                                                                    $totalFor = ($cantDiasProyecto-$diferencia_dias)+1;
                                                                    //---------------------------------------------------------
                                                                    $date_start = strtotime($tarea->fec_creacion);
                                                                    $date_end = strtotime($tarea->fec_limite);
                                                                @endphp
                                                                @for ($i = 1; $i < ($cantDiasProyecto+1); $i++)
                                                                    @php
                                                                        $date_now = strtotime(date("Y-m-d",strtotime($minFecha->min() ."+ ".($i-1)." days")));
                                                                        $date_hoy = strtotime(date("Y-m-d"));

                                                                    @endphp
                                                                    @if (($date_now >= $date_start) && ($date_now <= $date_end))
                                                                        @php
                                                                            $color='';
                                                                            if ($tarea->impacto_num == 10) {
                                                                                $color = 'rgba(' . rand(200, 250) . ',' . rand(10, 200) . ',' . rand(10, 200) . ',0.5)'; # code...
                                                                            } elseif ($tarea->impacto_num == 20) {
                                                                                $color = 'rgba(' . rand(10, 200) . ',' . rand(200, 250) . ',' . rand(10, 200) . ',0.5)'; # code...
                                                                            } elseif ($tarea->impacto_num == 30) {
                                                                                $color = 'rgba(' . rand(10, 200) . ',' . rand(200, 250) . ',' . rand(10, 200) . ',0.5)'; # code...
                                                                            } elseif ($tarea->impacto_num == 40) {
                                                                                $color = 'rgba(' . rand(200, 250) . ',' . rand(10, 200) . ',' . rand(10, 200) . ',0.5)'; # code...
                                                                            } else {
                                                                                $color = 'rgba(' . rand(10, 200) . ',' . rand(200, 250) . ',' . rand(10, 200) . ',0.5)';
                                                                            }
                                                                        @endphp
                                                                        <td class="pl-3 pr-5 pt-2 pb-2" colspan="{{$diferencia_dias}}" style="background-color: {{$color}};">
                                                                            <div class="progress-group m-2">
                                                                                <span >
                                                                                    <ul>
                                                                                        <li style="list-style-type: none;"><h6><strong>{{$tarea->titulo}}</strong></h6></li>
                                                                                        <li style="list-style-type: none;"><strong>Responsable: {{$tarea->responsable->nombres . ' ' . $tarea->responsable->apellidos}}</strong></li>
                                                                                        <li style="list-style-type: none;"><strong>Avance: {{$tarea->progreso . '%'}}</strong></li>
                                                                                        <li style="list-style-type: none;"><strong>Estado: <h6> <span class="badge {{$date_hoy < $date_end?'bg-info':'bg-danger'}}" style="min-width: 20px; min-height: 5px;">{{$date_hoy < $date_end?'Activa':'Vencida'}}</span></h6></strong></li>
                                                                                    </ul>
                                                                                </span>
                                                                                <div class="progress progress-sm">
                                                                                    <div class="progress-bar bg-primary" style="width: {{$tarea->progreso}}%"></div>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        @for ($a = 1; $a < $diferencia_dias; $a++)
                                                                            <td style="display:none;"></td>
                                                                        @endfor
                                                                        @php
                                                                            $i+=$diferencia_dias-1;
                                                                        @endphp
                                                                    @else
                                                                        <td ></td>
                                                                    @endif
                                                                @endfor
                                                            </tr>
                                                        @endforeach
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin Sistema Cards  -->
            </div>
        </div>
    </div>
</div>
<!-- Modales  -->

<!-- ============================================================================================================ -->

<!-- Fin Modales  -->
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('scripts_pagina')

<!-- ============================================================= -->
<!-- ChartJS -->
<script src="{{asset('js/intranet/general/chart.js')}}"></script>
<!-- ============================================================= -->
<script src="{{ asset('js/intranet/proyectos/proyecto/gestionar.js') }}"></script>
@endsection
<!-- ************************************************************* -->
