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
                            <a href="{{ route('tarea.gestion', ['id' => $historial->tarea->id]) }}" class="btn btn-info btn-sm btn-sombra text-center pl-3 pr-3 float-end" style="font-size: 0.9em;">
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
                <form
                    class="row d-flex justify-content-between"
                    action="{{route('doc_historial.store')}}"
                    method="POST"
                    accept-charset="UTF-8"
                    autocomplete="off"
                    enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <input type="hidden" name="proy_historiales_id" value="{{$proy_historiales_id}}">
                    <input type="hidden" id="cant_documentos" value="0">
                    <div class="col-12">
                        <div class="row">
                            <div class=".col-12 col-md-6 form-group">
                            </div>
                            <div class="col-12 col-md-6 " id="caja_btn_sumar_doc">
                                <span class="btn btn-success btn-xs float-end" id="btn_sumar_doc"><i class="fa fa-plus-circle mr-2" aria-hidden="true"></i> Añadir Documento</span>
                            </div>
                        </div>
                        <div class="row caja_documentos " id="caja_documentos">
                            <div class="col-12  bloqueDoc_base" id="bloqueDoc_base">
                                <div class="row">
                                    <div class="col-10 col-md-4">
                                        <div class="form-group">
                                            <label for="doc_historial" class="requerido">Subir Documento</label>
                                            <input type="file" class="form-control form-control-sm" id="doc_historial" name="doc_historial[]" placeholder="Documento Historial">
                                            <small id="helpId" class="form-text text-muted" id="smallDoc_base"></small>
                                        </div>
                                    </div>
                                    <div class="col-1 d-flex align-items-center col_eliminar_input">
                                        <span class="btn-accion-tabla tooltipsC eliminar_input d-none" title="Eliminar archivo" onclick="eliminar_bloqueDoc_base()"><i class="fa fa-fw fa-trash text-danger"></i></span>
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
<script src="{{ asset('js/intranet/proyectos/historial/subirdoc.js') }}"></script>
@endsection
<!-- ************************************************************* -->
