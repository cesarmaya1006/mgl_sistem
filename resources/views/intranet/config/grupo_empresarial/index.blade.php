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
<i class="fas fa-industry ml-4" aria-hidden="true"></i> Configuración - Empresas
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
                                <strong>Listado de Empresas</strong>
                            </h4>
                        </div>
                        <div class="col-12 col-md-6 mb-4 mb-md-0">
                            <a href="{{route('empresa.create')}}" class="btn btn-success btn-sm btn-sombra pl-3 pr-5 float-md-end">
                                <i class="fa fa-plus-circle mr-3" aria-hidden="true"></i>
                                Nuevo registro
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
                        <input type="hidden" name="titulo_tabla" id="titulo_tabla" value="Listado de Empresas">
                        <table class="table table-striped table-hover table-sm tabla_data_table_l tabla-borrando" id="tabla-data">
                            <thead>
                                <tr>
                                    <th class="text-center">Id</th>
                                    <th>Identificación</th>
                                    <th>Empresa</th>
                                    <th>Correo Electrónico</th>
                                    <th>Teléfono</th>
                                    <th>Dirección</th>
                                    <th>Contacto</th>
                                    <th>Cargo Contacto</th>
                                    <th>Estado</th>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($empresas as $empresa)
                                <tr>
                                    <td class="text-center">{{ $empresa->id }}</td>
                                    <td>{{ $empresa->tipos_docu->abreb_id . ' ' . $empresa->identificacion }}</td>
                                    <td>{{ $empresa->nombres }}</td>
                                    <td>{{ $empresa->email }}</td>
                                    <td>{{ $empresa->telefono }}</td>
                                    <td>{{ $empresa->direccion }}</td>
                                    <td>{{ $empresa->contacto }}</td>
                                    <td>{{ $empresa->cargo }}</td>
                                    <td>
                                        <span class="btn-info btn-xs pl-3 pr-3 d-flex flex-row align-items-center bg-{{ $empresa->estado == 1 ? 'success' : 'gray' }} rounded">{{ $empresa->estado == 1 ? 'Activo' : 'Inactivo' }}</span>
                                    </td>
                                    <td class="d-flex justify-content-evenly align-items-center">
                                        <a href="{{ route('empresa.edit', ['id' => $empresa->id]) }}" class="btn-accion-tabla tooltipsC" title="Editar este registro">
                                            <i class="fas fa-pen-square"></i>
                                        </a>
                                        <form action="{{ route('empresa.destroy', ['id' => $empresa->id]) }}" class="d-inline form-eliminar" method="POST">
                                            @csrf @method("delete")
                                            <button type="submit" class="btn-accion-tabla eliminar tooltipsC" title="Eliminar este registro">
                                                <i class="fa fa-fw fa-trash text-danger"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
<script src="{{ asset('js/intranet/configuracion/empresas/index.js') }}"></script>
@endsection
<!-- ************************************************************* -->
