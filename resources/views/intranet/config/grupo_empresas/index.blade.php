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
<i class="fas fa-industry ml-4" aria-hidden="true"></i> Configuración - Grupos Empresariales
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
                                <strong>Listado de Grupos Empresariales</strong>
                            </h4>
                        </div>
                        <div class="col-12 col-md-6 mb-4 mb-md-0">
                            <a href="{{route('grupo_empresas.create')}}" class="btn btn-success btn-sm btn-sombra pl-3 pr-5 float-md-end">
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
                        <input type="hidden" name="titulo_tabla" id="titulo_tabla" value="Listado de Grupos Empresariales">
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
                                    <th>Empresas</th>
                                    <th>Estado</th>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($grupos as $grupo)
                                <tr>
                                    <td class="text-center">{{ $grupo->id }}</td>
                                    <td>{{ $grupo->tipos_docu->abreb_id . ' ' . $grupo->identificacion }}</td>
                                    <td>{{ $grupo->nombres }}</td>
                                    <td>{{ $grupo->email }}</td>
                                    <td>{{ $grupo->telefono }}</td>
                                    <td>{{ $grupo->direccion }}</td>
                                    <td>{{ $grupo->contacto }}</td>
                                    <td>{{ $grupo->cargo }}</td>
                                    <td class="{{$grupo->empresas->count()?'':'text-center'}}">
                                        @if ($grupo->empresas->count())
                                            <ul>
                                                @foreach ($grupo->empresas as $empresa)
                                                    <li>{{$empresa->nombres}}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <span class="text-danger">---</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="btn-info btn-xs pl-3 pr-3 d-flex flex-row align-items-center bg-{{ $grupo->estado == 1 ? 'success' : 'gray' }} rounded">{{ $empresa->estado == 1 ? 'Activo' : 'Inactivo' }}</span>
                                    </td>
                                    <td class="d-flex justify-content-evenly align-items-center">
                                        <a href="{{ route('grupo_empresas.edit', ['id' => $grupo->id]) }}" class="btn-accion-tabla tooltipsC" title="Editar este registro">
                                            <i class="fas fa-pen-square"></i>
                                        </a>
                                        <form action="{{ route('grupo_empresas.destroy', ['id' => $grupo->id]) }}" class="d-inline form-eliminar" method="POST">
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
@endsection
<!-- ************************************************************* -->
