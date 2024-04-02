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
<i class="fas fa-industry ml-4" aria-hidden="true"></i> Configuración - Usuarios
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
                                <strong>Editar Usuario - {{$usuario_edit->nombres . ' ' . $usuario_edit->apellidos}}</strong>
                            </h4>
                        </div>
                        <div class="col-12 col-md-6 mb-4 mb-md-0">
                            <a href="{{ route('empleado.index') }}" class="btn btn-success btn-sm btn-sombra text-center pl-3 pr-3 float-end" style="font-size: 0.9em;">
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
                        <form id="formulario" action="{{ route('empleado.update',['id'=>$usuario_edit->id]) }}) }}" class="form-horizontal row" method="POST" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            @include('intranet.empresa.empleado.form')
                            <!-- /.card-body -->
                            <div class="row mt-5">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-sm btn-sombra pl-4 pr-4">Actualizar</button>
                                </div>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
</div>
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('scripts_pagina')
<script src="{{ asset('js/intranet/empresas/empleado/editar.js') }}"></script>
@endsection
<!-- ************************************************************* -->
