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
                            <h6 class="card-title" style="font-size: 0.98em;"><strong>Componentes del proyecto</strong></h6>
                            <div class="card-tools">
                                <a href="{{route('componente.create',['proyectos_id'=> $proyecto->id])}}" class="btn btn-primary btn-sm text-center mr-4" style="font-size: 0.8em;"><i class="fas fa-plus-circle mr-2"></i> Nuevo componente</a>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
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
                                            <hr>
                                            <div class="row mb-4 pl-4 w-100">
                                                <div class="col-12">
                                                    <strong>Tareas</strong>
                                                    <a href="{{route('tarea.create',['componente_id'=>$componente->id])}}" class="btn btn-success btn-xs btn-sombra text-center pl-3 pr-3 float-md-right"><i class="fas fa-plus-circle mr-2"></i> Nueva
                                                        tarea</a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 table-responsive">
                                                    <table class="table table-striped table-hover table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center"></th>
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
                                                            @foreach ($componente->tareas as $tarea)
                                                            <tr>
                                                                <td>
                                                                    <a href="{{route('tarea.gestion',['id'=>$tarea->id])}}" class="btn-accion-tabla text-primary" title="Gestionar tarea"><i class="fas fa-eye mr-2"></i></a>
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
<script src="{{ asset('js/intranet/proyectos/proyecto/gestionar.js') }}"></script>
@endsection
<!-- ************************************************************* -->
