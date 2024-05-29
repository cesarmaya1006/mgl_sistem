<?php

namespace App\Http\Controllers\Proyectos;

use App\Http\Controllers\Controller;
use App\Http\Requests\Proyectos\ValidacionComponenteUpdate;
use App\Models\Configuracion\ConfigUsuario;
use App\Models\Configuracion\GrupoEmpresa;
use App\Models\Proyectos\AdicionComponente;
use App\Models\Proyectos\AdicionProyecto;
use App\Models\Proyectos\Componente;
use App\Models\Proyectos\Notificacion;
use App\Models\Proyectos\Proyecto;
use Illuminate\Http\Request;

class ComponenteController extends Controller
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
    public function create($proyectos_id)
    {
        $proyecto = Proyecto::FindOrFail($proyectos_id);

        $usuarios1 = ConfigUsuario::with('empleado.cargo.area.empresa')->where('config_empresa_id', $proyecto->config_empresa_id)->where('estado', 1)->whereHas('rol', function ($p) {
            $p->where('config_rol_id', 4);
        })->get();
        $usuarios2 = ConfigUsuario::with('empleado.cargo.area.empresa')->where('config_empresa_id', '!=', $proyecto->config_empresa_id)->where('estado', 1)->whereHas('empresas_tranv', function ($q) use ($proyecto) {
            $q->where('config_empresa_id', $proyecto->config_empresa_id);
        })->whereHas('rol', function ($p) {
            $p->where('config_rol_id', 4);
        })->get();
        $usuarios = $usuarios1->concat($usuarios2);
        $proyecto = Proyecto::findOrfail($proyectos_id);
        return view('intranet.proyectos.componente.crear', compact('proyecto', 'usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $proyecto = Proyecto::findOrFail($request['proyectos_id']);
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
        $miembros_proyecto_id = [];
        foreach ($proyecto->miembros_proyecto as $miembro_proyecto) {
            $miembros_proyecto_id[]=$miembro_proyecto->config_usuario_id;
        }
        $request['impacto_num'] = $impacto_num;
        $componente = Componente::create($request->all());
        //-----------------------------------------------------------------------------------
        $this->actualizar_miembros_proyecto($componente->proyecto, $componente->config_usuario_id);
        //-----------------------------------------------------------------------------------
        //------------------------------------------------------------------------------------------
        $dia_hora = date('Y-m-d H:i:s');
        $notificacion['config_usuario_id'] =  $request['config_usuario_id'];
        $notificacion['fec_creacion'] =  $dia_hora;
        $notificacion['titulo'] =  'Se creo un nuevo componente y te fue asignado ';
        $notificacion['mensaje'] =  'Se creo una nuevo componente al proyecto ' .$componente->proyecto->titulo. ' y te fue asignado -> ' .ucfirst($request['titulo']);
        $notificacion['link'] =  route('proyecto.gestion', ['id' => $componente->proyecto->id]);
        $notificacion['id_link'] =  $componente->proyecto->id;
        $notificacion['tipo'] =  'componente';
        $notificacion['accion'] =  'creacion';
        Notificacion::create($notificacion);
        //------------------------------------------------------------------------------------------
        return redirect('dashboard/proyectos/gestion/'.$request['proyectos_id'])->with('mensaje', 'Componente creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Componente $componente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $componente = Componente::FindOrFail($id);
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
        return view('intranet.proyectos.componente.editar', compact('proyecto', 'usuarios','componente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (isset($request['checkAdcionar'])) {
            if ($request['checkAdcionar']=='1'&& doubleval($request['adicion'])==0) {
                return redirect('dashboard/proyectos/componentes/editar/'.$id)->with('errores', 'la adición no puede darse con el valor en $0.00');
            }
        }
        $componente = Componente::findOrFail($id);
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
        $componenteUpdate['config_usuario_id']= $request['config_usuario_id'];
        $componenteUpdate['titulo']= $request['titulo'];
        $componenteUpdate['impacto']= $request['impacto'];
        $componenteUpdate['impacto_num']= $impacto_num;
        $componenteUpdate['objetivo']= $request['objetivo'];

        if (isset($request['checkAdcionar']) && ($request['checkAdcionar']=='1' && doubleval($request['adicion'])!=0)) {
            $adicion_new['usuario_id'] = session('id_usuario');
            $adicion_new['componente_id'] = $componente->id;
            $adicion_new['adicion'] = doubleval($request['adicion']);
            $adicion_new['fecha'] = date('Y-m-d');
            $adicion_new['justificacion'] = $request['justificacion'];
            AdicionComponente::create($adicion_new);

            $componenteUpdate['porc_ejecucion'] = (($componente->ejecucion*100)/($componente->presupuesto + $componente->adiciones->sum('adicion')));


            $adicion_p_new['usuario_id'] = session('id_usuario');
            $adicion_p_new['proyectos_id'] = $componente->proyecto->id;
            $adicion_p_new['adicion'] = doubleval($request['adicion']);
            $adicion_p_new['fecha'] = date('Y-m-d');
            $adicion_p_new['justificacion'] = 'Adición de presupesto al componente '. $componente->titulo . ' Justificación:' .$request['justificacion'];
            AdicionProyecto::create($adicion_p_new);

            $proyectoUpdate['porc_ejecucion']= (($componente->proyecto->ejecucion*100)/($componente->proyecto->presupuesto+$componente->proyecto->adiciones->sum('adicion')));
            Proyecto::findOrFail($componente->proyectos_id)->update($proyectoUpdate);
        }
        $componente->update($componenteUpdate);
        //-----------------------------------------------------------------------------------
        $this->actualizar_miembros_proyecto($componente->proyecto, $componente->config_usuario_id);
        //-----------------------------------------------------------------------------------
        $this->actualizar_progreso_proyecto($componente->proyecto);
        //-----------------------------------------------------------------------------------

        return redirect('dashboard/proyectos/gestion/'.$componente->proyectos_id)->with('mensaje', 'Se realizaron los cambios al componente ' . $componente->titulo . ' de manera satisfactoria');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Componente $componente)
    {
        //
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
    public function actualizar_progreso_proyecto($proyecto){
        $sumImpacto_numComponente_Proyecto = $proyecto->componentes->sum('impacto_num');
        $progesoProyecto = 0;
        foreach ($proyecto->componentes as $componente) {
            $progesoProyecto += (($componente->impacto_num / $sumImpacto_numComponente_Proyecto) * floatval($componente->progreso));
        }
        $ProyectoUpdate['progreso'] = $progesoProyecto;
        $ProyectoUpdate['estado'] = 'Activo';
        Proyecto::findOrFail($proyecto->id)->update($ProyectoUpdate);
    }

}
