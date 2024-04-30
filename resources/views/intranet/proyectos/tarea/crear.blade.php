@extends('layouts.app')
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
                                <a href="{{ route('proyecto.gestion', ['id' => $componente->proyecto->id]) }}"
                                    class="btn btn-info btn-sm btn-sombra text-center pl-3 pr-3 float-end"
                                    style="font-size: 0.9em;">
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
                    <form class="row d-flex justify-content-between" action="{{ route('tarea.store') }}" method="POST"
                        autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <input type="hidden" name="proy_componentes_id" value="{{ $componente->id }}">
                        <input type="hidden" name="fec_creacion" value="{{ date('Y-m-d') }}">
                        <div class="col-12 col-md-2 form-group">
                            <label class="requerido" for="fecha">Fecha inicio</label>
                            <input class="form-control form-control-sm" type="date" name="fec_creacion" id="fec_creacion" value="{{ date('Y-m-d') }}" required>
                            <small id="helpId" class="form-text text-muted">Fecha inicio</small>
                        </div>
                        <div class="col-12 col-md-2 form-group">
                            <label class="requerido" for="fec_limite">Fecha límite</label>
                            <input type="date" class="form-control form-control-sm" name="fec_limite" min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" id="fec_limite">
                            <small id="helpId" class="form-text text-muted">Fecha límite</small>
                        </div>
                        <div class="col-12 col-md-3 form-group">
                            <label class="requerido" for="config_usuario_id">Responsable de la tarea</label>
                            <select class="form-control form-control-sm" name="config_usuario_id" id="config_usuario_id" aria-describedby="helpId" required>
                                <option value="">Seleccione un responsable</option>
                                @foreach ($usuarios as $empleado)
                                    <option value="{{ $empleado->id }}">
                                        {{ $empleado->nombres . ' ' . $empleado->apellidos . ' (' . $empleado->empleado->cargo->cargo . ')' }}
                                        {{ $componente->proyecto->config_empresa_id != $empleado->empleado->cargo->area->config_empresa_id ? $empleado->empleado->cargo->area->empresa->nombres : '' }}
                                    </option>
                                @endforeach
                            </select>
                            <small id="helpId" class="form-text text-muted">Responsable de la tarea</small>
                        </div>
                        <div class="col-12 col-md-4 form-group">
                            <label class="requerido" for="titulo">Titulo de la tarea</label>
                            <input type="text" class="form-control form-control-sm" name="titulo" id="titulo" required>
                            <small id="helpId" class="form-text text-muted">Titulo de la tarea</small>
                        </div>
                        <div class="col-12 col-md-2 form-group">
                            <label class="requerido" for="impacto">Impacto del componente</label>
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
                            <label class="requerido" for="objetivo">Objetivo de la tarea</label>
                            <textarea class="form-control form-control-sm" name="objetivo" id="objetivo" cols="30" rows="3" style="resize: none;" required></textarea>
                            <small id="helpId" class="form-text text-muted">Objetivo de la tarea</small>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="repeticion_tarea" name="repeticion_tarea">
                                        <label class="form-check-label" for="repeticion_tarea">Repetición de la tarea</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row d-none" id="caja_repeticiones">
                                <div class="col-12 col-md-2 form-group">
                                    <label class="requerido" for="num_repeticiones">Repetir cada</label>
                                    <input type="number" class="form-control form-control-sm" name="num_repeticiones" id="num_repeticiones" min="1"  value="1" required>
                                </div>
                                <div class="col-12 col-md-2 form-group">
                                    <label class="requerido" for="periodo_repeticion">Periodo</label>
                                    <select class="form-control form-control-sm" name="periodo_repeticion" id="periodo_repeticion" aria-describedby="helpId" required>
                                        <option value="dia">día</option>
                                        <option value="semana" selected>semana</option>
                                        <option value="mes">mes</option>
                                        <option value="anno">año</option>
                                    </select>
                                </div>
                                <div class="col-12 mt-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <h6><strong>Termina en</strong></h6>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="termina_radio" id="termina_radio1" value="repeticiones" checked>
                                                <label class="form-check-label" for="termina_radio1">Repeticiones</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="termina_radio" id="termina_radio2" value="fecha">
                                                <label class="form-check-label" for="termina_radio2">Fecha</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3" id="caja_repeticiones1">
                                            <label class="requerido" for="cant_repeticiones">Repetir cant</label>
                                            <input type="number" class="form-control form-control-sm" name="cant_repeticiones" id="cant_repeticiones" min="1"  value="1" required>
                                            <small id="helpId" class="form-text text-muted">número max repeticiones</small>
                                        </div>
                                        <div class="col-12 col-md-3 d-none" id="caja_repeticiones2">
                                            <label class="requerido" for="fec_termino_repeticion">Fecha Ult. Repetición</label>
                                            <input class="form-control form-control-sm" type="date" name="fec_termino_repeticion" id="fec_termino_repeticion" value="{{ date('Y-m-d') }}" required>
                                            <small id="helpId" class="form-text text-muted">Última fecha de repetición</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <hr>
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
<script src="{{ asset('js/intranet/proyectos/tareas/crear.js') }}"></script>
@endsection
<!-- ************************************************************* -->
