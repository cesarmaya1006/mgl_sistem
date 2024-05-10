<?php

namespace App\Http\Controllers\Proyectos;

use App\Http\Controllers\Controller;
use App\Models\Configuracion\ConfigUsuario;
use App\Models\Configuracion\GrupoEmpresa;
use App\Models\Proyectos\Notificacion;
use App\Models\Proyectos\Proyecto;
use App\Models\Proyectos\Tarea;
use DateTime;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (session('rol_id') < 3) {
            $grupos = GrupoEmpresa::get();
            return view('intranet.proyectos.proyecto.index', compact('grupos'));
        } else {
            $usuario = ConfigUsuario::findOrfail(session('id_usuario'));
            $tareas = Tarea::where('config_usuario_id', session('id_usuario'))->where('progreso', '<', '100')->get();
            $array_events_calendario = [];
            foreach ($tareas as $tarea) {
                if ($tarea->proy_tareas_id == null) {
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
                    if ($tarea->fec_limite < date('Y-m-d')) {
                        $backgroundColor = 'rgb(255,0,0)';
                    } else {
                        if ($porcVenc > 80 || $diasTotalTarea - $diasGestionTarea < 3) {
                            $backgroundColor = 'rgb(255,150,0)';
                        } else {
                            if (((($tarea->impacto_num / 10) + $tarea->id) % 2) != 0) {
                                $backgroundColor = 'rgb(0,' . rand(60, 250) - $tarea->impacto_num . ',' . rand(10, 180) + $tarea->impacto_num . ')';
                            } else {
                                $backgroundColor = 'rgb(0,' . rand(10, 180) + $tarea->impacto_num . ',' . rand(60, 250) - $tarea->impacto_num . ')';
                            }
                        }
                    }
                    $array_events_calendario[] = [
                        'title' => utf8_encode($tarea->titulo),
                        'start' => $tarea->fec_creacion,
                        'end' => $tarea->fec_limite,
                        'url' => route('tarea.gestion', ['id' => $tarea->id]),
                        'backgroundColor' =>  $backgroundColor,
                        'borderColor' => 'rgb(0,0,0)',
                    ];
                }
            }

            return view('intranet.proyectos.proyecto.index', compact('usuario', 'array_events_calendario'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (session('rol_id') < 3) {
            $grupos = GrupoEmpresa::get();
            return view('intranet.proyectos.proyecto.crear', compact('grupos'));
        } else {
            $usuario = ConfigUsuario::findOrFail(session('id_usuario'));
            $config_empresa_id = $usuario->config_empresa_id;
            $lideres1 = ConfigUsuario::with('empleado.cargo.area.empresa')->where('config_empresa_id', $config_empresa_id)->where('estado', 1)->where('lider', 1)->get();
            $lideres2 = ConfigUsuario::with('empleado.cargo.area.empresa')->where('config_empresa_id', '!=', $config_empresa_id)->where('estado', 1)->where('lider', 1)->whereHas('empresas_tranv', function ($q) use ($config_empresa_id) {
                $q->where('config_empresa_id', $config_empresa_id);
            })->get();
            $lideres = $lideres1->concat($lideres2);
            return view('intranet.proyectos.proyecto.crear', compact('usuario', 'lideres'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $proyecto = Proyecto::create($request->all());
        //-----------------------------------------------------------------------------------
        $this->actualizar_miembros_proyecto($proyecto, $request['config_usuario_id']);
        //-----------------------------------------------------------------------------------
        $dia_hora = date('Y-m-d H:i:s');
        $notificacion['config_usuario_id'] =  $request['config_usuario_id'];
        $notificacion['fec_creacion'] =  $dia_hora;
        $notificacion['titulo'] =  'Se creo un nuevo proyecto y te fue asignado ';
        $notificacion['mensaje'] =  'Se creo un nuevo proyecto Proyecto de Prueba y te fue asignado -> ' . ucfirst($request['titulo']);
        $notificacion['link'] =  route('proyecto.gestion', ['id' => $proyecto->id]);
        $notificacion['id_link'] =  $proyecto->id;
        $notificacion['tipo'] =  'proyecto';
        $notificacion['accion'] =  'creacion';
        Notificacion::create($notificacion);
        return redirect('dashboard/proyectos')->with('mensaje', 'Proyecto creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $proyecto = Proyecto::findOrfail($id);
        return view('intranet.proyectos.proyecto.detalle', compact('proyecto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proyecto $proyecto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyecto $proyecto)
    {
        //
    }
    public function randomColor()
    {
        $str = "#";
        for ($i = 0; $i < 6; $i++) {
            $randNum = rand(0, 15);
            switch ($randNum) {
                case 10:
                    $randNum = "A";
                    break;
                case 11:
                    $randNum = "B";
                    break;
                case 12:
                    $randNum = "C";
                    break;
                case 13:
                    $randNum = "D";
                    break;
                case 14:
                    $randNum = "E";
                    break;
                case 15:
                    $randNum = "F";
                    break;
            }
            $str .= $randNum;
        }
        return $str;
    }

    public function randomColorRGBA(){
        return 'rgba('.rand(10,250).','.rand(10,250).','.rand(10,250).',0.5)';
    }

    public function proyecto_avance_comp (Request $request, $id){
        if ($request->ajax()) {
            $proyecto = Proyecto::findOrFail($id);
            $labels = [];
            $data = [];
            $backgroundColor = [];
            foreach ($proyecto->componentes as $componente) {
                $labels[] = substr($componente->titulo, 0, 25) . ' - ' . number_format(intval($componente->progreso),2,',','') . ' %';
                $data[] = number_format(intval($componente->progreso),2,',','');
                $backgroundColor[] = $this->randomColorRGBA();
            }
            $datasets = ['data' => $data, 'backgroundColor' => $backgroundColor];
            $data_ponderacion_comp = ['labels' => $labels, 'datasets' => $datasets];
            return response()->json(['data_ponderacion_comp' => $data_ponderacion_comp]);
        } else {
            abort(404);
        }
    }

    public function proyecto_ponderacion_comp(Request $request, $id)
    {
        if ($request->ajax()) {
            $proyecto = Proyecto::findOrFail($id);
            $labels = [];
            $data = [];
            $backgroundColor = [];
            foreach ($proyecto->componentes as $componente) {
                $labels[] = substr($componente->titulo, 0, 250) . ' - ' . number_format((intval($componente->impacto_num) * 100) / intval($proyecto->componentes->sum('impacto_num')), 2, ',', '.') . ' %';
                $data[] = round((intval($componente->impacto_num) * 100) / intval($proyecto->componentes->sum('impacto_num')), 2);
                $backgroundColor[] = $this->randomColor();
            }
            $datasets = ['data' => $data, 'backgroundColor' => $backgroundColor];
            $data_ponderacion_comp = ['labels' => $labels, 'datasets' => $datasets];
            return response()->json(['data_ponderacion_comp' => $data_ponderacion_comp]);
        } else {
            abort(404);
        }
    }


    public function gestion($id, $notificacion_id = null)
    {
        if ($notificacion_id) {
            $notificacion_update['estado'] = 0;
            Notificacion::findOrFail($notificacion_id)->update($notificacion_update);
        }
        $proyecto = Proyecto::findOrFail($id);
        return view('intranet.proyectos.proyecto.gestionar', compact('proyecto'));
    }

    public function getproyectos(Request $request, $estado, $config_empresa_id)
    {
        if ($request->ajax()) {
            if ($estado == 'todos') {
                return response()->json(['proyectos' => Proyecto::where('config_empresa_id', $config_empresa_id)->with('miembros_proyecto')->with('lider')->get()]);
            } else {
                return response()->json(['proyectos' => Proyecto::where('config_empresa_id', $config_empresa_id)->where('estado', $estado)->with('miembros_proyecto')->with('lider')->get()]);
            }
        } else {
            abort(404);
        }
    }

    public function getproyectosusuario(Request $request, $config_usuario_id)
    {
        if ($request->ajax()) {
            $usuario = ConfigUsuario::findOrFail($config_usuario_id);
            $proyectos_id = $usuario->proyectos_miembro->where('estado', 'Activo')->pluck('id');
            return response()->json(['proyectos' => Proyecto::whereIn('id', $proyectos_id->toArray())
                ->with('miembros_proyecto')
                ->with('lider')
                ->get()]);
        } else {
            abort(404);
        }
    }

    public function storeNotificacion($config_usuario_id, $proyectoTitulo, $proyectoId)
    {
        //----------------------------------------------------------------------------------------------------
        $dia_hora = date('Y-m-d H:i:s');
        $notificacion['config_usuario_id'] =  $config_usuario_id;
        $notificacion['fec_creacion'] =  $dia_hora;
        $notificacion['titulo'] =  'Se asigno un nuevo proyecto';
        $notificacion['mensaje'] =  'Se creo una nuevo proyecto y te fue asignada -> ' . ucfirst($proyectoTitulo);
        $notificacion['link'] =  route('proyecto.gestion', ['id' => $proyectoId]);
        $notificacion['id_link'] =  $proyectoId;
        $notificacion['tipo'] =  'proyecto';
        $notificacion['accion'] =  'creacion';
        Notificacion::create($notificacion);
        //----------------------------------------------------------------------------------------------------
    }

    public function actualizar_miembros_proyecto($proyecto, $config_usuario_id)
    {
        $miembros[] = intval($config_usuario_id);
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
        $proyecto->miembros_proyecto()->sync(array_unique($miembros));
    }
}
