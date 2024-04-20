@extends("layouts.app")
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')

@endsection
<!-- Pagina CSS -->
@section('estilosHojas')
<link rel="stylesheet" href="{{asset('css/intranet/proyectos/proyecto/index.css')}}">
 <!-- fullCalendar -->
 <link rel="stylesheet" href="{{asset('lte/plugins/fullcalendar/main.css')}}">
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
                    <div class="row mb-2">
                        <div class="col-12 col-md-6 mb-4 mb-md-0">
                            <h4 class="card-title">
                                <strong>Proyectos por grupos empresariales</strong>
                            </h4>
                        </div>
                        @if ( session('rol.id')<3 || (isset($usuario) && $usuario->lider))
                            <div class="col-12 col-md-6 mb-4 mb-md-0">
                                <a href="{{route('proyecto.create')}}" class="btn btn-info btn-sm btn-sombra pl-3 pr-5 float-md-end">
                                    <i class="fa fa-plus-circle mr-3" aria-hidden="true"></i>
                                    Nuevo proyecto
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('includes.mensaje')
                @include('includes.error-form')
                <!--  Sistema Cards  -->
                @if (session('rol_id') == 1 || session('rol_id') == 2)
                    @include('intranet.proyectos.proyecto.index_admin')
                @else
                    @if (session('rol_id') == 4)
                        @include('intranet.proyectos.proyecto.index_usuario')
                    @else
                        @include('includes.acceso_restringido')
                    @endif
                @endif
                <!-- Fin Sistema Cards  -->
            </div>
        </div>
    </div>
</div>
<!-- Modales  -->
<div class="modal fade" id="proyectosModal" tabindex="-1" aria-labelledby="proyectosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="proyectosModalLabel">Modal title</h5>
                <button type="button" class="btn-close boton_cerrar_modal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body table-responsive" style="font-size: 0.8em;">
                <table class="table table-striped table-hover table-sm tabla_data_table_m projects">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Proyecto</th>
                            <th>Lider</th>
                            <th>Miembros de Equipo</th>
                            <th>Gestión/Días</th>
                            <th>Progreso proyecto</th>
                            <th class="text-center">Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="tbody_proyectos">

                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info boton_cerrar_modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="folder_imagenes_usuario" value="{{asset('imagenes/usuarios/')}}">
<input type="hidden" id="input_getdetalleproyecto" value="{{route('proyecto.detalle',['id' => 1])}}">
<!-- ============================================================================================================ -->

<!-- Fin Modales  -->
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('scripts_pagina')
<!-- fullCalendar 2.2.5 -->
<script src="{{ asset('lte/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('lte/plugins/fullcalendar/main.js') }}"></script>
<script src='{{ asset('lte/plugins/fullcalendar/locales/es.js') }}'></script>
<script src="{{ asset('js/intranet/proyectos/proyecto/index.js') }}"></script>
@php
if (isset($usuario)) {
    echo ("<script>
        //====================================================================================================
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

    var Calendar = FullCalendar.Calendar;


    var calendarEl = document.getElementById('calendar');
    //----------------------------------------------------------------------------------------------------
    //array_events_calendario();
    //var variableEvent = array_events_calendario();
    //console.log(variableEvent);
    const data_url = $('#array_events_calendario').attr('data_url');
    //----------------------------------------------------------------------------------------------------
    var calendar = new Calendar(calendarEl, {
        headerToolbar: {
          left  : 'prev,next today',
          center: 'title',
        },
        locale: 'es',
        themeSystem: 'bootstrap',
        //Random default events
        events: [");
        foreach ($array_events_calendario as $item) {
           echo("
           {
            title          : '".utf8_decode($item['title'])."',
            start          : '".utf8_decode($item['start'])."',
            end            : '".utf8_decode($item['end'])."',
            url            : '".utf8_decode($item['url'])."',
            backgroundColor: '".utf8_decode($item['backgroundColor'])."', //yellow
            borderColor    : '".utf8_decode($item['borderColor'])."' //yellow
          },
           ");
        }
          echo("
        ],
        editable  : false,
        droppable : false, // this allows things to be dropped onto the calendar !!!

      });
      //--------------------------------------------------------------------------------------------------
      calendar.render();

    //====================================================================================================
    </script>");
}
@endphp

@endsection
<!-- ************************************************************* -->
