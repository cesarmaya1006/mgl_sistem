@extends("layouts.app")
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')
@php
$tareasVige = 0;
$tareasProx = 0;
$tareasVenc = 0;
foreach ($proyecto->componentes as $componente) {
    foreach ($componente->tareas as $tarea) {
        //-------------------------------------------------
        $date1 = new DateTime($tarea->fec_creacion);
        $date2 = new DateTime($tarea->fec_limite);
        $diff = date_diff($date1, $date2);
        $differenceFormat = '%a';
        $diasTotalTarea = $diff->format($differenceFormat);
        if($diasTotalTarea==0){
            $diasTotalTarea=1;
        }
        //-------------------------------------------------
        $date1 = new DateTime($tarea->fec_creacion);
        $date2 = new DateTime(date('Y-m-d'));
        $diff = date_diff($date1, $date2);
        $differenceFormat = '%a';
        $diasGestionTarea = $diff->format($differenceFormat);
        //---------------------------------------------------
        $porcVenc = ($diasGestionTarea * 100) / $diasTotalTarea;
        //---------------------------------------------------
        if (session('rol_id' < 3 || $proyecto->config_usuario_id == session('id_usuario'))) {
            if ($tarea->fec_limite < date('Y-m-d')) {
                $tareasVenc++;
            } else if($porcVenc > 80){
                $tareasProx++;
            }else{
                $tareasVige++;
            }
        } else {
            if ($tarea->config_usuario_id == session('id_usuario')) {
                if ($tarea->fec_limite < date('Y-m-d')) {
                    $tareasVenc++;
                } else if($porcVenc > 80){
                    $tareasProx++;
                }else{
                    $tareasVige++;
                }
            }
        }
    }
}
@endphp
@endsection
<!-- Pagina CSS -->
@section('estilosHojas')

@endsection
<!-- ************************************************************* -->
@section('titulo_panel')
<i class="fas fa-project-diagram ml-4" aria-hidden="true"></i> Módulo de Proyectos
@endsection
<!-- ************************************************************* -->
@section('contenido')
<div class="row">
    <input type="hidden" class="link_item_card_2">

    <div class="col-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-4 mb-md-0">
                            <h4 class="card-title">
                                <strong>Detalle Proyecto {{$proyecto->nombres}}</strong>
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
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                        <div class="row d-flex justify-content-around">
                            <div class="col-4 col-md-3">
                                <p class="text-sm">Estado Proyecto
                                    <b class="d-block text-capitalize">{{ $proyecto->estado }} </b>
                                </p>
                            </div>
                            <div class="col-4 col-md-3">
                                <p class="text-sm">Progreso Proyecto
                                    <b class="d-block">{{ number_format($proyecto->progreso, 2, ',', '.') }} %</b>
                                </p>
                            </div>
                            <div class="col-4 col-md-3">
                                <p class="text-sm">Días de Gestión
                                    <?php
                                    $date1 = new DateTime($proyecto->fec_creacion);
                                    $date2 = new DateTime(Date('Y-m-d'));
                                    $diff = date_diff($date1, $date2);
                                    $differenceFormat = '%a';
                                    ?>
                                    <b class="d-block">{{ $diff->format($differenceFormat) }} días</b>
                                </p>
                            </div>
                        </div>
                        @if ($proyecto->presupuesto>0)
                            <div class="row d-flex justify-content-around">
                                <div class="col-4 col-md-3">
                                    <p class="text-sm">Presupuesto del Proyecto
                                        <b class="d-block text-capitalize">{{ '$ ' . number_format($proyecto->presupuesto, 2, ',', '.') }}</b>
                                    </p>
                                </div>
                                <div class="col-4 col-md-3">
                                    <p class="text-sm">Ejecución del presupuesto
                                        <b class="d-block">{{ '$ ' . number_format($proyecto->ejecucion, 2, ',', '.') }}</b>
                                    </p>
                                </div>
                                <div class="col-4 col-md-3">
                                    <p class="text-sm">Porcentaje de ejecución
                                        <b class="d-block">{{ number_format($proyecto->porc_ejecucion, 2, ',', '.') }} %</b>
                                    </p>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Tareas estado normal</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{ $tareasVige }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Tareas proximas a
                                            vencer</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{ $tareasProx }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Tareas vencidas</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{ $tareasVenc }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h5>Actividad Reciente</h5>
                                <!-- *************************************** -->
                                <!-- Activiadad Reciente -->
                                @foreach ($proyecto->componentes as $componente)
                                    <a class="row mt-4" data-bs-toggle="collapse" href="#collapsecomponente{{$componente->id}}" role="button" aria-expanded="false" aria-controls="collapsecomponente{{$componente->id}}">
                                        <div class="col-12 d-flex flex-row pb-2" style="border-bottom: 1px outset grey">
                                            <h6 class="mr-5">
                                                {{ $componente->titulo }}</h6>
                                            <div class="project_progress" style="width: 25%;">
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-green" role="progressbar"
                                                        aria-volumenow="{{ $componente->progreso }}" aria-volumemin="0"
                                                        aria-volumemax="100" style="width: {{ $componente->progreso }}%">
                                                    </div>
                                                </div>
                                                <small>
                                                    {{ number_format($componente->progreso, 2, ',', '.') }} %
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                                @foreach ($proyecto->componentes as $componente)
                                <div class="row mt-4 collapse" id="collapsecomponente{{$componente->id}}">
                                    <div class="col-12 mb-3">
                                        <h6><strong>Detalle Componenete  {{$componente->titulo}}</strong></h6>
                                    </div>
                                    <?php $cantBorde = 0; ?>
                                    @foreach ($componente->tareas as $tarea)
                                        <?php $cantBorde++; ?>
                                        <div class="col-12 pl-3 pt-3 {{ $cantBorde > 1 ? 'border-top' : '' }}">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h6>{{ $tarea->titulo }}</h6>
                                                    <div class="project_progress" style="width: 25%;">
                                                        <div class="progress progress-sm">
                                                            <div class="progress-bar bg-gradient-blue"
                                                                role="progressbar"
                                                                aria-volumenow="{{ $tarea->progreso }}"
                                                                aria-volumemin="0" aria-volumemax="100"
                                                                style="width: {{ $tarea->progreso }}%">
                                                            </div>
                                                        </div>
                                                        <small>
                                                            {{ number_format($tarea->progreso, 2, ',', '.') }} %
                                                        </small>
                                                    </div>
                                                </div>
                                                @if ($tarea->historiales->count() > 0)
                                                    <?php $cantHistoriales = 1; ?>
                                                    @foreach ($tarea->historiales as $historial)
                                                        @if ($cantHistoriales < 2)
                                                            <div class="col-12">
                                                                <div class="post">
                                                                    <div class="user-block">
                                                                        <img class="img-circle img-bordered-sm"
                                                                             title="{{ $historial->responsable->nombres . ' ' . $historial->responsable->apellidos }}"
                                                                             src="{{ asset('imagenes/hojas_de_vida/' . $historial->responsable->foto) }}"
                                                                             alt="{{ $historial->responsable->nombres . ' ' . $historial->responsable->apellidos }}">
                                                                        <span
                                                                            class="username">{{ $historial->responsable->nombres . ' ' . $historial->responsable->apellidos }}</span>
                                                                        <span
                                                                            class="description">{{ $historial->titulo }}
                                                                            -
                                                                            {{ $historial->fecha . '  ' . Date('H:i:s', strtotime($historial->created_at)) }}</span>
                                                                        <span class="description">
                                                                            {{ $historial->resumen }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <?php $cantHistoriales++; ?>
                                                    @endforeach
                                                @else
                                                    <div class="col-12">Tarea sin historial</div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @endforeach
                                <!-- *************************************** -->
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                        <h4 class="text-primary">{{ $proyecto->titulo }}</h4>
                        <p class="text-muted">{{ $proyecto->objetivo }}</p>
                        <br>
                        <div class="text-muted">
                            <p class="text-sm">Lider del proyecto
                                <b class="d-block">{{ $proyecto->lider->nombres . ' ' . $proyecto->lider->apellidos }}</b>
                                <span style="font-size: 0.8em">
                                    {{ $proyecto->lider->empleado->cargo->cargo }}
                                </span>
                            </p>
                            @if ($proyecto->miembros_proyecto->count() > 0)
                                <p class="text-sm">Equipo de trabajo: </p>
                                <p class="text-sm">
                                    <div class="table-responsive" style="font-size: 0.8em">
                                        <table class="table">
                                            <tbody>
                                                @foreach ($proyecto->miembros_proyecto as $empleado)
                                                    @if ($empleado->id != $proyecto->config_usuario_id)
                                                        <tr>
                                                            <td><b class="d-block">{{ $empleado->nombres . ' ' . $empleado->apellidos }}</b></td>
                                                            <td><span style="font-size: 0.9em">{{ $empleado->empleado->cargo->cargo }}</span></td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </p>
                            @endif
                        </div>
                        <div class="text-center mt-5 mb-3">
                            <a href="{{ route('proyecto.gestion', ['id' => $proyecto->id]) }}" class="btn btn-sm btn-primary btn-xs pl-3 pr-3 ">Gestionar Proyecto</a>
                        </div>
                    </div>
                </div>
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

@endsection
<!-- ************************************************************* -->
