<?php

namespace App\Http\Controllers\Proyectos;

use App\Http\Controllers\Controller;
use App\Models\Configuracion\ConfigUsuario;
use App\Models\Proyectos\Componente;
use App\Models\Proyectos\Notificacion;
use App\Models\Proyectos\Proyecto;
use App\Models\Proyectos\Tarea;
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
                    }
                }
            }
        }
        $miembros = array_unique($miembros);
        $request['impacto_num'] = $impacto_num;
        $tarea = Tarea::create($request->all());
        $proyecto->miembros_proyecto()->sync(array_unique($miembros));
        $this->modificarprogresos(0,$tarea->id);
        //----------------------------------------------------------------------------------------------------
        $dia_hora = date('Y-m-d H:i:s');
        $notificacion['config_usuario_id'] =  $request['config_usuario_id'];
        $notificacion['fec_creacion'] =  $dia_hora;
        $notificacion['titulo'] =  'Se asigno una nueva tarea';
        $notificacion['mensaje'] =  'Se creo una nueva tarea al proyecto ' .$proyecto->titulo. ' y te fue asignada -> ' .ucfirst($request['titulo']);
        $notificacion['link'] =  route('proyecto.gestion', ['id' => $proyecto->id]);
        $notificacion['id_link'] =  $proyecto->id;
        $notificacion['tipo'] =  'tarea';
        $notificacion['accion'] =  'creacion';
        Notificacion::create($notificacion);
        //----------------------------------------------------------------------------------------------------
        return redirect('dashboard/proyectos/gestion/'.$proyecto->id)->with('mensaje', 'Tarea creada con éxito');
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

    public function gettareasusu(Request $request,$config_usuario_id){
        if ($request->ajax()) {
            $tareas = Tarea::where('config_usuario_id',$config_usuario_id)->where('progreso','<', '100')->get();
            $array_events_calendario = [];
            foreach ($tareas as $tarea) {
                if ($tarea->fec_limite < date('Y-m-d')) {
                    $backgroundColor = 'rgb(255,0,0)';
                } else {
                    $backgroundColor = 'rgb(0,'. rand(10,250) .','. rand(10,250) .')';
                }
                $array_events_calendario[] = [
                    'title' => $tarea->titulo,
                    'start' => $tarea->fec_creacion,
                    'end' => $tarea->fec_limite,
                    'url' => route('tarea.gestion',['id' => $tarea->id]),
                    'backgroundColor' =>  $backgroundColor,
                    'borderColor' => 'rgb(0,0,0)',
                ];
            }

            return response()->json($array_events_calendario);
        } else {
            abort(404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function gestion($id)
    {
        $tarea = Tarea::findOrfail($id);
        return view('intranet.proyectos.tarea.gestion', compact('tarea'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarea $tarea)
    {
        //
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
