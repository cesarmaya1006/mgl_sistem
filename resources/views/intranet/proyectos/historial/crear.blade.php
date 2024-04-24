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
            <div class="card-body" style="font-size: 0.85em;">
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
                        <label class="requerido">Usuario</label>
                        <span class="form-control form-control-sm">{{session('rol_id')>3?$usuario->nombres . ' ' . $usuario->apellidos:session('rol.nombre')}}</span>
                        <small id="helpId" class="form-text text-muted">Usuario que registra el historial</small>
                    </div>
                    <div class="col-12 col-md-2 form-group">
                        <label class="requerido">Fecha del historial</label>
                        <span class="form-control form-control-sm">{{date('Y-m-d')}}</span>
                        <small id="helpId" class="form-text text-muted">Fecha registro del historial</small>
                    </div>
                    <div class="col-12 col-md-3 form-group">
                        <label class="requerido" for="titulo">Título historial</label>
                        <input class="form-control form-control-sm" type="text" name="titulo" id="titulo" value="{{ old('titulo'?? '') }}" required>
                        <small id="helpId" class="form-text text-muted">Título historial</small>
                    </div>
                    <div class="col-12 col-md-3 form-group">
                        <label class="requerido" for="usuarioasignado_id">Asignación de tarea</label>
                        <select class="form-control form-control-sm" name="usuarioasignado_id" id="usuarioasignado_id" aria-describedby="helpId" required>
                            <option value="">Seleccione un responsable</option>
                            @foreach ($usuarios as $empleado)
                                <option value="{{$empleado->id}}" {{$usuario->id==$empleado->id?'selected':''}}>{{$empleado->nombres.' '.$empleado->apellidos . ' (' . $empleado->empleado->cargo->cargo . ')'}} {{$tarea->componente->proyecto->config_empresa_id!=$empleado->empleado->cargo->area->config_empresa_id?$empleado->empleado->cargo->area->empresa->nombres:''}}</option>
                            @endforeach
                        </select>
                        <small id="helpId" class="form-text text-muted">Asignación de tarea</small>
                    </div>
                    <div class="col-12 col-md-2 form-group">
                        <label class="requerido" for="progreso">Progreso de la tarea</label>
                        <input type="number" min="{{$tarea->historiales->count()>0?$tarea->historiales->last()->progreso:'0'}}" max="100" value="{{$tarea->historiales->count()>0?$tarea->historiales->last()->progreso:'0'}}" class="form-control form-control-sm text-center" name="progreso" id="progreso" required>
                        <small id="helpId" class="form-text text-muted">Progreso de la tarea</small>
                    </div>
                    <div class="col-12 col-md-9 form-group">
                        <label class="requerido" for="resumen">Resumen / Acción</label>
                        <textarea class="form-control form-control-sm" name="resumen" id="resumen" cols="30" rows="3" style="resize: none;" required></textarea>
                        <small id="helpId" class="form-text text-muted">Descripción del historial</small>
                    </div>
                    @if (floatval($tarea->componente->presupuesto) > 0)
                    <input type="hidden" id="disponible_componente" value="{{$tarea->componente->presupuesto - $tarea->componente->ejecucion}}">
                    <div class="col-12 col-md-2 form-group">
                        <label class="requerido" for="costo">Costo - max({{'$ ' . number_format($tarea->componente->presupuesto - $tarea->componente->ejecucion)}})</label>
                        <input type="number" step="0.01" min="0" max="{{$tarea->componente->presupuesto - $tarea->componente->ejecucion}}" value="0.00" class="form-control form-control-sm text-right" name="costo" id="costo" required>
                        <small id="helpId" class="form-text text-muted">Costo asociado a la tarea</small>
                    </div>
                    @endif
                    <hr>
                    <div class="col-12">
                        <div class="row">
                            <div class=".col-12 col-md-6 form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="add_documentos" id="add_documentos">
                                    <label class="form-check-label" for="add_documentos">
                                        Añadir documentos
                                    </label>
                                    <input type="hidden" id="cant_documentos" value="0">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 d-none" id="caja_btn_sumar_doc">
                                <span class="btn btn-success btn-xs float-end" id="btn_sumar_doc"><i class="fa fa-plus-circle mr-2" aria-hidden="true"></i> Añadir Documento</span>
                            </div>
                        </div>
                        <div class="row caja_documentos d-none" id="caja_documentos">
                            <div class="col-12 d-none bloqueDoc_base" id="bloqueDoc_base">
                                <div class="row">
                                    <div class="col-10 col-md-4">
                                        <div class="form-group">
                                            <label for="doc_historial" class="requerido">Subir Documento</label>
                                            <input type="file" class="form-control form-control-sm" id="doc_historial" name="doc_historial[]" placeholder="Documento Historial" onchange="mostrar()">
                                            <small id="helpId" class="form-text text-muted" id="smallDoc_base"></small>
                                        </div>
                                    </div>
                                    <div class="col-1 d-flex align-items-center col_eliminar_input">
                                        <span class="btn-accion-tabla tooltipsC eliminar_input" title="Eliminar archivo" onclick="eliminar_bloqueDoc_base()"><i class="fa fa-fw fa-trash text-danger"></i></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr>
                    <div class="col-12 mt-3 mb-3 ml-5">
                        <button type="submit" class="btn btn-primary btn-xs pl-5 pr-5">Añadir historial a la Tarea</button>
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
<script src="{{ asset('js/intranet/proyectos/historial/crear.js') }}"></script>
@endsection
<!-- ************************************************************* -->
