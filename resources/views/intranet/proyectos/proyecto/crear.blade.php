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
                                <strong>Nuevo Proyecto</strong>
                            </h4>
                        </div>
                        <div class="col-12 col-md-6 mb-4 mb-md-0">
                            <a href="{{ route('proyecto.index') }}" class="btn btn-info btn-sm btn-sombra text-center pl-3 pr-3 float-end" style="font-size: 0.9em;">
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
                    <div class="col-12">
                        <form action="{{ route('proyecto.store') }}" class="form-horizontal row" method="POST" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            @if (session('rol_id')<3)
                            <div class="row">
                               <div class="col-5 col-md-3 form-group">
                                    <label class="requerido" for="config_grupo_empresas_id">Grupo Empresarial</label>
                                    <select id="config_grupo_empresas_id" class="form-control form-control-sm" data_url="{{route('grupo_empresas.getEmpresas')}}" required>
                                        <option value="">Elija grupo empresarial</option>
                                        @foreach ($grupos as $grupo)
                                            <option value="{{ $grupo->id }}">
                                                {{ $grupo->nombres }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-5 col-md-3 form-group d-none" id="caja_empresas">
                                    <label class="requerido" for="config_empresa_id">Empresa</label>
                                    <select id="config_empresa_id" class="form-control form-control-sm" data_url="{{route('empleado.getLideresPorEmpresa')}}" name="config_empresa_id" required>
                                        <option value="">Elija grupo</option>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            @else
                            <input type="hidden" id="config_empresa_id_2" name="config_empresa_id" value="{{session('config_empresa_id')}}" data_url="{{route('empleado.getLideresPorEmpresa')}}">
                            @endif
                            <div class="row">
                                <div class="col-12 col-md-2 form-group">
                                    <label for="fec_creacion">Fecha Proyecto</label>
                                    <input class="form-control form-control-sm" type="date" name="fec_creacion"
                                        id="fec_creacion" value="{{ date('Y-m-d') }}" required>
                                    <small id="helpId" class="form-text text-muted">Fecha creación proyecto</small>
                                </div>
                                <div class="col-12 col-md-4 form-group">
                                    <label for="titulo">Lider Proyecto</label>
                                    <select class="form-control form-control-sm" name="config_usuario_id" id="lider_id" required>
                                        <option value="">Seleccione un Lider</option>

                                    </select>
                                    <small id="helpId" class="form-text text-muted">Lider Proyecto</small>
                                </div>
                                <div class="col-12 col-md-4 form-group">
                                    <label for="titulo">Titulo Proyecto</label>
                                    <input type="text" class="form-control form-control-sm" name="titulo" id="titulo"
                                        aria-describedby="helpId" onkeyup="mayus(this);" required>
                                    <small id="helpId" class="form-text text-muted">Titulo Proyecto</small>
                                </div>
                                <div class="col-12 form-group">
                                    <label for="titulo">Objetivo del Proyecto</label>
                                    <textarea class="form-control form-control-sm" id="objetivo" name="objetivo" rows="3"
                                        placeholder="Ingrese el objetivo de proyecto" required></textarea>
                                    <small id="helpId" class="form-text text-muted">Objetivo del Proyecto</small>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="row mt-5">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-sm btn-sombra pl-4 pr-4">Guardar</button>
                                </div>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('scripts_pagina')
<script src="{{ asset('js/intranet/proyectos/proyecto/crear.js') }}"></script>
@endsection
<!-- ************************************************************* -->
