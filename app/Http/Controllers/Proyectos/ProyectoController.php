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
        if (session('rol_id')<3) {
            $grupos = GrupoEmpresa::get();
            return view('intranet.proyectos.proyecto.index',compact('grupos'));
        } else {
            $usuario = ConfigUsuario::findOrfail(session('id_usuario'));
            $tareas = Tarea::where('config_usuario_id',session('id_usuario'))->where('progreso','<', '100')->get();
            $array_events_calendario = [];
            foreach ($tareas as $tarea) {
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
                $porcVenc=($diasGestionTarea * 100) / $diasTotalTarea;
                if ($tarea->fec_limite < date('Y-m-d')) {
                    $backgroundColor = 'rgb(255,0,0)';
                } else {
                    if ($porcVenc> 80 || $diasTotalTarea - $diasGestionTarea < 3) {
                        $backgroundColor = 'rgb(255,150,0)';
                    } else {
                        if (((($tarea->impacto_num/10) + $tarea->id) % 2) != 0) {
                            $backgroundColor = 'rgb(0,'. rand(60,250) - $tarea->impacto_num .','. rand(10,180) + $tarea->impacto_num .')';
                        } else {
                            $backgroundColor = 'rgb(0,'. rand(10,180) + $tarea->impacto_num .','. rand(60,250) - $tarea->impacto_num .')';
                        }
                    }
                }
                $array_events_calendario[] = [
                    'title' => utf8_encode($tarea->titulo),
                    'start' => $tarea->fec_creacion,
                    'end' => $tarea->fec_limite,
                    'url' => route('tarea.gestion',['id' => $tarea->id]),
                    'backgroundColor' =>  $backgroundColor,
                    'borderColor' => 'rgb(0,0,0)',
                ];
            }

            return view('intranet.proyectos.proyecto.index',compact('usuario','array_events_calendario'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (session('rol_id')<3) {
            $grupos = GrupoEmpresa::get();
            return view('intranet.proyectos.proyecto.crear',compact('grupos'));
        } else {
            # code...
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $proyecto = Proyecto::create($request->all());
        $dia_hora = date('Y-m-d H:i:s');
        $notificacion['config_usuario_id'] =  $request['config_usuario_id'];
        $notificacion['fec_creacion'] =  $dia_hora;
        $notificacion['titulo'] =  'Se creo un nuevo proyecto y te fue asignado ';
        $notificacion['mensaje'] =  'Se creo un nuevo proyecto Proyecto de Prueba y te fue asignado -> ' .ucfirst($request['titulo']);
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
        return view('intranet.proyectos.proyecto.detalle',compact('proyecto'));
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

    public function gestion($id,$notificacion_id = null){
        if ($notificacion_id) {
            $notificacion_update['estado'] = 0;
            Notificacion::findOrFail($notificacion_id)->update($notificacion_update);
        }
        $proyecto = Proyecto::findOrFail($id);
        return view('intranet.proyectos.proyecto.gestionar',compact('proyecto'));
    }

    public function getproyectos(Request $request,$estado,$config_empresa_id){
        if ($request->ajax()) {
            if ($estado =='todos') {
                return response()->json(['proyectos' => Proyecto::where('config_empresa_id',$config_empresa_id)->with('miembros_proyecto')->with('lider')->get()]);
            } else {
                return response()->json(['proyectos' => Proyecto::where('config_empresa_id',$config_empresa_id)->where('estado',$estado)->with('miembros_proyecto')->with('lider')->get()]);
            }
        } else {
            abort(404);
        }
    }

    public function getproyectosusuario(Request $request,$config_usuario_id){
        if ($request->ajax()) {
            return response()->json(['proyectos' => Proyecto::where('config_empresa_id',$config_empresa_id)->where('estado',$estado)->with('miembros_proyecto')->with('lider')->get()]);
        } else {
            abort(404);
        }
    }

    public function storeNotificacion ($config_usuario_id,$proyectoTitulo,$proyectoId){
        //----------------------------------------------------------------------------------------------------
        $dia_hora = date('Y-m-d H:i:s');
        $notificacion['config_usuario_id'] =  $config_usuario_id;
        $notificacion['fec_creacion'] =  $dia_hora;
        $notificacion['titulo'] =  'Se asigno un nuevo proyecto';
        $notificacion['mensaje'] =  'Se creo una nuevo proyecto y te fue asignada -> ' .ucfirst($proyectoTitulo);
        $notificacion['link'] =  route('proyecto.gestion', ['id' => $proyectoId]);
        $notificacion['id_link'] =  $proyectoId;
        $notificacion['tipo'] =  'proyecto';
        $notificacion['accion'] =  'creacion';
        Notificacion::create($notificacion);
        //----------------------------------------------------------------------------------------------------
    }
}
