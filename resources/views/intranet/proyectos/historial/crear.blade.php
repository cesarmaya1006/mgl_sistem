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
                                <strong>Nuevo historial</strong>
                            </h4>
                        </div>
                        <div class="col-12 col-md-6 mb-4 mb-md-0">
                            <a href="{{ route('tarea.gestion', ['id' => $tarea->id]) }}" class="btn btn-info btn-sm btn-sombra text-center pl-3 pr-3 float-end" style="font-size: 0.9em;">
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
                <form class="row d-flex justify-content-between" action="{{route('historial.store')}}" method="POST" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <input type="hidden" name="proy_tareas_id" value="{{$tarea->id}}">
                    <input type="hidden" name="fecha" value="{{date('Y-m-d')}}">
                    <input type="hidden" name="config_usuario_id" value="{{$usuario->id}}">
                    <div class="col-12 col-md-2 form-group">
                        <label>Usuario</label>
                        <span class="form-control form-control-sm">{{session('rol_id')>3?$usuario->nombres . ' ' . $usuairo->apellidos:session('rol.nombre')}}</span>
                        <small id="helpId" class="form-text text-muted">Usuario que registra el historial</small>
                    </div>
                    <div class="col-12 col-md-2 form-group">
                        <label>Fecha del historial</label>
                        <span class="form-control form-control-sm">{{date('Y-m-d')}}</span>
                        <small id="helpId" class="form-text text-muted">Fecha registro del historial</small>
                    </div>
                    <div class="col-12 col-md-3 form-group">
                        <label for="titulo">Título historial</label>
                        <input class="form-control form-control-sm" type="text" name="titulo" id="titulo" value="{{ old('titulo'?? '') }}" required>
                        <small id="helpId" class="form-text text-muted">Título historial</small>
                    </div>
                    <div class="col-12 col-md-3 form-group">
                        <label for="usuarioasignado_id">Asignación de tarea</label>
                        <select class="form-control form-control-sm" name="usuarioasignado_id" id="usuarioasignado_id" aria-describedby="helpId" required>
                            <option value="">Seleccione un responsable</option>
                            @foreach ($usuarios as $empleado)
                                <option value="{{$empleado->id}}">{{$empleado->nombres.' '.$empleado->apellidos . ' (' . $empleado->empleado->cargo->cargo . ')'}} {{$tarea->componente->proyecto->config_empresa_id!=$empleado->empleado->cargo->area->config_empresa_id?$empleado->empleado->cargo->area->empresa->nombres:''}}</option>
                            @endforeach
                        </select>
                        <small id="helpId" class="form-text text-muted">Asignación de tarea</small>
                    </div>
                    <div class="col-12 col-md-2 form-group">
                        <label for="progreso">Progreso de la tarea</label>
                        <input type="number" min="{{$tarea->historiales->count()>0?$tarea->historiales->last()->progreso:'0'}}" max="100" value="{{$tarea->historiales->count()>0?$tarea->historiales->last()->progreso:'0'}}" class="form-control form-control-sm text-center" name="progreso" id="progreso" required>
                        <small id="helpId" class="form-text text-muted">Progreso de la tarea</small>
                    </div>
                    <div class="col-12 col-md-9 form-group">
                        <label for="resumen">Resumen / Acción</label>
                        <textarea class="form-control form-control-sm" name="resumen" id="resumen" cols="30" rows="3" style="resize: none;" required></textarea>
                        <small id="helpId" class="form-text text-muted">Descripción del historial</small>
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
