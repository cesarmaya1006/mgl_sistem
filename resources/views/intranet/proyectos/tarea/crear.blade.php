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
                                <strong>Nueva Tarea</strong>
                            </h4>
                        </div>
                        <div class="col-12 col-md-6 mb-4 mb-md-0">
                            <a href="{{ route('proyecto.gestion', ['id' => $componente->proyecto->id]) }}" class="btn btn-info btn-sm btn-sombra text-center pl-3 pr-3 float-end" style="font-size: 0.9em;">
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
                <form class="row d-flex justify-content-between" action="{{route('tarea.store')}}" method="POST" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <input type="hidden" name="proy_componentes_id" value="{{$componente->id}}">
                    <input type="hidden" name="fec_creacion" value="{{date('Y-m-d')}}">
                    <div class="col-12 col-md-2 form-group">
                        <label for="fecha">Fecha inicio</label>
                        <input class="form-control form-control-sm" type="date" name="fec_creacion" id="fec_creacion" value="{{ date('Y-m-d') }}" required>
                        <small id="helpId" class="form-text text-muted">Fecha inicio</small>
                    </div>
                    <div class="col-12 col-md-2 form-group">
                        <label for="fec_limite">Fecha límite</label>
                        <input type="date" class="form-control form-control-sm" name="fec_limite" min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" id="fec_limite">
                        <small id="helpId" class="form-text text-muted">Fecha límite</small>
                    </div>
                    <div class="col-12 col-md-3 form-group">
                        <label for="config_usuario_id">Responsable de la tarea</label>
                        <select class="form-control form-control-sm" name="config_usuario_id" id="config_usuario_id" aria-describedby="helpId" required>
                            <option value="">Seleccione un responsable</option>
                            @foreach ($usuarios as $empleado)
                                <option value="{{$empleado->id}}">{{$empleado->nombres.' '.$empleado->apellidos . ' (' . $empleado->empleado->cargo->cargo . ')'}} {{$componente->proyecto->config_empresa_id!=$empleado->empleado->cargo->area->config_empresa_id?$empleado->empleado->cargo->area->empresa->nombres:''}}</option>
                            @endforeach
                        </select>
                        <small id="helpId" class="form-text text-muted">Responsable de la tarea</small>
                    </div>
                    <div class="col-12 col-md-4 form-group">
                        <label for="titulo">Titulo de la tarea</label>
                        <input type="text" class="form-control form-control-sm" name="titulo" id="titulo" required>
                        <small id="helpId" class="form-text text-muted">Titulo de la tarea</small>
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
                    <div class="col-12 col-md-9 form-group">
                        <label for="objetivo">Objetivo del componente</label>
                        <textarea class="form-control form-control-sm" name="objetivo" id="objetivo" cols="30" rows="3" style="resize: none;" required></textarea>
                        <small id="helpId" class="form-text text-muted">Objetivo del componente</small>
                    </div>
                    <div class="col-12 mt-3 mb-3 ml-5">
                        <button type="submit" class="btn btn-primary btn-xs pl-5 pr-5">Crear Tarea</button>
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

@endsection
<!-- ************************************************************* -->
