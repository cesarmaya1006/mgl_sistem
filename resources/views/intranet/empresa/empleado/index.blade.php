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
<i class="fas fa-user-tie ml-4" aria-hidden="true"></i> Configuración -  Usuarios
@endsection
<!-- ************************************************************* -->
@section('contenido')
@foreach ($grupos as $grupo)
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-md-6 mb-4 mb-md-0">
                                <h4 class="card-title">
                                    <strong>Listado de Usuarios/Empleados - Grupo Empresarial {{$grupo->nombres}}</strong>
                                </h4>
                            </div>
                            <div class="col-12 col-md-6 mb-4 mb-md-0">
                                <a href="{{route('empleado.create')}}" class="btn btn-success btn-sm btn-sombra pl-3 pr-5 float-md-end">
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
                        @foreach ($grupo->empresas as $empresa)
                            @if ($empresa->usuarios->count()>0)
                                <div class="col-12">
                                    <h5><strong>Empleados Empresa - {{$empresa->nombres}}</strong></h5>
                                </div>
                                <div class="col-12 table-responsive">
                                    <input type="hidden" name="titulo_tabla" id="titulo_tabla" value="Listado de Areas">
                                    <table class="table table-striped table-hover table-sm tabla_data_table_m tabla-borrando" id="tabla-data">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Id</th>
                                                @if (session('rol_id')<3)
                                                    <th class="text-center">Grupo Empresarial</th>
                                                    <th class="text-center">Empresa</th>
                                                @endif
                                                <th class="text-center">Area</th>
                                                <th class="text-center">Cargo</th>
                                                <th class="text-center">Identificación</th>
                                                <th class="text-center">Nombres y Apellidos</th>
                                                <th class="text-center">Correo Electrónico</th>
                                                <th class="text-center">Teléfono</th>
                                                <th class="text-center">Dirección</th>
                                                <th class="text-center">Estado</th>
                                                <th class="text-center">Foto</th>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($empresa->areas as $area)
                                                @foreach ($area->cargos as $cargo)
                                                    @foreach ($cargo->empleados as $empleado)
                                                        <tr>
                                                            <td class="text-center">{{ $empleado->id }}</td>
                                                            @if (session('rol_id')<3)
                                                                <td class="text-center">{{ $empleado->cargo->area->empresa->grupo->nombres }}</td>
                                                                <td class="text-center">{{ $empleado->cargo->area->empresa->nombres }}</td>
                                                            @endif
                                                            <td class="text-center">{{ $empleado->cargo->area->area }}</td>
                                                            <td class="text-center">{{ $empleado->cargo->cargo }}</td>
                                                            <td class="text-center">{{ $empleado->usuario->tipos_docu->abreb_id .' ' . $empleado->usuario->identificacion}}</td>
                                                            <td class="text-center">{{ $empleado->usuario->nombres . ' ' . $empleado->usuario->apellidos }}</td>
                                                            <td class="text-center">{{ $empleado->usuario->email }}</td>
                                                            <td class="text-center">{{ $empleado->usuario->telefono }}</td>
                                                            <td class="text-center">{{ $empleado->usuario->direccion }}</td>
                                                            <td class="text-center"><span class="badge {{ $empleado->usuario->estado==1?'bg-success':'bg-danger'}}"> {{ $empleado->usuario->estado==1?'Activo':'Inactivo'}}</span></td>
                                                            <td class="text-center">
                                                                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                                                                    <div class="image">
                                                                        <img src="{{asset('imagenes/usuarios/'. $empleado->usuario->foto)}}" class="img-circle elevation-2" alt="User Image">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="d-flex justify-content-evenly align-items-center">
                                                                <div class="row">
                                                                    <div class="col-12 p-2">
                                                                        <a href="{{ route('empleado.edit', ['id' => $empleado->id]) }}" class="btn-accion-tabla tooltipsC" title="Editar este registro">
                                                                            <i class="fas fa-pen-square"></i>
                                                                        </a>
                                                                        <form action="{{ route('empleado.destroy', ['id' => $empleado->id]) }}" class="d-inline form-eliminar" method="POST">
                                                                            @csrf @method("delete")
                                                                            <button type="submit" class="btn-accion-tabla eliminar tooltipsC" title="Eliminar este registro">
                                                                                <i class="fa fa-fw fa-trash text-danger"></i>
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <hr class="mt-4 mb-4">
                            @endif
                        @endforeach
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
    <script src="{{ asset('js/intranet/empresas/cargo/index.js') }}"></script>
@endsection
<!-- ************************************************************* -->
