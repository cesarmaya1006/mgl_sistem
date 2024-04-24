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
    <div class="col-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-4 mb-md-0">
                            <h4 class="card-title">
                                <strong>Nuevo Componente</strong>
                            </h4>
                        </div>
                        <div class="col-12 col-md-6 mb-4 mb-md-0">
                            <a href="{{ route('proyecto.gestion', ['id' => $proyecto->id]) }}" class="btn btn-info btn-sm btn-sombra text-center pl-3 pr-3 float-end" style="font-size: 0.9em;">
                                <i class="fas fa-reply mr-2"></i>
                                Volver
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row d-flex justify-content-center">
                    <div class="col-12">
                        @include('includes.mensaje')
                        @include('includes.error-form')
                    </div>
                </div>
                <form class="row d-flex justify-content-between" action="{{route('componente.store')}}" method="POST" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <input type="hidden" name="proyectos_id" value="{{$proyecto->id}}">
                    <input type="hidden" name="fec_creacion" value="{{date('Y-m-d')}}">
                    <div class="col-12 col-md-2 form-group">
                        <label class="requerido" for="fecha">Fecha</label>
                        <span class="form-control form-control-sm text-center">{{date('Y-m-d')}}</span>
                        <small id="helpId" class="form-text text-muted">Fecha</small>
                    </div>
                    <div class="col-12 col-md-3 form-group">
                        <label for="config_usuario_id">Responsable del componente</label>
                        <select class="form-control form-control-sm" name="config_usuario_id" id="config_usuario_id" aria-describedby="helpId" required>
                            <option value="">Seleccione un responsable</option>
                            @foreach ($usuarios as $empleado)
                                <option value="{{$empleado->id}}">{{$empleado->nombres.' '.$empleado->apellidos . ' (' . $empleado->empleado->cargo->cargo . ')'}} {{$proyecto->config_empresa_id!=$empleado->empleado->cargo->area->config_empresa_id?$empleado->empleado->cargo->area->empresa->nombres:''}}</option>
                            @endforeach
                        </select>
                        <small id="helpId" class="form-text text-muted">Responsable del componente</small>
                    </div>
                    <div class="col-12 col-md-4 form-group">
                        <label for="titulo">Titulo del componente</label>
                        <input type="text" class="form-control form-control-sm" name="titulo" id="titulo" required>
                        <small id="helpId" class="form-text text-muted">Titulo del componente</small>
                    </div>
                    <div class="col-12 col-md-2 form-group">
                        <label for="impacto">Impacto del componente</label>
                        <select class="form-control form-control-sm" name="impacto" id="impacto" aria-describedby="helpId" required>
                            <option value="">Selec. impacto</option>
                            <option value="Alto">Alto</option>
                            <option value="Medio-alto">Medio-alto</option>
                            <option value="Medio">Medio</option>
                            <option value="Medio-bajo">Medio-bajo</option>
                            <option value="Bajo">Bajo</option>
                        </select>
                        <small id="helpId" class="form-text text-muted">Impacto del componente</small>
                    </div>
                    <div class="col-12 col-md-6 form-group">
                        <label for="objetivo">Objetivo del componente</label>
                        <textarea class="form-control form-control-sm" name="objetivo" id="objetivo" cols="30" rows="3" style="resize: none;" required></textarea>
                        <small id="helpId" class="form-text text-muted">Objetivo del componente</small>
                    </div>
                    @if (intval($proyecto->presupuesto)>0)
                    <div class="col-12">
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <h6><strong>Componente Financiero</strong></h6>
                            </div>
                            <input type="hidden" id="presupuesto_proyecto" value="{{intval($proyecto->presupuesto)}}">
                            <input type="hidden" id="sum_presupuesto_componentes" value="{{intval($proyecto->componentes->sum('presupuesto'))}}">
                            <input type="hidden" id="disponible_componentes" value="{{$proyecto->presupuesto - $proyecto->componentes->sum('presupuesto')}}">
                            <div class="col-12 col-md-2 form-group">
                                <label for="presupuesto">Presupuesto del Componente</label>
                                <input type="number"
                                       min="0"
                                       max="{{$proyecto->presupuesto - $proyecto->componentes->sum('presupuesto')}}"
                                       value="0.00"
                                       step="0.01"
                                       class="form-control form-control-sm text-end"
                                       name="presupuesto"
                                       id="presupuesto"
                                       required>
                                <small id="helpId" class="form-text text-muted">Presupuesto del componente</small>
                            </div>
                            <div class="col-12 col-md-3 ml-md-5">
                                <span class="form-control form-control-sm">Presupuesto de total del proyecto: <strong class="float-end">$ {{number_format($proyecto->presupuesto,2)}}</strong></span>
                                <span class="form-control form-control-sm">Presupuesto de asignado del proyecto: <strong class="float-end">$ {{number_format($proyecto->componentes->sum('presupuesto'),2)}}</strong></span>
                                <span class="form-control form-control-sm">Presupuesto de disponible del proyecto: <strong class="float-end">$ {{number_format($proyecto->presupuesto - $proyecto->componentes->sum('presupuesto'),2)}}</strong></span>
                            </div>
                        </div>
                        <hr>
                    </div>
                    @endif
                    <div class="col-12 mt-3 mb-3 ml-5">
                        <button type="submit" class="btn btn-primary btn-xs pl-5 pr-5">Crear Componente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('scripts_pagina')
<script src="{{ asset('js/intranet/proyectos/componente/crear.js') }}"></script>
<script src="{{ asset('js/intranet/general/popper.min.js') }}"></script>
@endsection
<!-- ************************************************************* -->
