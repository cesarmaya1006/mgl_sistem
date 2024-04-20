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
                                <strong>Gestión Tareas - {{$tarea->titulo}}</strong>
                            </h4>
                        </div>
                        <div class="col-12 col-md-6 mb-4 mb-md-0">
                            <a href="{{ route('proyecto.gestion', ['id' => $tarea->componente->proyecto->id]) }}" class="btn btn-info btn-xs btn-sombra text-center pl-5 pr-5 float-end" style="font-size: 0.9em;">
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
                <div class="row">
                    <div class="col-12">
                        <div class="accordion" id="accordionDatosProyecto">
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="headingProyecto">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseProyecto" aria-expanded="false" aria-controls="collapseProyecto">
                                    <strong>Proyecto:	{{$tarea->componente->proyecto->titulo}}</strong>
                                </button>
                              </h2>
                              <div id="collapseProyecto" class="accordion-collapse collapse" aria-labelledby="headingProyecto" data-bs-parent="#accordionDatosProyecto">
                                <div class="accordion-body" style="font-size: 0.85em;">
                                  <div class="row">
                                    <div class="col-12 col-md-3 d-flex flex-row"><strong class="mr-3">Lider del proyecto:</strong><p class="text-capitalize" style="text-align: justify;">{{$tarea->componente->proyecto->lider->nombres . ' ' . $tarea->componente->proyecto->lider->apellidos}}</p></div>
                                    <div class="col-12 col-md-3 d-flex flex-row"><strong class="mr-3">Fecha de creación:</strong><p class="text-capitalize" style="text-align: justify;">{{$tarea->componente->proyecto->fec_creacion}}</p></div>
                                    @php
                                        $date1 = new DateTime($tarea->componente->proyecto->fec_creacion);
                                        $date2 = new DateTime(Date('Y-m-d'));
                                        $diff = date_diff($date1, $date2);
                                        $differenceFormat = '%a';
                                    @endphp
                                    <div class="col-12 col-md-3 d-flex flex-row"><strong class="mr-3">Días de gestión:</strong><p class="text-capitalize" style="text-align: justify;">{{ $diff->format($differenceFormat) }} días</p></div>
                                    <div class="col-12 col-md-3 d-flex flex-row"><strong class="mr-3">Procentaje de avance:</strong><p class="text-capitalize" style="text-align: justify;">{{number_format($tarea->componente->proyecto->progreso,2)}} %</p></div>
                                    <div class="col-12 col-md-3 d-flex flex-row"><strong class="mr-3">Total de componentes:</strong><p class="text-capitalize" style="text-align: justify;">{{$tarea->componente->proyecto->componentes->count()}}</p></div>
                                    @php
                                        $num_tareas =0;
                                        foreach ($tarea->componente->proyecto->componentes as $componente) {
                                            $num_tareas += $componente->tareas->count();
                                        }
                                    @endphp
                                    <div class="col-12 col-md-3 d-flex flex-row"><strong class="mr-3">Total de tareas:</strong><p class="text-capitalize" style="text-align: justify;">{{$num_tareas}}</p></div>
                                  </div>
                                  <div class="row">
                                    <div class="col-12 col-md-6 d-flex flex-row"><strong class="mr-3">Objetivo:</strong><p class="text-capitalize" style="text-align: justify;">{{$tarea->componente->proyecto->objetivo}}</p></div>
                                    <div class="col-12 col-md-6 d-flex flex-row">
                                        <strong class="mr-3">Personal asignado:</strong>
                                        <div>
                                            @foreach ($tarea->componente->proyecto->miembros_proyecto as $usuario)
                                            <p class="text-capitalize" style="text-align: justify;">{{$usuario->nombres . ' ' . $usuario->apellidos}} - {{$usuario->empleado->cargo->cargo}}  {{$usuario->config_empresa_id!=$tarea->componente->proyecto->config_empresa_id?' - '. $usuario->empresa->nombres:''}} {{$usuario->id == $tarea->componente->proyecto->lider->id?' * Líder del Proyecto':''  }}</p>
                                            @endforeach
                                        </div>
                                        <p class="text-capitalize" style="text-align: justify;"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="headingComponente">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseComponente" aria-expanded="false" aria-controls="collapseComponente">
                                    <strong>Componente:	{{$tarea->componente->titulo}}</strong>
                                </button>
                              </h2>
                              <div id="collapseComponente" class="accordion-collapse collapse" aria-labelledby="headingComponente" data-bs-parent="#accordionDatosProyecto">
                                <div class="accordion-body" style="font-size: 0.85em;">
                                  <div class="row">
                                    <div class="col-12 col-md-3 d-flex flex-row"><strong class="mr-3">Responsable del componente:</strong><p class="text-capitalize" style="text-align: justify;">{{$tarea->componente->responsable->nombres . ' ' . $tarea->componente->responsable->apellidos}}</p></div>
                                    <div class="col-12 col-md-3 d-flex flex-row"><strong class="mr-3">Fecha de creación:</strong><p class="text-capitalize" style="text-align: justify;">{{$tarea->componente->fec_creacion}}</p></div>
                                    <div class="col-12 col-md-3 d-flex flex-row"><strong class="mr-3">Procentaje de avance:</strong><p class="text-capitalize" style="text-align: justify;">{{number_format($tarea->componente->progreso,2)}} %</p></div>
                                    @php
                                        $date1 = new DateTime($tarea->componente->fec_creacion);
                                        $date2 = new DateTime(Date('Y-m-d'));
                                        $diff = date_diff($date1, $date2);
                                        $differenceFormat = '%a';
                                    @endphp
                                    <div class="col-12 col-md-3 d-flex flex-row"><strong class="mr-3">Días de gestión:</strong><p class="text-capitalize" style="text-align: justify;">{{ $diff->format($differenceFormat) }} días</p></div>
                                    <div class="col-12 col-md-3 d-flex flex-row"><strong class="mr-3">Total de tareas:</strong><p class="text-capitalize" style="text-align: justify;">{{$tarea->componente->tareas->count();}}</p></div>
                                    <div class="col-12 col-md-3 d-flex flex-row"><strong class="mr-3">Impacto en el proyecto:</strong><p class="text-capitalize" style="text-align: justify;">{{$tarea->componente->impacto}}</p></div>
                                    <div class="col-12 col-md-3 d-flex flex-row"><strong class="mr-3">Estado del componente:</strong><p class="text-capitalize" style="text-align: justify;">{{$tarea->componente->estado}}</p></div>
                                    <div class="col-12 d-flex flex-row"><strong class="mr-3">Objetivo del componente:</strong><p class="text-capitalize" style="text-align: justify;">{{$tarea->componente->objetivo}}</p></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="headingTarea">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTarea" aria-expanded="true" aria-controls="collapseTarea">
                                    <strong>Tarea:	{{$tarea->titulo}}</strong>
                                </button>
                              </h2>
                              <div id="collapseTarea" class="accordion-collapse collapse show" aria-labelledby="headingTarea" data-bs-parent="#accordionDatosProyecto">
                                <div class="accordion-body" style="font-size: 0.85em;">
                                    <div class="row">
                                        <div class="col-12 col-md-3 d-flex flex-row"><strong class="mr-3">Responsable de la tarea:</strong><p class="text-capitalize" style="text-align: justify;">{{$tarea->responsable->nombres . ' ' . $tarea->responsable->apellidos}}</p></div>
                                        <div class="col-12 col-md-3 d-flex flex-row"><strong class="mr-3">Fecha de creación:</strong><p class="text-capitalize" style="text-align: justify;">{{$tarea->fec_creacion}}</p></div>
                                        <div class="col-12 col-md-3 d-flex flex-row"><strong class="mr-3">Fecha límite:</strong><p class="text-capitalize" style="text-align: justify;">{{$tarea->fec_limite}}</p></div>
                                        <div class="col-12 col-md-3 d-flex flex-row"><strong class="mr-3">Procentaje de avance:</strong><p class="text-capitalize" style="text-align: justify;">{{number_format($tarea->progreso,2)}} %</p></div>
                                        @php
                                            $date1 = new DateTime($tarea->fec_creacion);
                                            $date2 = new DateTime(Date('Y-m-d'));
                                            $diff = date_diff($date1, $date2);
                                            $differenceFormat = '%a';
                                        @endphp
                                        <div class="col-12 col-md-3 d-flex flex-row"><strong class="mr-3">Días de gestión:</strong><p class="text-capitalize" style="text-align: justify;">{{ $diff->format($differenceFormat) }} días</p></div>
                                        @php
                                            $porc_comp_proy = ($tarea->componente->impacto_num*100)/ $tarea->componente->proyecto->componentes->sum('impacto_num');
                                            $porc_tarea_comp = ($tarea->impacto_num*100)/ $tarea->componente->tareas->sum('impacto_num');
                                            $impacto_proyecto = ($porc_tarea_comp/100)*$porc_comp_proy;
                                        @endphp
                                        <div class="col-12 col-md-3 d-flex flex-row"><strong class="mr-3">Impacto en el proyecto :</strong><p class="text-capitalize" style="text-align: justify;">{{round($impacto_proyecto,2)}} %</p></div>
                                        <div class="col-12 col-md-3 d-flex flex-row"><strong class="mr-3">Impacto en el componente:</strong><p class="text-capitalize" style="text-align: justify;">{{$tarea->impacto}}</p></div>
                                        <div class="col-12 col-md-3 d-flex flex-row"><strong class="mr-3">Estado de la tarea:</strong><p class="text-capitalize" style="text-align: justify;">{{$tarea->estado}}</p></div>
                                        <div class="col-12 d-flex flex-row"><strong class="mr-3">Objetivo de la tarea:</strong><p class="text-capitalize" style="text-align: justify;">{{$tarea->objetivo}}</p></div>
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
                </div>
                <hr>
                <div class="row mt-3">
                    <div class="col-12 mb-3 d-md-flex justify-content-md-between">
                        <h6><strong>Historiales de la tarea</strong></h6>
                        <a href="{{route('historial.create',['proy_tareas_id'=>$tarea->id])}}" class="btn btn-success btn-xs btn-sombra text-center pl-3 pr-3 float-md-end mt-3 mt-md-0" style="font-size: 0.9em;">
                            <i class="fas fa-plus-circle mr-2"></i>
                            Nuevo historial
                        </a>
                    </div>
                    <div class="col-12 table-responsive">
                        <table class="table table-striped table-hover table-sm tabla_data_table_l">
                            <thead class="thead-light">
                                <tr>
                                    <td>id</td>
                                    <td>Titulo</td>
                                    <td>Fecha</td>
                                    <td>Usuario historial</td>
                                    <td>Usuario asignado</td>
                                    <td>Avance Progresivo</td>
                                    <td>Resumen</td>
                                    <td>Documentos</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tarea->historiales as $historial)
                                    <tr>
                                        <td>{{ $historial->id }}</td>
                                        <td class="text-left">{{ $historial->titulo }}</td>
                                        <td>{{ $historial->fecha }}</td>
                                        <td class="text-left">{{ $historial->responsable->nombres . ' ' . $historial->responsable->apellidos }}</td>
                                        <td class="text-left">{{ $historial->asignado->nombres . ' ' . $historial->asignado->apellidos }}</td>
                                        <td>{{ $historial->progreso }} %</td>
                                        <td class="text-left">{{ $historial->resumen }}</td>
                                        <td class="d-flex flex-column">

                                        </td>
                                        <td>
                                            <a href="#"class="btn btn-accion-tabla btn-xs text-success">
                                                <i class="fas fa-file-upload" aria-hidden="true"></i>
                                            </a>
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
