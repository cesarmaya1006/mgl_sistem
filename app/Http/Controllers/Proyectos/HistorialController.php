<?php

namespace App\Http\Controllers\Proyectos;

use App\Http\Controllers\Controller;
use App\Models\Configuracion\ConfigUsuario;
use App\Models\Proyectos\Componente;
use App\Models\Proyectos\Historial;
use App\Models\Proyectos\Notificacion;
use App\Models\Proyectos\Proyecto;
use App\Models\Proyectos\Tarea;
use Illuminate\Http\Request;

class HistorialController extends Controller
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
    public function create($proy_tareas_id)
    {
        $tarea = Tarea::findOrFail($proy_tareas_id);
        $proyecto = $tarea->componente->proyecto;
        $usuarios = $this->getUsuariosProyectosCrear($proyecto);
        $usuario = ConfigUsuario::findOrFail(session('id_usuario'));
        return view('intranet.proyectos.historial.crear', compact('tarea', 'usuarios', 'usuario'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Historial::create($request->all());
        $tarea = Tarea::findOrFail($request['proy_tareas_id']);
        $this->modificarprogresos($request['progreso'], $request['proy_tareas_id']);
        $this->crearNotificacion('historial', $request['usuarioasignado_id'], $tarea->componente->proyecto, $request['proy_tareas_id']);
        return redirect('dashboard/proyectos/tareas/gestion/' . $request['proy_tareas_id'])->with('mensaje', 'historial creado con éxito');
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
    public function crearNotificacion($elemento, $config_usuario_id, $proyecto, $id_link)
    {
        switch ($elemento) {
            case 'historial':
                $titulo = 'Se creo un historial';
                $mensaje = 'Se creo un nuevo historiala la tarea del proyecto ' . $proyecto->titulo . ' y te fue asignada -> ' . ucfirst($titulo);
                $link = route('tarea.gestion', ['id' => $id_link]);
                $id_link_upd = $id_link;
                $tipo = 'historial';
                $accion = 'creacion';
                break;
            default:
                # code...
                break;
        }
        //----------------------------------------------------------------------------------------------------
        $dia_hora = date('Y-m-d H:i:s');
        $notificacion['config_usuario_id'] =  $config_usuario_id;
        $notificacion['fec_creacion'] =  $dia_hora;
        $notificacion['titulo'] =  $titulo;
        $notificacion['mensaje'] = $mensaje;
        $notificacion['link'] =  $link;
        $notificacion['id_link'] =  $id_link_upd;
        $notificacion['tipo'] =  $tipo;
        $notificacion['accion'] =  $accion;
        Notificacion::create($notificacion);
        //----------------------------------------------------------------------------------------------------
    }

    /**
     * Display the specified resource.
     */
    public function show(Historial $historial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Historial $historial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Historial $historial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Historial $historial)
    {
        //
    }

    public function getUsuariosProyectosCrear($proyecto)
    {
        $usuarios1 = ConfigUsuario::with('empleado.cargo.area.empresa')->where('config_empresa_id', $proyecto->config_empresa_id)->where('estado', 1)->whereHas('rol', function ($p) {
            $p->where('config_rol_id', 4);
        })->get();
        $usuarios2 = ConfigUsuario::with('empleado.cargo.area.empresa')->where('config_empresa_id', '!=', $proyecto->config_empresa_id)->where('estado', 1)->whereHas('empresas_tranv', function ($q) use ($proyecto) {
            $q->where('config_empresa_id', $proyecto->config_empresa_id);
        })->whereHas('rol', function ($p) {
            $p->where('config_rol_id', 4);
        })->get();
        return  $usuarios1->concat($usuarios2);
    }
}
