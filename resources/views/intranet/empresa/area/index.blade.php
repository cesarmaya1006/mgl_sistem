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
<i class="fas fa-industry ml-4" aria-hidden="true"></i> Configuración -  Áreas
@endsection
<!-- ************************************************************* -->
@section('contenido')
@foreach ($empresas as $empresa)
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-md-6 mb-4 mb-md-0">
                                <h4 class="card-title">
                                    <strong>Listado de Areas - Empresa {{$empresa->nombres}}</strong>
                                </h4>
                            </div>
                            <div class="col-12 col-md-6 mb-4 mb-md-0">
                                <a href="{{route('area.create')}}" class="btn btn-success btn-sm btn-sombra pl-3 pr-5 float-md-end">
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
                            <input type="hidden" name="titulo_tabla" id="titulo_tabla" value="Listado de Areas">
                            <table class="table table-striped table-hover table-sm tabla_data_table_m tabla-borrando" id="tabla-data">
                                <thead>
                                    <tr>
                                        <th class="text-center">Id</th>
                                        @if (session('rol_id')<3)
                                            <th class="text-center">Empresa</th>

                                        @endif
                                        <th class="text-center">Area</th>
                                        <th class="text-center">Area Superior</th>
                                        <th class="text-center">Dependencias</th>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($empresa->areas as $area)
                                    <tr>
                                        <td class="text-center">{{ $area->id }}</td>
                                        @if (session('rol_id')<3)
                                            <td class="text-center">{{ $area->empresa->nombres }}</td>

                                        @endif
                                        <td class="text-center">{{ $area->area }}</td>
                                        <td class="text-center">{{ $area->empresa_area_id!=null?$area->area_sup($area->empresa_area_id):'---' }}</td>
                                        <td class="text-center">
                                            @if ($empresa->areas->where('empresa_area_id',$area->id)->count()>0)
                                            <button
                                                type="submit"
                                                class="btn-accion-tabla tooltipsC mostrar_dependencias text-info"
                                                title="Mostrar Dependencias"
                                                data_id = "{{$area->id}}"
                                                data_url = "{{route('area.getDependencias', ['id' => $area->id])}}">
                                                {{ $empresa->areas->where('empresa_area_id',$area->id)->count() }}
                                            </button>
                                            @else
                                                <h6 class="text-danger">---</h6>
                                            @endif
                                        </td>
                                        <td class="d-flex justify-content-evenly align-items-center">
                                            <a href="{{ route('area.edit', ['id' => $area->id]) }}" class="btn-accion-tabla tooltipsC" title="Editar este registro">
                                                <i class="fas fa-pen-square"></i>
                                            </a>
                                            <form action="{{ route('area.destroy', ['id' => $area->id]) }}" class="d-inline form-eliminar" method="POST">
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
                    <!-- Modales  -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Listado de dependencias</h5>
                            </div>
                            <div class="modal-body">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info boton_cerrar_modal">Cerrar Lista</button>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Fin Modales  -->
                </div>
            </div>
        </div>
    </div>
    <hr>
@endforeach
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('scripts_pagina')
<script src="{{ asset('js/intranet/empresas/area/index.js') }}"></script>
@endsection
<!-- ************************************************************* -->
