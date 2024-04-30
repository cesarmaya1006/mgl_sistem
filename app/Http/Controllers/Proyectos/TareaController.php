<?php

namespace App\Http\Controllers\Proyectos;

use App\Http\Controllers\Controller;
use App\Models\Configuracion\ConfigUsuario;
use App\Models\Proyectos\Componente;
use App\Models\Proyectos\Notificacion;
use App\Models\Proyectos\Proyecto;
use App\Models\Proyectos\Tarea;
use DateTime;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($componente_id)
    {
        $componente = Componente::FindOrFail($componente_id);
        $proyecto = $componente->proyecto;
        $usuarios1 = ConfigUsuario::with('empleado.cargo.area.empresa')->where('config_empresa_id', $proyecto->config_empresa_id)->where('estado', 1)->whereHas('rol', function ($p) {
            $p->where('config_rol_id', 4);
        })->get();
        $usuarios2 = ConfigUsuario::with('empleado.cargo.area.empresa')->where('config_empresa_id', '!=', $proyecto->config_empresa_id)->where('estado', 1)->whereHas('empresas_tranv', function ($q) use ($proyecto) {
            $q->where('config_empresa_id', $proyecto->config_empresa_id);
        })->whereHas('rol', function ($p) {
            $p->where('config_rol_id', 4);
        })->get();
        $usuarios = $usuarios1->concat($usuarios2);
        return view('intranet.proyectos.tarea.crear', compact('componente', 'usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //===================================================================================
        $date1 = new DateTime($request['fec_creacion']);
        $date2 = new DateTime($request['fec_limite']);
        $diff = $date1->diff($date2);
        $longitud_dias = $diff->days;
        if (request(['repeticion_tarea'])) {
            $num_repeticiones = intval($request['num_repeticiones']);
            $periodo_repeticion = $request['periodo_repeticion'];

            $clase_dia_semana = $request['clase_dia_semana'][0];
            switch ($request['clase_dia_semana'][0]) {
                case 'lunes':
                    $clase_dia_semana = 1;
                    break;

                case 'martes':
                    $clase_dia_semana = 2;
                    break;

                case 'miercoles':
                    $clase_dia_semana = 3;
                    break;

                case 'jueves':
                    $clase_dia_semana = 4;
                    break;

                case 'viernes':
                    $clase_dia_semana = 5;
                    break;

                case 'sabado':
                    $clase_dia_semana = 6;
                    break;

                default:
                    $clase_dia_semana = 0;
                    break;
            }

            $tipo_termino = $request['termina_radio'];
            $cant_repeticiones = intval($request['cant_repeticiones']);
            $fec_termino_repeticion = $request['fec_termino_repeticion'];

            $dias_periodo = 0;

            for ($i = 0; $i < $cant_repeticiones; $i++) {
                $componente = Componente::findOrFail($request['proy_componentes_id']);
                $proyecto = $componente->proyecto;
                //------------------------------------------------------------------------------------------
                switch ($request['impacto']) {
                    case 'Alto':
                        $impacto_num = 50;
                        break;
                    case 'Medio-alto':
                        $impacto_num = 40;
                        break;
                    case 'Medio':
                        $impacto_num = 30;
                        break;
                    case 'Medio-bajo':
                        $impacto_num = 20;
                        break;
                    default:
                        $impacto_num = 10;
                        break;
                }
                //------------------------------------------------------------------------------------------
                $miembros[] = intval($request['config_usuario_id']);
                if ($proyecto->componentes->count() > 0) {
                    foreach ($proyecto->componentes as $componente) {
                        $miembros[] = $componente->config_usuario_id;
                        if ($componente->tareas->count() > 0) {
                            foreach ($componente->tareas as $tarea) {
                                $miembros[] = $tarea->config_usuario_id;
                            }
                        }
                    }
                }
                $miembros = array_unique($miembros);
                //------------------------------------------------------------------------------------------
                switch ($periodo_repeticion) {
                    case 'semana':
                        $fec_creacion = date("Y-m-d", strtotime($request['fec_creacion'] . '+ ' . $num_repeticiones * 7 * ($i + 1) . ' days'));
                        $fec_limite = date("Y-m-d", strtotime($request['fec_limite'] . '+ ' . $num_repeticiones * 7 * ($i + 1) . ' days'));
                        break;
                    case 'dia':
                        $fec_creacion = date("Y-m-d", strtotime($request['fec_creacion'] . '+ ' . $num_repeticiones * ($i + 1) . ' days'));
                        $fec_limite = date("Y-m-d", strtotime($request['fec_limite'] . '+ ' . $num_repeticiones * ($i + 1) . ' days'));;
                        break;
                    case 'mes':
                        $fec_creacion = date("Y-m-d", strtotime($request['fec_creacion'] . '+ ' . $num_repeticiones * ($i + 1) . ' month'));
                        $fec_limite = date("Y-m-d", strtotime($request['fec_limite'] . '+ ' . $num_repeticiones * ($i + 1) . ' month'));
                        break;
                    default:
                        $fec_creacion = date("Y-m-d", strtotime($request['fec_creacion'] . '+ ' . $num_repeticiones * ($i + 1) . ' year'));
                        $fec_limite = date("Y-m-d", strtotime($request['fec_limite'] . '+ ' . $num_repeticiones * ($i + 1) . ' year'));
                        break;
                        break;
                }
                //------------------------------------------------------------------------------------------
                if ($i == 1) {
                    $fec_creacion = $request['fec_creacion'];
                    $fec_limite = $request['fec_limite'];
                }
                //------------------------------------------------------------------------------------------
                //------------------------------------------------------------------------------------------

                $tarea_rep_new['proy_componentes_id'] = $request['proy_componentes_id'];
                $tarea_rep_new['config_usuario_id'] = $request['config_usuario_id'];
                $tarea_rep_new['titulo'] = $request['titulo'] . ' - Repetición (' . $i + 1 . ')';
                $tarea_rep_new['fec_creacion'] = $fec_creacion;
                $tarea_rep_new['fec_limite'] = $fec_limite;
                $tarea_rep_new['objetivo'] = $request['objetivo'];
                $tarea_rep_new['impacto'] = $request['impacto'];
                $tarea_rep_new['impacto_num'] = $impacto_num;

                $tarea = Tarea::create($tarea_rep_new);

                $proyecto->miembros_proyecto()->sync(array_unique($miembros));
                $this->modificarprogresos(0, $tarea->id);
                //----------------------------------------------------------------------------------------------------
                $dia_hora = date('Y-m-d H:i:s');
                $notificacion['config_usuario_id'] =  $request['config_usuario_id'];
                $notificacion['fec_creacion'] =  $dia_hora;
                $notificacion['titulo'] =  'Se asigno una nueva tarea';
                $notificacion['mensaje'] =  'Se creo una nueva tarea al proyecto ' . $proyecto->titulo . ' y te fue asignada -> ' . ucfirst($request['titulo']);
                $notificacion['link'] =  route('proyecto.gestion', ['id' => $proyecto->id]);
                $notificacion['id_link'] =  $proyecto->id;
                $notificacion['tipo'] =  'tarea';
                $notificacion['accion'] =  'creacion';
                Notificacion::create($notificacion);
                //----------------------------------------------------------------------------------------------------
            }
        } else {
            $componente = Componente::findOrFail($request['proy_componentes_id']);
            $proyecto = $componente->proyecto;
            switch ($request['impacto']) {
                case 'Alto':
                    $impacto_num = 50;
                    break;
                case 'Medio-alto':
                    $impacto_num = 40;
                    break;
                case 'Medio':
                    $impacto_num = 30;
                    break;
                case 'Medio-bajo':
                    $impacto_num = 20;
                    break;
                default:
                    $impacto_num = 10;
                    break;
            }
            $miembros[] = intval($request['config_usuario_id']);
            if ($proyecto->componentes->count() > 0) {
                foreach ($proyecto->componentes as $componente) {
                    $miembros[] = $componente->config_usuario_id;
                    if ($componente->tareas->count() > 0) {
                        foreach ($componente->tareas as $tarea) {
                            $miembros[] = $tarea->config_usuario_id;
                            /*if ($tarea->subtareas->count() > 0) {
                            foreach ($tarea->subtareas as $subtarea) {
                                $miembros[] = $subtarea->config_usuario_id;
                            }
                        }*/
                        }
                    }
                }
            }
            $miembros = array_unique($miembros);
            $request['impacto_num'] = $impacto_num;
            $tarea = Tarea::create($request->all());
            $proyecto->miembros_proyecto()->sync(array_unique($miembros));
            $this->modificarprogresos(0, $tarea->id);
            //----------------------------------------------------------------------------------------------------
            $dia_hora = date('Y-m-d H:i:s');
            $notificacion['config_usuario_id'] =  $request['config_usuario_id'];
            $notificacion['fec_creacion'] =  $dia_hora;
            $notificacion['titulo'] =  'Se asigno una nueva tarea';
            $notificacion['mensaje'] =  'Se creo una nueva tarea al proyecto ' . $proyecto->titulo . ' y te fue asignada -> ' . ucfirst($request['titulo']);
            $notificacion['link'] =  route('proyecto.gestion', ['id' => $proyecto->id]);
            $notificacion['id_link'] =  $proyecto->id;
            $notificacion['tipo'] =  'tarea';
            $notificacion['accion'] =  'creacion';
            Notificacion::create($notificacion);
            //----------------------------------------------------------------------------------------------------
        }
        return redirect('dashboard/proyectos/gestion/' . $proyecto->id)->with('mensaje', 'Tarea creada con éxito');
    }

    public function subtareas_store(Request $request)
    {

        //dd($request->all());
        $tarea_ini  = Tarea::findOrFail($request['proy_tareas_id']);
        $proyecto = $tarea_ini->componente->proyecto;
        /*$miembros[] = intval($request['config_usuario_id']);
        if ($proyecto->componentes->count() > 0) {
            foreach ($proyecto->componentes as $componente) {
                $miembros[] = $componente->config_usuario_id;
                if ($componente->tareas->count() > 0) {
                    foreach ($componente->tareas as $tarea) {
                        $miembros[] = $tarea->config_usuario_id;
                        if ($tarea->subtareas->count() > 0) {
                            foreach ($tarea->subtareas as $subtarea) {
                                $miembros[] = $subtarea->config_usuario_id;
                            }
                        }
                    }
                }
            }
        }
        $miembros = array_unique($miembros);
        */
        $tarea = Tarea::create($request->all());


        //$proyecto->miembros_proyecto()->sync(array_unique($miembros));
        //----------------------------------------------------------------------------------------------------
        $dia_hora = date('Y-m-d H:i:s');
        $notificacion['config_usuario_id'] =  $request['config_usuario_id'];
        $notificacion['fec_creacion'] =  $dia_hora;
        $notificacion['titulo'] =  'Se asigno una nueva sub-tarea';
        $notificacion['mensaje'] =  'Se creo una nueva sub-tarea a la tarea ' . $tarea->titulo . ' y te fue asignada -> ' . ucfirst($request['titulo']);
        $notificacion['link'] =  route('subtareas.gestion', ['id' => $tarea->id]);
        $notificacion['id_link'] =  $tarea->id;
        $notificacion['tipo'] =  'sub-tarea';
        $notificacion['accion'] =  'creacion';
        Notificacion::create($notificacion);
        //----------------------------------------------------------------------------------------------------
        return redirect('dashboard/proyectos/tareas/gestion/' . $request['proy_tareas_id'])->with('mensaje', 'Sub-Tarea creada con éxito');
    }

    public function modificarprogresos($progreso_request, $proy_tareas_id)
    {
        $tareaFind = Tarea::findOrFail($proy_tareas_id);
        $tarea_update['progreso'] = $progreso_request;
        $tarea_update['estado'] = 'Activa';
        Tarea::findOrFail($proy_tareas_id)->update($tarea_update);

        $sumImpacto_numTarea_Componente = $tareaFind->componente->tareas->sum('impacto_num');
        $progesoComponenete = 0;
        foreach ($tareaFind->componente->tareas as $tarea) {
            $progesoComponenete += (($tarea->impacto_num / $sumImpacto_numTarea_Componente) * intval($tarea->progreso));
        }
        $componenteUpdate['progreso'] = $progesoComponenete;
        $componenteUpdate['estado'] = 'Activo';
        Componente::findOrFail($tareaFind->componente->id)->update($componenteUpdate);
        //--------------------------------------------------------------------------------------
        $sumImpacto_numComponente_Proyecto = $tareaFind->componente->proyecto->componentes->sum('impacto_num');
        $progesoProyecto = 0;
        foreach ($tareaFind->componente->proyecto->componentes as $componente) {
            $progesoProyecto += (($componente->impacto_num / $sumImpacto_numComponente_Proyecto) * floatval($componente->progreso));
        }
        $ProyectoUpdate['progreso'] = $progesoProyecto;
        $ProyectoUpdate['estado'] = 'Activo';
        Proyecto::findOrFail($tareaFind->componente->proyecto->id)->update($ProyectoUpdate);
    }

    public function gettareasusu(Request $request, $config_usuario_id)
    {
        if ($request->ajax()) {
            $tareas = Tarea::where('config_usuario_id', $config_usuario_id)->where('progreso', '<', '100')->get();
            $array_events_calendario = [];
            foreach ($tareas as $tarea) {
                if ($tarea->fec_limite < date('Y-m-d')) {
                    $backgroundColor = 'rgb(255,0,0)';
                } else {
                    $backgroundColor = 'rgb(0,' . rand(10, 250) . ',' . rand(10, 250) . ')';
                }
                $array_events_calendario[] = [
                    'title' => $tarea->titulo,
                    'start' => $tarea->fec_creacion,
                    'end' => $tarea->fec_limite,
                    'url' => route('tarea.gestion', ['id' => $tarea->id]),
                    'backgroundColor' =>  $backgroundColor,
                    'borderColor' => 'rgb(0,0,0)',
                ];
            }

            return response()->json($array_events_calendario);
        } else {
            abort(404);
        }
    }

    public function gettareasusumodal(Request $request, $config_usuario_id, $estado)
    {
        if ($request->ajax()) {
            $usuario = ConfigUsuario::findOrFail($config_usuario_id);
            $tareas_vencidas = [];
            $tareas_proxvencer = [];
            $tareas_activas = [];
            foreach ($usuario->proyectos_miembro->where('estado', 'Activo') as $proyecto) {
                foreach ($proyecto->componentes as $componente) {
                    foreach ($componente->tareas->where('progreso', '<', '100') as $tarea) {
                        //-------------------------------------------------
                        $date1 = new DateTime($tarea->fec_creacion);
                        $date2 = new DateTime($tarea->fec_limite);
                        $diff = date_diff($date1, $date2);
                        $differenceFormat = '%a';
                        $diasTotalTarea = $diff->format($differenceFormat);
                        if ($diasTotalTarea == 0) {
                            $diasTotalTarea = 1;
                        }
                        //-------------------------------------------------
                        $date1 = new DateTime($tarea->fec_creacion);
                        $date2 = new DateTime(date('Y-m-d'));
                        $diff = date_diff($date1, $date2);
                        $differenceFormat = '%a';
                        $diasGestionTarea = $diff->format($differenceFormat);
                        //---------------------------------------------------
                        $porcVenc = ($diasGestionTarea * 100) / $diasTotalTarea;
                        if ($usuario->lider && $tarea->componente->proyecto->config_usuario_id == $config_usuario_id) {
                            if ($estado == 'vencidas' && ($tarea->fec_limite < date('Y-m-d'))) {
                                array_push($tareas_vencidas, intval($tarea->id));
                            } else if ($estado == 'proxvencer' && ($porcVenc > 80 || $diasTotalTarea - $diasGestionTarea < 3) && ($tarea->fec_limite > date('Y-m-d'))) {
                                array_push($tareas_proxvencer, intval($tarea->id));
                            } else if ($estado == 'activas') {
                                array_push($tareas_activas, intval($tarea->id));
                            }
                        } else if ($usuario->id == $tarea->config_usuario_id) {
                            if ($estado == 'vencidas' && ($tarea->fec_limite < date('Y-m-d'))) {
                                array_push($tareas_vencidas, intval($tarea->id));
                            } else if ($estado == 'proxvencer' && ($porcVenc > 80 || $diasTotalTarea - $diasGestionTarea < 3) && ($tarea->fec_limite > date('Y-m-d'))) {
                                array_push($tareas_proxvencer, intval($tarea->id)); # code...
                            } else if ($estado == 'activas' && ($porcVenc < 81 || $diasTotalTarea - $diasGestionTarea > 2)) {
                                array_push($tareas_activas, intval($tarea->id));
                            }
                        }
                    }
                }
            }
            if (count($tareas_vencidas) > 0 && $estado == 'vencidas') {
                $tareas_fin = $tareas_vencidas;
            } elseif (count($tareas_proxvencer) > 0 && $estado == 'proxvencer') {
                $tareas_fin = $tareas_proxvencer;
            } elseif (count($tareas_activas) > 0 && $estado == 'activas') {
                $tareas_fin = $tareas_activas;
            }
            return response()->json(['tareas' => Tarea::whereIn('id', $tareas_fin)->get(), 'estado' => $estado]);
        } else {
            abort(404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function gestion($id, $notificacion_id = null)
    {
        if ($notificacion_id) {
            $notificacion_update['estado'] = 0;
            Notificacion::findOrFail($notificacion_id)->update($notificacion_update);
        }
        $tarea = Tarea::findOrfail($id);
        return view('intranet.proyectos.tarea.gestion', compact('tarea'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function subtareas_create($proy_tareas_id)
    {
        $tarea = Tarea::findOrFail($proy_tareas_id);
        $componente = $tarea->componente;
        $proyecto = $tarea->componente->proyecto;
        $usuarios1 = ConfigUsuario::with('empleado.cargo.area.empresa')->where('config_empresa_id', $proyecto->config_empresa_id)->where('estado', 1)->whereHas('rol', function ($p) {
            $p->where('config_rol_id', 4);
        })->get();
        $usuarios2 = ConfigUsuario::with('empleado.cargo.area.empresa')->where('config_empresa_id', '!=', $proyecto->config_empresa_id)->where('estado', 1)->whereHas('empresas_tranv', function ($q) use ($proyecto) {
            $q->where('config_empresa_id', $proyecto->config_empresa_id);
        })->whereHas('rol', function ($p) {
            $p->where('config_rol_id', 4);
        })->get();
        $usuarios = $usuarios1->concat($usuarios2);
        return view('intranet.proyectos.subtarea.crear', compact('tarea', 'usuarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarea $tarea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarea $tarea)
    {
        //
    }
}
