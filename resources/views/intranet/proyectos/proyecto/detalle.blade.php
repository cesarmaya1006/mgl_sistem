@extends("layouts.app")
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')

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
                                <i class="fa fa-plus-circle mr-3" aria-hidden="true"></i>
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
                                    <b class="d-block">{{ $proyecto->estado }} </b>
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
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Tareas estado normal</span>
                                        <span class="info-box-number text-center text-muted mb-0">1</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Tareas proximas a
                                            vencer</span>
                                        <span
                                            class="info-box-number text-center text-muted mb-0">1</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Tareas vencidas</span>
                                        <span
                                            class="info-box-number text-center text-muted mb-0">1</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                        <h4 class="text-primary">{{ $proyecto->titulo }}</h4>
                        <p class="text-muted">{{ $proyecto->objetivo }}</p>
                        <br>
                        <div class="text-muted">
                            <p class="text-sm">Lider del proyecto
                                <b
                                    class="d-block">{{ $proyecto->lider->nombres . ' ' . $proyecto->lider->apellidos }}</b>
                                <span style="font-size: 0.8em">
                                    {{ $proyecto->lider->empleado->cargo->cargo }}
                                </span>
                            </p>
                            @if ($proyecto->miembros_proyecto->count() > 0)
                                <p class="text-sm">Equipo de trabajo:
                                    @foreach ($proyecto->miembros_proyecto as $empleado)
                                        @if ($empleado->id != $proyecto->config_usuario_id)
                                            <b
                                                class="d-block">{{ $empleado->nombres . ' ' . $empleado->apellidos }}</b>
                                            <span style="font-size: 0.8em">
                                                {{ $empleado->empleado->cargo->cargo }}
                                            </span>
                                        @endif
                                    @endforeach
                                </p>
                            @endif
                        </div>
                        <div class="text-center mt-5 mb-3">
                            <a href="{{ route('proyecto.gestion', ['id' => $proyecto->id]) }}"
                                class="btn btn-sm btn-primary btn-xs pl-3 pr-3 ">Gestionar Proyecto</a>
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
