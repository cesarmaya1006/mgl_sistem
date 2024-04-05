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
                                <strong>Proyectos por grupos empresariales</strong>
                            </h4>
                        </div>
                        <div class="col-12 col-md-6 mb-4 mb-md-0">
                            <a href="{{route('proyecto.create')}}" class="btn btn-info btn-sm btn-sombra pl-3 pr-5 float-md-end">
                                <i class="fa fa-plus-circle mr-3" aria-hidden="true"></i>
                                Nuevo proyecto
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!--  Sistema Cards  -->
                @foreach ($grupos as $grupo)
                <div class="row">
                    <div class="col-12">
                        <h3>{{$grupo->nombres}}</h3>
                    </div>
                    @foreach ($grupo->empresas as $empresa)
                    <div class="col-12 col-md-3">
                        <div class="card card-widget widget-user-2 card-proyectos">
                            <div class="widget-user-header bg-info">
                                <div class="widget-user-image">
                                    <img class="img-circle elevation-2" src="{{asset('imagenes/sistema/'.$empresa->logo)}}" alt="{{$empresa->nombres}}">
                                </div>
                                <h3 class="widget-user-username">{{$empresa->nombres}}</h3>
                                <h5 class="widget-user-desc">Email: {{$empresa->email}}</h5>
                                <h5 class="widget-user-desc">Teléfono: {{$empresa->telefono}}</h5>
                            </div>
                            <div class="card-footer p-0">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            Total Proyectos <span class="float-right badge bg-dark">{{$empresa->proyectos->count()}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            Proyectos En curso <span class="float-right badge bg-success">{{$empresa->proyectos->where('estado','activo')->count()}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            Proyectos Extendidos <span class="float-right badge bg-danger">{{$empresa->proyectos->where('estado','extendido')->count()}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            Proyectos Extendidos <span class="float-right badge bg-secondary">{{$empresa->proyectos->where('estado','cerrado')->count()}}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach
                <!-- Fin Sistema Cards  -->
            </div>
        </div>
    </div>
</div>
<!-- Modales  -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin Modales  -->
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('scripts_pagina')
<script src="{{ asset('js/intranet/empresas/cargo/index.js') }}"></script>
@endsection
<!-- ************************************************************* -->
